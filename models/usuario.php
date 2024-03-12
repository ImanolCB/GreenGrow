<?php



class Usuario
{
    private $id_usuario;
    private $email;
    private $password;
    private $rol;
    private $fecha_alta;

    public function constructorVacio()
    {
    }

    public function constructorCompleto($id_usuario, $email, $password, $rol, $fecha_alta)
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
        return $this->email;
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

        // Construir la consulta SQL de inserción
        $query = "INSERT INTO `usuario` (`id_usuario`, `email`, `password`, `rol`, `fecha_alta`) VALUES ('0', $email, $password.hash(), '', '')";

        // Ejecutar la consulta
        $resultado = mysqli_query($conexion, $query);

        // Verificar si la consulta fue exitosa
        if (!$resultado) {
            die("Error al ejecutar la consulta: " . mysqli_error($conexion));
        } else {
            echo "Usuario insertado correctamente.";
        }
    }

    //Funcion para verificar si un usuario esta registrado en la BD
    public function verificarUsuario($usuario, $conexion)
    {
        // Obtener los valores del usuario
        $email = $usuario->getEmail();
        $password = $usuario->getPassword();

        // Construir la consulta SQL de Select
        $query = "INSERT INTO `usuario` (`id_usuario`, `email`, `password`, `rol`, `fecha_alta`) VALUES ('0', $email, $password.hash(), '', '')";

        // Ejecutar la consulta
        $resultado = mysqli_query($conexion, $query);

        // Verificar si la consulta fue exitosa
        if (!$resultado) {
            die("Error al ejecutar la consulta: " . mysqli_error($conexion));
        } else {
            echo "Usuario insertado correctamente.";
        }
    }
}

/**
 * ? Informacion sobre metodos empleados
 * 
   El método bind_param() se utiliza para vincular los parámetros de una consulta preparada en PHP a las variables que contienen los valores que se desean insertar en la base de datos.
   i: Representa un valor entero.
   d: Representa un valor de tipo double.
   s: Representa un valor de tipo string.
   b: Representa un valor de tipo blob (enviado en paquetes).
   Estos códigos de tipo de datos se utilizan para definir los tipos de datos de los parámetros en la sentencia SQL preparada.
 */
