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

    <main>
        <?php
        //Recorre el array de ID's de productos
        foreach ($_SESSION['carrito'] as $productoId) {
            echo "ID del producto: " . $productoId . "<br>";
        }
        echo "</br> " . "EMAIL " . $_SESSION['usermail'];
        echo "</br> " . "ROL " . $_SESSION['user_rol'];
        ?>
    </main>

    <!-- FOOTER -->
    <?php include '../includes/footer.php' ?>

    <!-- SCRIPTS -->
    <script src="../../assets/js/funcionesSideBar.js"></script>

</body>

</html>