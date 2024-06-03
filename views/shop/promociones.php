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
    <link rel="stylesheet" href="./../../assets/css/promociones.css">

</head>

<body>

    <!-- HEADER -->
    <?php include './../includes/header.php'; ?>

    <!-- MAIN -->
    <main class="main">
        <!-- Video de fondo en bucle -->
        <video class="video-background" autoplay loop muted>
            <source src="https://cdn.pixabay.com/video/2023/11/13/188912-884171167_large.mp4" type="video/mp4">
            Tu navegador no admite el elemento de video.
        </video>

        <!-- CONTENEDOR -->
        <div class="cabecera text-center">
            <h1 class="text-white pt-4 fs-1">Promoción de primavera</h1>
            <p class="m-auto w-75 text-white p-2 fs-4">
                ¡Bienvenida la Primavera con Nuestra Gran Promoción de Plantas! 🌷🌿
            </p>

            <p class="m-auto w-75 text-white p-1 fs-4">
                La primavera está aquí y no hay mejor momento para llenar tu hogar y jardín de vida y color.
                En nuestra tienda online, queremos celebrar esta hermosa temporada contigo ofreciendo una promoción especial en nuestra amplia variedad de plantas.
            </p>
        </div>

        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-3 g-4 justify-content-center">
            <?php
            $conn = new ConexionBD;
            echo Producto::crearPromocion($conn->conectar_bd(), 0);
            ?>
        </div>

    </main>

    <!-- FOOTER -->
    <?php include './../includes/footer.php' ?>

    <!-- SCRIPTS -->
    <script src="./../../assets/js/funcionesSideBar.js"></script>
</body>

</html>