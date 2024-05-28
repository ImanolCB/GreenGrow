<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Grow - Tienda</title>
    <link rel="shortcut icon" href="./../../assets/img/logo.png" type="image/x-icon">
    <!-- Bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Required php -->
    <?php
    // require_once '../../views/includes/fonts.php';
    require_once './../../models/Planta.php';
    require_once './../../models/conexionBD.php';
    $conn = new ConexionBD();
    ?>

    <!-- Script alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="./../../assets/css/style.css">
    <link rel="stylesheet" href="./../../assets/css/account.css">

</head>

<body>

    <!-- HEADER -->
    <?php include './../includes/header.php'; ?>

    <!-- MAIN -->

    <main class="main">

        <!-- ASIDE -->
        <?php
        /**
         * TODO: PENDIENTE AÑADIR EL FORM CON LAS OPCIONES DE FILTROS CORRESPONDIENTES
         * TODO: PENSAR COMO REALIZAR LA CONSULTA SEGÚN LOS FILTROS SELECCIONADOS
         */
        ?>

<form action="./../../controllers/miControlador.php" method="post" enctype="multipart/form-data" class="bg-dark ">
                <div class="container">
                    <p class="fs-3">Datos para añadir planta</p>
                    <!-- Datos de planta nueva -->
                    <div class="input-group m-3">
                        <input type="text" class="form-control" placeholder="Nombre de planta" name="nombrePlanta" required>
                    </div>
                    <div class="input-group m-3">
                        <input type="file" class="form-control" id="inputGroupFile01" placeholder="Imagen de planta" name="url" required>
                    </div>
                    <button type="submit" name="submit" value="plantaAdd" id="btnPlantaAdd" class="btn position-relative m-4">Añadir planta</button>
                </div>
            </form>
        <section class="container mt-4">
            
            <!-- Search -->
            <div class="input-group m-2 border border-1 w-50 shadow-md">
                <input id="busqueda" type="text" class="form-control" placeholder="Buscar" aria-describedby="button-addon2">
                <!-- <button class="btn btn-outline-secondary" type="button" id="button-addon2">Buscar</button> -->
            </div>
            <!-- Acordeon -->
            <!-- I1 -->
            <div class="accordion accordion-flush mt-4" id="accordionFlushExample">
                <?php 
                    echo Planta::consultarPlantas($conn->conectar_bd(), $_SESSION['user_id'])
                ?>
            </div>

        </section>




    </main>

    <!-- FOOTER -->
    <?php include './../includes/footer.php' ?>

    <!-- SCRIPTS -->
    <script src="./../../assets/js/verAnotacion.js"></script>

</body>

</html>