<?php session_start(); ?>
<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Grow</title>
    <link rel="shortcut icon" href="./../../assets/img/logo.png" type="image/x-icon">
    <!-- Bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Required PHP -->
    <?php
    // require_once './../views/includes/fonts.php';
    require_once './../../models/Usuario.php';
    require_once './../../models/conexionBD.php';
    $conn = new ConexionBD;
    ?>

    <!-- CSS -->
    <link rel="stylesheet" href="./../../assets/css/style.css">
    <link rel="stylesheet" href="./../../assets/css/index.css">

</head>

<body>

    <!-- HEADER -->
    <?php include '../includes/header.php'; ?>

    <!-- MAIN -->

    <main class="main mt-4">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Panel de Control</h1>
        <div class="row">
            <div class="col-md-6">
                <h2 class="text-center">Usuarios</h2>
                <table class="table table-bordered table-striped">
                    <thead class="thead-custom">
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Registrado</th>
                        </tr>
                    </thead>
                    <tbody id="usersTable">
                        <?php echo Usuario::consultarUsuarios($conn->conectar_bd())?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <h2 class="text-center">Pedidos</h2>
                <table class="table table-bordered table-striped">
                    <thead class="thead-custom">
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Direccion</th>
                            <th>Provincia</th>
                            <th>Fecha</th>
                            <th>Cantidad</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody id="ordersTable">
                        <!-- Datos de pedidos serán insertados aquí -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        
    </main>
    <?php include '../includes/footer.php' ?>
</body>

</html>