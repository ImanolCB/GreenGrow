<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Grow - Promociones</title>
    <link rel="shortcut icon" href="./../../assets/img/logo.png" type="image/x-icon">
    <!-- Bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Required PHP -->
    <?php 
        require_once './../../views/includes/fonts.php';
        require_once './../../models/Producto.php';
        require_once './../../models/conexionBD.php';

    ?>

    <!-- CSS -->
    <link rel="stylesheet" href="./../../assets/css/style.css">
    <link rel="stylesheet" href="./../../assets/css/tienda.css">

</head>

<body>

    <!-- HEADER -->
    <?php include './../includes/header.php';?>

    <!-- MAIN -->

    <main class="main">

        <!-- ASIDE -->
        <?php
        /**
         * TODO: PENDIENTE AÑADIR EL FORM CON LAS OPCIONES DE FILTROS CORRESPONDIENTES
         * TODO: PENSAR COMO REALIZAR LA CONSULTA SEGÚN LOS FILTROS SELECCIONADOS
         */
        ?>

        <button id="btnSideBar" type="button" class="d-lg-none" onclick="mostrarOcultar()"><</button>

                <!-- CONTENEDOR -->
                <div class="container text-center">
                    <h2>En desarrollo ...</h2>
                    <div class="m-auto gap-2 justify-content-evenly row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4  row-cols-xxl-5">
                <?php
                /**
                 * Bucle que genera 5 estructuras de promociones
                 */
                $conn = new ConexionBD;
                    echo Producto::crearPromocion($conn->conectar_bd(),0);
                ?>
            </div>
                </div>
    </main>

    <!-- FOOTER -->
    <?php include './../includes/footer.php' ?>

    <!-- SCRIPTS -->
    <script src="./../../assets/js/funcionesSideBar.js"></script>
</body>

</html>