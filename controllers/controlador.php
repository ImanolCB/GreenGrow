<?php

//Comprobación que esta pulsado algún submit
$submit = isset($_REQUEST['submit']) ? $_REQUEST['submit'] : null;

//Comprueba que el submit tiene datos
if ($submit !== null) {

    switch ($submit) {
        //Boton de formulario en la view de Logeo
        case "Mi cuenta":
            exit();
            header("Location: /controllers/controlador.php");
            break;
        //Boton de formulario en la view de Logeo
        case "Iniciar sesion":
            echo "Procesando inicio de sesion";
            break;

        //Por defecto, al no encontrar coincidencia en en un submit te devuelve al inicio
        default:
            exit();
            header("Location: ../index.php");
            break;
    }
} else {
    // Si no se envió ningún formulario, también redireccionamos a index.php
    header("Location: index.php");
    exit();
}
