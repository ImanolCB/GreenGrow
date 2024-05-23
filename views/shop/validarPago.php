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
    require_once './../../models/Producto.php';
    require_once './../../models/carro.php';
    require_once './../../models/conexionBD.php';
    ?>

    <!-- CSS -->
    <link rel="stylesheet" href="./../../assets/css/style.css">
    <link rel="stylesheet" href="./../..//assets/css/index.css">

</head>

<body>

    <!-- HEADER -->
    <?php include './../includes/header.php'; ?>

    <!-- MAIN -->

    <main class="main mt-4">
        <p>Fecha de entrega aproximada:
            <?php
            $fecha_actual = new DateTime();
            $fecha_actual->modify('+7 days');
            $fecha_formateada = $fecha_actual->format('d/m/Y');
            echo $fecha_formateada;
            ?>
        </p>
        <hr>

        <form action="./../../controllers/miControlador.php" method="post">
            <button type="submit" name="submit" value="Volver a tienda" id="btnVolverTienda" class="btn position-relative m-4">Volver</button>
        </form>



    </main>
    <?php include './../includes/footer.php' ?>
</body>

</html>