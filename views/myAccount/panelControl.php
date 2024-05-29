<?php session_start(); ?>
<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Grow - Panel de Control</title>
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
    <!-- Mensaje de alerta -->
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
    //Cuando se cambia el estado de transaccion
    if (isset($_REQUEST['enviar'])) {

        $id = intval($_REQUEST['enviar']);
        Transaccion::actualizarEstadoTransaccion($id, $conn->conectar_bd());
        $_SESSION['mensaje'] = 'La transaccion se ha realizado';

        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
    ?>

    <!-- HEADER -->
    <?php include './../includes/header.php'; ?>

    <!-- MAIN -->

    <main class="main mt-4">
        <div class="container d-flex flex-row  justify-content-between">

            <div class="text-end">
                <h1 class="text-center mb-1">Panel de Control</h1>
            </div>

            <form action="./../../controllers/miControlador.php" method="post">
                <button type="submit" name="submit" value="administrarProductos" class="btn btn-primary">Administrar Productos</button>
            </form>
            
        </div>
        <hr class="container w-90">

        <div class="container mt-4">
            <div class="d-flex flex-row justify-content-between">
                <!-- Buscador -->
                <div class="input-group">
                    <input id="busqueda" type="text" class="form-control m-3" placeholder="Buscar" aria-describedby="button-addon2">
                </div>
                <input type="checkbox" class="btn-check" id="chUsuario" checked autocomplete="off">
                <label class="btn m-2" id="lbUsuario" for="chUsuario">No ver usuarios</label>
                <input type="checkbox" class="btn-check" id="chTransaccion" checked autocomplete="off">
                <label class="btn m-2" id="lbTransaccion" for="chTransaccion">No ver transacciones</label>
            </div>


        </div>

        <div id="contenedor" class="container d-flex flex-column align-items-left mt-2">
            <div class="row" id="tablaUsuario">
                <div class="col-md-12">
                    <h2 class="text-left text-secondary">Usuarios</h2>
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
                    <h2 class="text-left text-secondary">Pedidos</h2>

                    <?php echo Transaccion::consultarTransaccion($conn->conectar_bd()) ?>

                </div>
            </div>
        </div>

    </main>
    <?php include './../includes/footer.php' ?>
    <script src="./../../assets/js/tablasPanel.js"></script>
    <script src="./../../assets/js/inputSearch.js"></script>


</body>

</html>