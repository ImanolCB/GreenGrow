<?php



class Usuario
{
    private $id_usuario;
    private $email;
    private $password;
    private $rol;
    private $fecha_alta;

    // Constructor
    public function __construct($id_usuario, $email, $password, $rol, $fecha_alta)
    {
        $this->id_usuario = $id_usuario;
        $this->email = $email;
        $this->password = $password;
        $this->rol = $rol;
        $this->fecha_alta = $fecha_alta;
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function getEmail()
    {
        return (string) $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    public function getFechaAlta()
    {
        return $this->fecha_alta;
    }

    public function setFechaAlta($fecha_alta)
    {
        $this->fecha_alta = $fecha_alta;
    }

    //Función para dar de alta un usuario
    public function insertarUsuario($usuario, $conexion)
    {
        // Obtener los valores del usuario
        $email = $usuario->getEmail();
        $password = $usuario->getPassword();

        // Hashear la contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Construir la consulta SQL de inserción
        $query = "INSERT INTO usuario (id_usuario, email, password) VALUES ('0', '$email', '$hashedPassword')";

        // Ejecutar la consulta
        $resultado = mysqli_query($conexion, $query);

        // Verificar si la consulta fue exitosa
        if (!$resultado) {
            die("Error al ejecutar la consulta: " . mysqli_error($conexion));
            return false;
        } else {
            return true;
        }
    }

    //Funcion para verificar si un usuario esta registrado en la BD
    public function verificarUsuario($usuario, $conexion)
    {
        // Obtener los valores del usuario
        $email = $usuario->getEmail();
        $password = $usuario->getPassword();

        // Construir la consulta SQL de Select
        $query = "SELECT id_usuario,email,password,rol FROM usuario WHERE email = '$email' ";

        // Ejecutar la consulta
        $resultado = mysqli_query($conexion, $query);

        // Verificar si la consulta fue exitosa
        if (!$resultado) {
            die("Error al ejecutar la consulta: " . mysqli_error($conexion));
            //Devuelve clave valor negativo tanto para la validación como para el rol
            return ["validado" => false, "rol" => null, "id" => 0];
        } else {
            if (mysqli_num_rows($resultado) == 1) {
                $fila = mysqli_fetch_assoc($resultado);
                $hashedPassword = $fila['password'];

                if (password_verify($password, $hashedPassword)) {
                    // Si las contraseñas coinciden, el usuario es valido y se devuelve el estado de validación y el rol
                    return ["validado" => true, "rol" => $fila['rol'], "id" => $fila['id_usuario']];
                } else {
                    // Si la contraseña no coincide, el usuario no es valido
                    return ["validado" => false, "rol" => null, "id" => 0];
                }
            } else {
                // Si hay más de un usuario igual la validación es nula
                return ["validado" => false, "rol" => null, "id" => 0];
            }
        }
    }


    //Funcion para el rol de un usuario de la BD
    public function existeUsuario($usuario, $conexion)
    {
        // Obtener los valores del usuario
        $email = $usuario->getEmail();

        // Construir la consulta SQL de Select
        $query = "SELECT email FROM usuario WHERE email = '$email' ";

        // Ejecutar la consulta
        $resultado = mysqli_query($conexion, $query);

        // Verificar si la consulta fue exitosa
        if (!$resultado) {
            die("Error al ejecutar la consulta: " . mysqli_error($conexion));
            return false;
        } else {
            if (mysqli_num_rows($resultado) > 0) {
                return true;
            } else {
                //Si hay más de un usuario igual la validación es nula
                return false;
            }
        }
    }
    //Funcion para obtener todos los usuarios de base de datos
    public static function consultarUsuarios($conexion)
    {
        // Preparar la consulta SQL de Select
        $query = "SELECT * FROM usuario ";

        // Preparar la declaración
        $stmt = mysqli_prepare($conexion, $query);

        // Ejecutar la declaración
        mysqli_stmt_execute($stmt);

        // Obtener resultados
        $resultado = mysqli_stmt_get_result($stmt);

        // Verificar si la consulta fue exitosa
        if (!$resultado) {
            die("Error al ejecutar la consulta: " . mysqli_error($conexion));
            return "Error al ejecutar la consulta: " . mysqli_error($conexion);
        } else {
            $html = "";
            // $arrayUsuarios = [];
            //Muentras tenga resultados se le asocia a una fila un resultado y se hace un objeto
            while ($fila = mysqli_fetch_assoc($resultado)) {
                // var_dump($fila);
                $id = $fila['id_usuario'];
                $email = $fila['email'];
                $password = $fila['password'];
                $rol = $fila['rol'];
                $fecha_alta = $fila['fecha_alta'];

                $usuario = new Usuario($id, $email, $password, $rol, $fecha_alta);
                $rolUs = '';
                if ($usuario->getRol() == 'administrador') {
                    $rolUs = 'Administrador';
                } else $rolUs = 'Usuario';

                $html .= "
                <form action='./../../views/myAccount/panelControl.php' method='post'>
                    <tr class = 'align-middle text-center'>
                        <td>" . $usuario->getIdUsuario() . " </td>
                        <td>" . $usuario->getEmail() . " </td>
                        <td>" . $rolUs . " </td>
                        <td>" . $usuario->getFechaAlta() . " </td>
                        <td> 
                            <button type='submit' name='cambiar' value='" . $usuario->getIdUsuario() . "' class='btn btn-primary'>Cambiar rol</button>
                            <button type='submit' name='eliminar' value='" . $usuario->getIdUsuario() . "' class='btnRed btn btn-primary'>Eliminar</button>
                        </td>
                    </tr>
                </form>
                ";
                // array_push($arrayUsuarios, $usuario);
            }
            // var_dump($arrayProductos);
            return $html;
        }
    }

    // Funcion para cambiar el rol de usuaro
    public static function actualizarRolUsuario($id_usuario, $conexion)
    {
        // Obtener el rol actual del usuario
        $sql = "SELECT rol FROM usuario WHERE id_usuario = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $rol_actual = $row['rol'];

            // Determinar el nuevo rol
            $nuevo_rol = ($rol_actual === 'administrador') ? 'usuario' : 'administrador';

            // Actualizar el rol en la base de datos
            $sql_update = "UPDATE usuario SET rol = ? WHERE id_usuario = ?";
            $stmt_update = $conexion->prepare($sql_update);
            $stmt_update->bind_param("si", $nuevo_rol, $id_usuario);

            if ($stmt_update->execute()) {
                echo "Rol actualizado exitosamente a: " . $nuevo_rol;
            } else {
                echo "Error al actualizar el rol: " . $stmt_update->error;
            }

            $stmt_update->close();
        } else {
            echo "Usuario no encontrado.";
        }

        $stmt->close();
    }

    //Función para eliminar usuario de la base de datos
    public static function borrarUsuario($id_usuario, $conexion)
    {
        // Verificacion de que se ha establecido la conexión a la base de datos
        if ($conexion->connect_error) {
            die("Conexión fallida: " . $conexion->connect_error);
        }

        // Iniciar una transacción en la que se ejecutan diferentes acciones a la base de datos 
        $conexion->begin_transaction();

        try {
            // Eliminacion de las anotaciones de plantas relacionadas al usuario
            $sql = "DELETE a FROM anotacion a
                    JOIN planta p ON a.id_planta = p.id_planta
                    WHERE p.id_usuario = ?";
            if ($stmt = $conexion->prepare($sql)) {
                $stmt->bind_param("i", $id_usuario);
                $stmt->execute();
                $stmt->close();
            } else {
                throw new Exception("Error al preparar la consulta de eliminación de anotaciones: " . $conexion->error);
            }

            // Eliminacion de las plantas relacionadas a ese usuario
            $sql = "DELETE FROM planta WHERE id_usuario = ?";
            if ($stmt = $conexion->prepare($sql)) {
                $stmt->bind_param("i", $id_usuario);
                $stmt->execute();
                $stmt->close();
            } else {
                throw new Exception("Error al preparar la consulta de eliminación de plantas: " . $conexion->error);
            }

            // Eliminacion de las transacciones relacionadas a las cestas del usuario
            $sql = "DELETE t FROM transaccion t
                    JOIN cesta c ON t.id_cesta = c.id_cesta
                    WHERE c.id_usuario = ?";
            if ($stmt = $conexion->prepare($sql)) {
                $stmt->bind_param("i", $id_usuario);
                $stmt->execute();
                $stmt->close();
            } else {
                throw new Exception("Error al preparar la consulta de eliminación de transacciones: " . $conexion->error);
            }

            // Eliminacion de la relacion de la tabla intermedia
            $sql = "DELETE cp FROM `cesta-producto` cp
                    JOIN cesta c ON cp.id_cesta = c.id_cesta
                    WHERE c.id_usuario = ?";
            if ($stmt = $conexion->prepare($sql)) {
                $stmt->bind_param("i", $id_usuario);
                $stmt->execute();
                $stmt->close();
            } else {
                throw new Exception("Error al preparar la consulta de eliminación de productos de la cesta: " . $conexion->error);
            }

            // Eliminacion de las cestas relacionadas al usuario
            $sql = "DELETE FROM cesta WHERE id_usuario = ?";
            if ($stmt = $conexion->prepare($sql)) {
                $stmt->bind_param("i", $id_usuario);
                $stmt->execute();
                $stmt->close();
            } else {
                throw new Exception("Error al preparar la consulta de eliminación de cestas: " . $conexion->error);
            }

            // Finalmente, eliminar el usuario
            $sql = "DELETE FROM usuario WHERE id_usuario = ?";
            if ($stmt = $conexion->prepare($sql)) {
                $stmt->bind_param("i", $id_usuario);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    $_SESSION['mensaje'] = 'El usuario se ha eliminado';
                } else {
                    $_SESSION['error'] = 'No se encontró ningún usuario con el ID $id_usuario.';
                }
                //Se cierra la preparación de sentencias
                $stmt->close();
            } else {
                throw new Exception("Error al preparar la consulta de eliminación de usuario: " . $conexion->error);
            }

            // Confirmar transacción
            $conexion->commit();
        } catch (Exception $e) {
            // Revertir transacción
            $conexion->rollback();
            echo "Error al eliminar el usuario: " . $e->getMessage();
        }
    }
}
