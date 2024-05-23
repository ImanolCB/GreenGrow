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
                if($usuario->getRol() == 'administrador'){$rolUs = 'Adm';} else $rolUs = 'Usu';

                $html .= "
                <tr class = 'align-middle text-center'>
                    <td>" . $usuario->getIdUsuario() ." </td>
                    <td>" . $usuario->getEmail() ." </td>
                    <td>" . $rolUs ." </td>
                    <td>" . $usuario->getFechaAlta() ." </td>
                    <td> 
                        <button type='submit' name='cambiar' value='". $usuario->getIdUsuario() . "' class='btn btn-primary'>Cambiar rol</button>
                        <button type='submit' name='eliminar' value='". $usuario->getIdUsuario() . "' class='btnRed btn btn-primary'>Eliminar</button>
                    </td>
                </tr>
                ";
                // array_push($arrayUsuarios, $usuario);
            }
            // var_dump($arrayProductos);
            return $html;
        }
    }
}
