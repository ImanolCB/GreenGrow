<?php

session_start();

require_once '../models/conexionBD.php';
require_once '../models/Producto.php';
require_once '../models/Usuario.php';

//Declaración de variables generales
$_SESSION['usermail'] = null;
$_SESSION['user_rol'] = null;

//Creación de una conexión a la BD
$conn = new ConexionBD();




// Comprueba si se ha enviado algún submit
if (isset($_REQUEST['submit'])) {
    $submit = $_REQUEST['submit'];

    try {


        // Realiza acciones según el valor del submit
        switch ($submit) {
                //Cuando se pulsa el boton de inicio de sesion en login.php
            case "Iniciar sesion":
                $emailInicioSesion = $_REQUEST['emailLogin'];
                $passwordInicioSesion = $_REQUEST['passwordLogin'];
                $usuarioInicioSesion = new Usuario;
                $usuarioInicioSesion->setEmail($emailInicioSesion);
                $usuarioInicioSesion->setPassword($passwordInicioSesion);
                if ($usuarioInicioSesion->verificarUsuario($usuarioInicioSesion, $conn->conectar_bd())) {

                    /**
                     * TODO: PENDIENTE ALMACENAR EN SESION EL EMAIL Y ROL DE USUARIO
                     * TODO: SE PRETENDE COMPROBAR QUE SE ACCEDA A "MI CUENTA" SI HAY USUARIO EN SESION
                     * TODO: HACER UNA REDIRECCIÓN AL VIEW CON LAS PLANTAS DEL USUARIO
                     */

                    header("Location: /../index.php");
                    exit();
                } else {
                    echo "No verificado";
                }
                break;
                //Cuando se pulsa el boton de registrar se realiza el insert en la base de datos
            case "Registrar":
                $emailRegistro = $_REQUEST['emailRegistro'];
                $passwordRegistro = $_REQUEST['passwordRegistro'];
                $passwordRegistroRep = $_REQUEST['passwordRegistroRep'];
                $usuarioRegistro = new Usuario;
                $usuarioRegistro->setEmail($emailRegistro);
                $usuarioRegistro->setPassword($passwordRegistro);
                //Comprobación de que las contraseñas coinciden
                if ($passwordRegistro == $passwordRegistroRep) {
                    //En el caso de que la inserción se haya realizado exitosamente se redirecciona al index
                    if ($usuarioRegistro->insertarUsuario($usuarioRegistro, $conn->conectar_bd())) {
                        header("Location: /../views/login/login.php");
                        exit();

                    } else {
                        /**
                         * TODO: PENDIENTE AÑADIR MENSAJE DE ERROR
                         */

                        echo "El usuario no se ha podido registrar en la base de datos";
                    }
                } else {
                    echo "Las contraseñas no coinciden";
                }

                break;

                //Cuando el boton pulsado no coincide con ningún caso
            default:
                // Si el submit no coincide con ninguno de los casos anteriores, redirige al index
                header("Location: /../index.php");
                exit(); //Asegura de salir del script después de la redirección

        }
    } catch (\Throwable $th) {
        echo "Mensaje de error catch: " . $th;
    }
    //Al final de cada acción del controlador cierra cualquier conexión que se quede abierta
    finally {
        $conn->cerrar_conexion();
    }
} else {
    // Si no se envió ningún formulario, redirecciona al index
    header("Location: /../index.php");
    exit(); //Asegura de salir del script después de la redirección
}


session_destroy();
