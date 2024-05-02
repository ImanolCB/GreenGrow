<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Grow - Tienda</title>
    <link rel="shortcut icon" href="/assets/img/logo.jpg" type="image/x-icon">
    <!-- Bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Required php -->
    <?php
    require_once '../../views/includes/fonts.php';
    require_once './../../models/Producto.php';
    require_once './../../models/conexionBD.php';

    ?>

    <!-- CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/tienda.css">

</head>

<body>

    <!-- HEADER -->
    <?php include '../includes/header.php'; ?>

    <!-- MAIN -->

    <main class="main">

        <!-- ASIDE -->
        <?php
        /**
         * TODO: PENDIENTE AÑADIR EL FORM CON LAS OPCIONES DE FILTROS CORRESPONDIENTES
         * TODO: PENSAR COMO REALIZAR LA CONSULTA SEGÚN LOS FILTROS SELECCIONADOS
         */
        ?>



        <form action="../../controllers/miControlador.php" method="post">
            <div id="sidebar" class=" p-3 sidebar d-lg-block">

                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <span class="fs-4">Filtros</span>
                </a>

                <hr>
                <ul class="nav nav-pills flex-column mb-auto ">
                    <li class="nav-item d-flex-column">
                        <label for="precio" class="col-form-label col-sm-10"><b>Precio</b></label>
                        <div class="col-sm-12 d-flex justify-content-evenly ">
                            <input type="range" id="precio" name="precio" min="0" max="200" oninput="rangoFiltro()">
                            <p id="precioMostrado" class="m-0 precioMostrado">0</p>
                        </div>
                    </li>
                    <hr>
                    <li>
                        <label for="tipo" class="col-form-label col-sm-10"><b>Tipo</b></label>

                        <div class="col-sm-8 flex-column "><br>
                            <div class="d-flex justify-content-left">
                                <input type="checkbox" id="tipo" name="tipo" value="arbol"><br>
                                <label class="m-1">Arbol</label>
                            </div>

                            <div class="d-flex justify-content-left">
                                <input type="checkbox" id="tipo" name="tipo" value="arbusto"><br>
                                <label class="m-1">Arbusto</label>
                            </div>
                            <div class="d-flex justify-content-left">
                                <input type="checkbox" id="tipo" name="tipo" value="cactus"><br>
                                <label class="m-1">Cactus</label>
                            </div>

                            <div class="d-flex justify-content-left">
                                <input type="checkbox" id="tipo" name="tipo" value="flor"><br>
                                <label class="m-1">Flor</label>
                            </div>

                            <div class="d-flex justify-content-left">
                                <input type="checkbox" id="tipo" name="tipo" value="exotica"><br>
                                <label class="m-1">Planta exótica</label>
                            </div>

                            <div class="d-flex justify-content-left">
                                <input type="checkbox" id="tipo" name="tipo" value="interior"><br>
                                <label class="m-1">Planta interior</label>
                            </div>

                        </div>
                    </li>
                    <hr>
                    <li>
                        <label for="tipo" class="col-form-label col-sm-10"><b>Cuidado</b></label>

                        <div class="col-sm-8 flex-column "><br>
                            <div class="d-flex justify-content-left">
                                <input type="checkbox" id="sencillo" name="sencillo" value="sencillo"><br>
                                <label class="m-1">Sencillo</label>
                            </div>

                            <div class="d-flex justify-content-left">
                                <input type="checkbox" id="moderado" name="moderado" value="moderado"><br>
                                <label class="m-1">Moderado</label>
                            </div>
                            <div class="d-flex justify-content-left">
                                <input type="checkbox" id="complejo" name="complejo" value="complejo"><br>
                                <label class="m-1">Complejo</label>
                            </div>
                        </div>
                    </li>
                    <hr>
                    <li>
                        <label for="tipo" class="col-form-label col-sm-10"><b>Epoca de floración</b></label>
                        <div class="col-sm-8 flex-column "><br>
                            <div class="d-flex justify-content-left">
                                <input type="checkbox" id="primavera" name="primavera" value="primavera"><br>
                                <label class="m-1">Primavera</label>
                            </div>

                            <div class="d-flex justify-content-left">
                                <input type="checkbox" id="verano" name="verano" value="verano"><br>
                                <label class="m-1">Verano</label>
                            </div>
                            <div class="d-flex justify-content-left">
                                <input type="checkbox" id="otono" name="otono" value="otono"><br>
                                <label class="m-1">Otoño</label>
                            </div>
                            <div class="d-flex justify-content-left">
                                <input type="checkbox" id="invierno" name="invierno" value="invierno"><br>
                                <label class="m-1">Invierno</label>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </form>



        <button id="btnSideBar" type="button" class="d-lg-none" onclick="mostrarOcultar()">
            < </button>

                <?php

                /**
                 * TODO: HACER EL FORMULARIO PARA LOS BOTONES DE SUBMIT DE CADA PRODUCTO Y DEL CARRITO
                 * TODO: HACER EL INCLUDE PARA CADA PRODUCTO CARGADO CON LOS DATOS OBTENIDOS DE LA CONSULTA DE PRODUCTOS
                 */

                ?>

                <!-- CONTENEDOR -->

                <?php
                //Gestión de productos añadidos en el carrito (Almacena id)
                
                if (isset($_REQUEST['anadir'])) {
                        Producto::anadirProductoACesta($_SESSION['carrito'], $_REQUEST['cantidad'], $_REQUEST['anadir']);
                }
                echo $_REQUEST['carrito'];
                ?>

                <div class="container text-center">
                    
                    <!-- Buscador -->
                    <div class="input-group mt-3">
                        <input id="busqueda" type="text" class="form-control" placeholder="Buscar productos..." aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Buscar</button>
                    </div>

                    <div class="carrito w-100 d-flex justify-content-md-end">
                        <!--Carrito  -->
                        <form action="./../../controllers/miControlador.php" method="post">
                            <button type="submit" name="submit" value="carrito" id="btnCarrito" class=" position-relative m-4">
                                <img height="30px" src="https://cdn.icon-icons.com/icons2/906/PNG/512/shopping-cart_icon-icons.com_69913.png" alt="carrito">
                                <span id="contadorCarrito" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    <?php 
                                         if (isset($_SESSION['carrito'])) {
                                            echo count($_SESSION['carrito']);
                                        } else {
                                            echo 5;
                                        }
                                    ?>
                                </span>
                            </button>
                        </form>
                    </div>


                    <!-- Contenedor de productos -->
                    <div class="row row-cols-1 row-cols-md-4 row-cols-lg-4 g-4 justify-content-evenly">

                        <div class='col'>
                            <div class='card h-100'>
                                <img src=' https://images.unsplash.com/photo-1608094920984-5b54ce1bb792?q=80&w=2670&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D ' class='card-img-top' alt='test' title='test'>
                                <div class='card-body mt-2  '>
                                    <h5 class='card-title mb-4 d-flex flex-row justify-content-between'>TEST <span class='text-black p-1 border border-success rounded-1'>14.66€</span></h5>
                                    <p class='card-text text-start m-1'><span>Nivel de cuidado: </span>TEST</p>
                                    <p class='card-text text-start m-1'><span>Tipo de planta: </span>TEST</p>
                                    <p class='card-text text-start m-1'><span>Altura máxima: </span>TEST</p>
                                    <p class='card-text text-start m-1'><span>Época de floración: </span>TEST</p>
                                    <p class='card-text text-start mt-3'><span></span>TESTTESTTESTTESTTESTTESTTESTTEST</p>

                                    <div class='card-footer bg-transparent '>
                                        <form action="./tienda.php" method="post">
                                            <div data-mdb-input-init class="form-outline d-flex flex-row justify-content-evenly align-items-center">
                                                <input type="number" id="typeNumber" name="cantidad" value="1" class="form-control" min="0" max="5" placeholder="Cantidad" />
                                                <button id="1" type="submit" name="anadir" value="1" class="btn btn-primary m-2">Añadir</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        //Creación de una conexión a la BD
                        $conn = new ConexionBD();

                        //Almacenamiento del listado de productos
                        $listaProductos = Producto::consultarProductos($conn->conectar_bd());

                        //Construir las tarjetas de productos
                        echo Producto::crearProductos($listaProductos);

                        ?>


                    </div>
    </main>

    <!-- FOOTER -->
    <?php include '../includes/footer.php' ?>

    <!-- SCRIPTS -->
    <script src="../../assets/js/funcionesSideBar.js"></script>

</body>

</html>