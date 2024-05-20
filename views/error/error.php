<?php session_start(); ?>
<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Grow</title>
    <link rel="shortcut icon" href="./assets/img/logo.jpg" type="image/x-icon">
    <!-- Bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Required PHP -->
    <?php
    // require_once './views/includes/fonts.php';
    // require_once './models/producto.php';
    ?>

    <!-- CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/index.css">

</head>

<body>
    <style>
        .volver a {
            padding: 10px;
            text-decoration: none;
            color: #ffffff;
            font-weight: bolder;
            border: 1px solid #507a64;
            background-color: #507a64;
            border-radius: 5px;
        }

        .volver a:hover {
            color: #507a64;
            background-color: #ffffff6f;
            transition: 0.3s all;
        }
    </style>

    <!-- HEADER -->
    <?php include '../includes/header.php'; ?>

    <!-- MAIN -->

    <main class="main mt-4">
        <div class="volver m-4">
            <a href="/index.php">Volver a Inicio</a>
        </div>
        <p class="fs-3 text-warning text-center align-midle ">
            No se pudo establecer la conexión con el servidor, intentelo más tarde
        </p>
    </main>
    <?php include '../includes/footer.php' ?>
</body>

</html>