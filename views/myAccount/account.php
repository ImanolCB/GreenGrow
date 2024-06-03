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

        <!-- Mensaje de alerta -->
        <?php if (isset($_SESSION['mensaje'])) : ?>
            <script>
                Swal.fire({
                    position: 'top-start',
                    icon: 'success',
                    title: "<?php echo $_SESSION['mensaje']; ?>",
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
            <?php unset($_SESSION['mensaje']); ?>
        <?php endif; ?>

        <!-- Mensaje de error -->
        <?php if (isset($_SESSION['error'])) : ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "<?php echo $_SESSION['error'] ?>"
                });
            </script>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php

        //Cuando se pulsa añadir anotacion
        if (isset($_REQUEST['anadirAnotacion'])) {
            $id = intval($_REQUEST['anadirAnotacion']);
            $nota = $_REQUEST['anotacion'];
            if ($nota != '') {
                Anotacion::anadirAnotacion($conn->conectar_bd(), $nota, date('Y-m-d'), $id);
                $_SESSION['mensaje'] = 'La anotacion se ha añadida';
                header('Location: ' . $_SERVER['PHP_SELF']);
                exit();
            } else {
                $_SESSION['error'] = 'Debe rellenar el campo de texto';
                header('Location: ' . $_SERVER['PHP_SELF']);
                exit();
            }
        }

        //Cuando se pulsa borrar anotacion
        if (isset($_REQUEST['borrarAnotacion'])) {
            $id = intval($_REQUEST['borrarAnotacion']);
            Anotacion::eliminarAnotacion($conn->conectar_bd(), $id);
            $_SESSION['mensaje'] = 'La anotacion se ha eliminado';
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        }

        //Cuando se pulsa borrar planta
        if (isset($_REQUEST['borrarPlanta'])) {
            $id = intval($_REQUEST['borrarPlanta']);
            Planta::borrarPlanta($conn->conectar_bd(), $id);
            $_SESSION['mensaje'] = 'La planta se ha eliminado';
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        }
        ?>


        <div class="cabecera p-4">
            <div class="container">
                <p class="fs-3 w-50">Mis plantas</p>
                <p class="w-50">En este apartado podrás llevar un registro de tus propias plantas del hogar,
                    añadiendo notas sobre cualquier cosa que quieras anotar del mantenimiento de tus plantas
                </p>
            </div>
        </div>

        <form action="./../../controllers/miControlador.php" method="post" enctype="multipart/form-data" class="bg-dark d-flex">
            <div class="container p-2">
                <!-- Datos de planta nueva -->
                <div class="input-group m-3">
                    <input type="text" class="form-control" placeholder="Nombre de planta" name="nombrePlanta">
                </div>
                <div class="input-group m-3">
                    <input type="file" class="form-control" id="inputGroupFile01" placeholder="Imagen de planta" name="url">
                </div>
                <button type="submit" name="submit" value="plantaAdd" id="btnPlantaAdd" class="btn position-relative m-4">Añadir planta</button>
            </div>
        </form>
        <section class="container mt-4">

            <!-- Acordeon -->
            <!-- I1 -->
            <div class="accordion accordion-flush m-4" id="accordionFlushExample">
                <?php
                echo Planta::consultarPlantas($conn->conectar_bd(), $_SESSION['user_id'])
                ?>
            </div>

        </section>




    </main>

    <!-- FOOTER -->
    <?php include './../includes/footer.php' ?>

</body>

</html>