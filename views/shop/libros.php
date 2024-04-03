<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Grow - Libros</title>
    <link rel="shortcut icon" href="/assets/img/logo.jpg" type="image/x-icon">
    <!-- Bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">


    <!-- CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/tienda.css">

</head>

<body>
    <?php /*include 'views/includes/header.php' */
    require_once './../../models/Producto.php';
    ?>

    <!-- HEADER -->

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    <img src="/assets/img/logo.jpg" alt="logo" width="80" height="80">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 fs-5 ">
                        <li class="nav-item m-2">
                            <a class="nav-link active text-nowrap" id="linkNav" aria-current="page" href="/views/shop/promociones.php">Promociones</a>
                        </li>
                        <li class="nav-item m-2">
                            <a class="nav-link active text-nowrap" id="linkNav" aria-current="page" href="/views/shop/tienda.php">Tienda</a>
                        </li>
                        <li class="nav-item m-2">
                            <a class="nav-link active text-nowrap" id="linkNavPage" aria-current="page" href="">Libros</a>
                        </li>
                        <li class="nav-item m-2">
                            <a class="nav-link active text-nowrap" id="linkNav" aria-current="page" href="/views/about/about.php">Sobre nosotros</a>
                        </li>
                    </ul>
                    <!-- Botones de Iniciar sesión y Registrarse -->
                    <div class="d-flex">
                        <a class="btn m-2" id="btnMiCuenta" href="/views/login/login.php">Mi cuenta</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

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



        <button id="btnSideBar" type="button" class="d-lg-none" onclick="mostrarOcultar()"><</button>

                <!-- CONTENEDOR -->
                <div class="container text-center">
                    <h2>Hola</h2>
                </div>
    </main>

    <!-- FOOTER -->
    <?php include '../includes/footer.php' ?>

    <!-- SCRIPTS -->
    <script src="../../assets/js/funcionesSideBar.js"></script>
</body>

</html>