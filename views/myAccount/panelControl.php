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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Required PHP -->
    <?php
    // require_once './../views/includes/fonts.php';
    require_once './../../models/Usuario.php';
    require_once './../../models/Transaccion.php';
    require_once './../../models/conexionBD.php';
    $conn = new ConexionBD;
    ?>

    <!-- CSS -->
    <link rel="stylesheet" href="./../../assets/css/style.css">
    <link rel="stylesheet" href="./../../assets/css/index.css">

</head>

<body>

    <?php if (isset($_SESSION['mensaje'])) : ?>
        <script>
            Swal.fire({
                position: 'top-start',
                icon: 'success',
                title: '<?php echo $_SESSION['mensaje']; ?>',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
        <?php unset($_SESSION['mensaje']); ?>
    <?php endif; ?>

    <?php

    //Cuando se pulsa cambiar rol
    if (isset($_REQUEST['cambiar'])) {
        $id = intval($_REQUEST['cambiar']);
        Usuario::actualizarRolUsuario($id, $conn->conectar_bd());
        $_SESSION['mensaje'] = 'El rol se ha modificado';
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
    //Cuando se pulsa eliminar usuario
    if (isset($_REQUEST['eliminar'])) {

        $id = intval($_REQUEST['eliminar']);
        Usuario::borrarUsuario($id, $conn->conectar_bd());
        $_SESSION['mensaje'] = 'El usuario se ha eliminado';

        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
    ?>

    <!-- HEADER -->
    <?php include '../includes/header.php'; ?>

    <!-- MAIN -->

    <main class="main mt-4">

        <input type="checkbox" name="TBusuario" id="chUsuario"> Tabla Usuario
        <input type="checkbox" name="TBtransaccion" id="chTransaccion" checked> Tabla Transacciones

        <div class="container d-flex flex-column align-items-center justify-content-center mt-5">
            <h1 class="text-center mb-1">Panel de Control</h1>
            <hr class="w-90">
            <div class="row" id="tablaUsuario">
                <div class="col-md-12">
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
                            <?php echo Usuario::consultarUsuarios($conn->conectar_bd()) ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row" id="tablaTransaccion">
                <div class="col-md-12">
                    <h2 class="text-center">Pedidos</h2>
                    <table class="table table-bordered table-striped">
                        <thead class="thead-custom">
                            <tr>
                                <th>Fecha</th>
                                <th>Email</th>
                                <th>Producto</th>
                                <th>Direccion</th>
                                <th>Cantidad</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody id="ordersTable">
                            <?php echo Transaccion::consultarTransaccion($conn->conectar_bd()) ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>
    <?php include '../includes/footer.php' ?>
</body>

</html>