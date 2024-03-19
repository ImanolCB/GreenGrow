<?php

include_once("configuracionBD.php");

class ConexionBD
{
    var $host = BD_HOST;
    var $usuario = BD_USUARIO;
    var $password = BD_PASSWORD;
    var $bd_nombre = BD_NOMBRE;
    var $con;

    // //Constructor de la clase
    // function __construct()
    // {
    //     $this->host = BD_HOST;
    //     $this->usuario = BD_USUARIO;
    //     $this->password = BD_PASSWORD;
    //     $this->bd_nombre = BD_NOMBRE;
    // }

    //Metodo para abrir una conexión a la base de datos
    function conectar_bd()
    {
        $this->con = mysqli_connect($this->host, $this->usuario, $this->password, $this->bd_nombre) or die("Error conectando a la base de datos.". $this->host);
        return $this->con;
    }

    //Metodo para cerrar una conexión
    function cerrar_conexion()
    {
        mysqli_close($this->con);
    }
}
