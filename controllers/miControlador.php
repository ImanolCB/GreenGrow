<?php

session_start();

require_once './models/conexionBD.php';
require_once './models/Producto.php';
require_once './models/Usuario.php';

//Declaración de variables generales
$_SESSION['usermail'] = null;
$_SESSION['user_rol'] = null;

//Creación de una conexión a la BD
$conn = new ConexionBD();




// Comprueba si se ha enviado algún submit
if (isset($_REQUEST['submit'])) {
    $submit = $_REQUEST['submit'];

    // Realiza acciones según el valor del submit
    switch ($submit) {
            //Cuando se pulsa el boton de inicio de sesion en login.php
        case "Iniciar sesion":
            echo "Procesando inicio de sesión";
            break;

            //Cuando el boton pulsado no coincide con ningún caso
        default:
            // Si el submit no coincide con ninguno de los casos anteriores, redirige al index
            header("Location: /../index.php");
            exit(); //Asegura de salir del script después de la redirección

    }
} else {
    // Si no se envió ningún formulario, redirecciona al index
    header("Location: /../index.php");
    exit(); //Asegura de salir del script después de la redirección
}


session_destroy();
