<?php

session_start();

require_once './../models/conexionBD.php';
require_once './../models/Producto.php';
require_once './../models/Usuario.php';
require_once './../models/Planta.php';



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
                $usuarioInicioSesion = new Usuario(0, $emailInicioSesion, $passwordInicioSesion, null, null);

                // Verificar el usuario
                $resultadoVerificacion = $usuarioInicioSesion->verificarUsuario($usuarioInicioSesion, $conn->conectar_bd());

                //Verificar si el valor para la clave válido es true
                if ($resultadoVerificacion["validado"]) {
                    // Inicio de sesión para almacenar los datos del usuario 
                    $_SESSION['usermail'] = $emailInicioSesion;
                    $_SESSION['user_rol'] = $resultadoVerificacion["rol"];
                    $_SESSION['user_id'] = $resultadoVerificacion["id"];


                    // Redirigir a la página de inicio
                    header("Location: ./../index.php");
                    exit();
                } else {
                    // Si la verificación falla, mostrar mensaje de error y redirigir
                    $_SESSION['error'] = 'Credenciales incorrectas.';
                    header("Location: ./../views/login/login.php");
                    exit();
                }
                break;
                //Cuando se pulsa el boton de registrar se realiza el insert en la base de datos
            case "Registrar":
                $emailRegistro = $_REQUEST['emailRegistro'];
                $passwordRegistro = $_REQUEST['passwordRegistro'];
                $passwordRegistroRep = $_REQUEST['passwordRegistroRep'];
                $usuarioRegistro = new Usuario(0, $emailRegistro, $passwordRegistro, null, null);


                // Verificación de que el usuario todavía no está registrado
                $resultadoExistencia = $usuarioRegistro->existeUsuario($usuarioRegistro, $conn->conectar_bd());
                if ($resultadoExistencia) {
                    $_SESSION['error'] = 'El usuario ya está en uso';
                    header("Location: ./../views/login/registro.php");
                    exit();
                } else {
                    //Comprobación de que las contraseñas coinciden
                    if ($passwordRegistro == $passwordRegistroRep) {
                        //En el caso de que la inserción se haya realizado exitosamente se redirecciona al index
                        if ($usuarioRegistro->insertarUsuario($usuarioRegistro, $conn->conectar_bd())) {
                            header("Location: ./../views/login/login.php");
                            exit();
                        } else {
                            $_SESSION['error'] = 'No se ha podido registrar el usuario en la base de datos';
                            header("Location: ./../views/login/registro.php");
                            exit();
                        }
                    } else {
                        $_SESSION['error'] = 'Las contraseñas no coinciden';
                        header("Location: ./../views/login/registro.php");
                        exit();
                    }
                }
                break;

                //Cuando se pulse "Mi cuenta" en la barra de navegacion
            case "Mi cuenta":
                if ($_SESSION['usermail'] === null || $_SESSION['user_rol'] === null) {

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
                header("Location: ./../views/shop/promociones.php");
                exit(); //Asegura de salir del script después de la redirección
                break;

                //Cuando se pulsa Tienda en la barra de navegacion
            case "Tienda":
                header("Location: ./../views/shop/tienda.php");
                exit(); // Asegura de salir del script después de la redirección
                break;

            case "Sobre nosotros":
                header("Location: ./../views/about/about.php");
                exit(); //Asegura de salir del script después de la redirección
                break;

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
                break;

                //Cuando se pulsa el botón de volver a panel
            case "Volver a mis plantas":
                if ($_SESSION['usermail'] != null && $_SESSION['user_rol'] != null) {

                    header("Location: ./../views/myAccount/account.php");
                    exit(); //Asegura de salir del script después de la redirección

                } else {
                    header("Location: ./../index.php");
                    exit(); //Asegura de salir del script después de la redirección
                }

                break;
                //Cuando se pulsa el botón de volver a panel
            case "Ver pedidos":
                if ($_SESSION['usermail'] != null && $_SESSION['user_rol'] != null) {

                    header("Location: ./../views/myAccount/misPedidos.php");
                    exit(); //Asegura de salir del script después de la redirección

                } else {
                    header("Location: ./../index.php");
                    exit(); //Asegura de salir del script después de la redirección
                }

                break;

                //Cuando se pulsa el botón de volver a panel
            case "Volver a panel":
                if ($_SESSION['usermail'] != null && $_SESSION['user_rol'] == 'administrador') {

                    header("Location: ./../views/myAccount/panelControl.php");
                    exit(); //Asegura de salir del script después de la redirección

                } else {
                    header("Location: ./../index.php");
                    exit(); //Asegura de salir del script después de la redirección
                }

                break;

                //Cuando se pulsa añadir una planta en la cuenta de usuario
            case "plantaAdd":
                $nombre = $_REQUEST['nombrePlanta'];
                $archivo = $_FILES['url'];

                if ($nombre != null && $archivo != null) {
                    $n_archivo = $archivo['name'];
                    $tmp_archivo = $archivo['tmp_name'];
                    $destino = "./../assets/imagenesUsuario/";

                    // Verificar si el directorio existe, si no, crearlo
                    if (!is_dir($destino)) {
                        mkdir($destino, 0777, true);
                    }

                    $url = $destino . $n_archivo;
                    $base_datos = "assets/imagenesUsuario/" . $n_archivo;

                    // Mover el archivo subido al directorio de destino
                    if (move_uploaded_file($tmp_archivo, $url)) {
                        Planta::insertarPlanta($conn->conectar_bd(), $nombre, $base_datos, $_SESSION['user_id']);
                    } else {
                        echo "Error al mover el archivo subido.";
                    }

                    header("Location: ./../views/myAccount/account.php");
                    exit(); //Asegura de salir del script después de la redirección
                } else {
                    $_SESSION['error'] = 'No se puede añadir una planta vacía';
                    header("Location: ./../views/myAccount/account.php");
                    exit();
                }


                break;

            case "administrarProductos":
                // Si el submit no coincide con ninguno de los casos anteriores, redirige al index
                header("Location: ./../views/myAccount/administrarProductos.php");
                exit(); //Asegura de salir del script después de la redirección
                break;

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
