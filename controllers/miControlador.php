<?php

session_start();

require_once './../models/conexionBD.php';
require_once './../models/Producto.php';
require_once './../models/Usuario.php';



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
                $usuarioInicioSesion = new Usuario(0,$emailInicioSesion,$passwordInicioSesion,null,null);
                // $usuarioInicioSesion->setEmail($emailInicioSesion);
                // $usuarioInicioSesion->setPassword($passwordInicioSesion);

                // Verificar el usuario
                $resultadoVerificacion = $usuarioInicioSesion->verificarUsuario($usuarioInicioSesion, $conn->conectar_bd());

                //Verificar si el valor para la clave válido es true
                if ($resultadoVerificacion["validado"]) {
                    // Inicio de sesión para almacenar los datos del usuario 
                    $_SESSION['usermail'] = $emailInicioSesion;
                    $_SESSION['user_rol'] = $resultadoVerificacion["rol"];
                    $_SESSION['user_id'] = $resultadoVerificacion["id"];

                    // echo "EMAIL " . $_SESSION['usermail'];
                    // echo "ROL " . $_SESSION['user_rol'];

                    // Redirigir a la página de inicio
                    header("Location: ./../index.php");
                    exit();
                } else {
                    // Si la verificación falla, mostrar mensaje de error y redirigir
                    echo "No se puede iniciar sesión. Verifique sus credenciales." . $resultadoVerificacion["validado"];
                    // header("Location: /../views/login/login.php");
                    exit();
                }
                break;
                //Cuando se pulsa el boton de registrar se realiza el insert en la base de datos
            case "Registrar":
                $emailRegistro = $_REQUEST['emailRegistro'];
                $passwordRegistro = $_REQUEST['passwordRegistro'];
                $passwordRegistroRep = $_REQUEST['passwordRegistroRep'];
                $usuarioRegistro = new Usuario(0,$emailRegistro,$passwordRegistro,null,null);
                // $usuarioRegistro->setEmail($emailRegistro);
                // $usuarioRegistro->setPassword($passwordRegistro);

                // Verificación de que el usuario todavía no está registrado
                $resultadoExistencia = $usuarioRegistro->existeUsuario($usuarioRegistro, $conn->conectar_bd());
                if ($resultadoExistencia) {
                    /**
                     * TODO: PENDIENTE AÑADIR MENSAJE DE ERROR
                     */
                    echo "Ese usuario ya está registrado. Prueba con otro";
                } else {
                    //Comprobación de que las contraseñas coinciden
                    if ($passwordRegistro == $passwordRegistroRep) {
                        //En el caso de que la inserción se haya realizado exitosamente se redirecciona al index
                        if ($usuarioRegistro->insertarUsuario($usuarioRegistro, $conn->conectar_bd())) {
                            header("Location: ./../views/login/login.php");
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
                }
                break;

                //Cuando se pulse "Mi cuenta" en la barra de navegacion
            case "Mi cuenta":
                if ($_SESSION['usermail'] === null && $_SESSION['user_rol'] === null) {

                    header("Location: ./../views/login/login.php");
                    exit(); //Asegura de salir del script después de la redirección

                } else {
                    if ($_SESSION['user_rol'] == 'administrador') {
                        header("Location: ./../views/myAccount/panelControl.php");
                        exit(); //Asegura de salir del script después de la redirección
                    } else {
                        // header("Location: /../index.php");
                        header("Location: ./../views/myAccount/account.php");
                        exit(); //Asegura de salir del script después de la redirección
                    }
                }
                break;
            case "Cerrar sesion":
                $_SESSION = array();
                session_destroy();
                header("Location: ./../index.php");
                exit();
                break;

                //Cuando se pulsa Promociones en la barra de navegacion
            case "Promociones":
                //Comprobación que el usuario esta iniciado
                if ($_SESSION['usermail'] === null && $_SESSION['user_rol'] === null) {
                    header("Location: ./../index.php");
                    exit(); //Asegura de salir del script después de la redirección
                } else {
                    header("Location: ./../views/shop/promociones.php");
                    exit(); //Asegura de salir del script después de la redirección
                }
                break;

                //Cuando se pulsa Promociones en la barra de navegacion
            case "Tienda":

                header("Location: ./../views/shop/tienda.php");
                exit(); // Asegura de salir del script después de la redirección


                break;
            case "Sobre nosotros":
                header("Location: ./../views/about/about.php");
                exit(); //Asegura de salir del script después de la redirección

                //Cuando se pulsa añadir en un producto
            case "anadir":
                //Almacenamiento del listado de productos
                $listaProductos = Producto::consultarProductos($conn->conectar_bd());

                if (!isset($_SESSION['carrito'])) {
                    $_SESSION['carrito'] = [];
                    Producto::anadirProductoACesta($_SESSION['carrito'], $_REQUEST['cantidad'], $_REQUEST['id-producto']);
                } else {
                    Producto::anadirProductoACesta($_SESSION['carrito'], $_REQUEST['cantidad'], $_REQUEST['id-producto']);
                }

                header("Location: ./../views/shop/tienda.php");

                exit(); //Asegura de salir del script después de la redirección
                break;

                //Cuando se pulsa el Carrito de Tienda
            case "carrito":
                //Almacenamiento del listado de productos
                $listaProductos = Producto::consultarProductos($conn->conectar_bd());

                if ($_SESSION['usermail'] != null && $_SESSION['user_rol'] != null) {

                    header("Location: ./../views/shop/carrito.php");

                    exit(); //Asegura de salir del script después de la redirección
                } else {
                    header("Location: ./../views/login/login.php");
                    exit(); //Asegura de salir del script después de la redirección
                }

                break;

                //Cuando se pulsa el botón de volver a la página anterior
            case "Volver a tienda":

                header("Location: ./../views/shop/tienda.php");
                exit(); //Asegura de salir del script después de la redirección

                //Cuando el boton pulsado no coincide con ningún caso
            default:
                // Si el submit no coincide con ninguno de los casos anteriores, redirige al index
                header("Location: ./../index.php");
                exit(); //Asegura de salir del script después de la redirección
        }
    } catch (\Throwable $th) {
        echo "Mensaje de error catch: " . $th;
    } finally {
        $conn->cerrar_conexion();
    }
} else {
    // Si no se envió ningún formulario, redirecciona al index

    header("Location: ./../index.php");
    exit(); //Asegura de salir del script después de la redirección    
}
