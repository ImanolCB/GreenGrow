<?php session_start(); ?>
<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Grow - Panel de Administración</title>
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

    //Cuando se pulsa editar producto
    if (isset($_REQUEST['cambiar'])) {
        $id = intval($_REQUEST['cambiar']);
        Usuario::actualizarRolUsuario($id, $conn->conectar_bd());
        $_SESSION['mensaje'] = 'El rol se ha modificado';
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
    //Cuando se pulsa eliminar producto
    if (isset($_REQUEST['eliminar'])) {

        $id = intval($_REQUEST['eliminar']);
        Usuario::borrarUsuario($id, $conn->conectar_bd());
        $_SESSION['mensaje'] = 'El usuario se ha eliminado';

        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
    //Cuando se añade un producto
    if (isset($_REQUEST['enviar'])) {

        $id = intval($_REQUEST['enviar']);
        echo Producto::insertarProducto($conn->conectar_bd(), $nombreProducto, $descripcionProducto, $alturaProducto, $epocaProducto, $tipoProducto, $cuidadoProducto, $precioProducto, $promocionProducto, $urlProducto);
        $_SESSION['mensaje'] = 'La transaccion se ha realizado';

        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
    ?>

    <!-- HEADER -->
    <?php include './../includes/header.php'; ?>

    <!-- MAIN -->

    <main class="main mt-4">
        <div class="container d-flex flex-column  justify-content-between">
            <form action="./../../controllers/miControlador.php" method="post">
                <button type="submit" name="submit" value="Volver a panel" class="btn btn-primary">Volver a panel de control</button>
            </form>

            <div class="text-end mt-4">
                <h1 class="text-center mb-1">Panel de administración</h1>
            </div>


        </div>
        <hr class="container w-90">

        <!-- Formulario para añadir producto -->
        <div class="container">
            <form class="row g-3">

                <!-- Nombre -->
                <div class="col-md-6 m-2">
                    <label for="nombreProducto" class="form-label">Nombre Planta</label>
                    <input type="text" class="form-control" id="nombreProducto">
                </div>
                <!-- Cuidado -->
                <div class="col-md-3 m-2">
                    <label for="inputState" class="form-label">Nivel de cuidado</label>
                    <select id="inputState" class="form-select">
                        <option name='cuidadoProducto'></option>
                        <option name='cuidadoProducto'>Sencillo</option>
                        <option name='cuidadoProducto'>Moderado</option>
                        <option name='cuidadoProducto'>Complejo</option>
                    </select>
                </div>
                <!-- Tipo -->
                <div class="col-md-3  m-2">
                    <label for="inputState" class="form-label">Tipo de producto</label>
                    <select id="inputState" class="form-select">
                        <option name='tipoProducto'></option>
                        <option name='tipoProducto' value='flor'>Flor</option>
                        <option name='tipoProducto' value='exotica'>Exótica</option>
                        <option name='tipoProducto' value='interior'>Interior</option>
                        <option name='tipoProducto' value='arbol'>Arbol</option>
                        <option name='tipoProducto' value='cactus'>Cactus</option>
                    </select>
                </div>
                <!-- Descripcion -->
                <div class="col-md-12 m-2">
                    <label for="inputState" class="form-label">Descripción</label>
                    <div class="input-group">
                        <textarea class="form-control" name="descripcionProducto" placeholder="Máximo 500 palabras"></textarea>
                    </div>
                </div>
                <!-- Epoca -->
                <div class="col-md-3 m-2">
                    <label for="inputState" class="form-label">Epoca de floración</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="epocaProducto[]" value="primavera" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Primavera</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="epocaProducto[]" value="verano" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Verano</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="epocaProducto[]" value="otoño" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Otoño</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="epocaProducto[]" value="invierno" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Invierno</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="inputCity" class="form-label">City</label>
                    <input type="text" class="form-control" id="inputCity">
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">State</label>
                    <select id="inputState" class="form-select">
                        <option selected>Choose...</option>
                        <option>...</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="inputZip" class="form-label">Zip</label>
                    <input type="text" class="form-control" id="inputZip">
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Check me out
                        </label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </div>
            </form>
        </div>


        <!-- Muestra de productos de base de datos -->
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
                            <?php echo Producto::insertarProducto($conn->conectar_bd(), $nombreProducto, $descripcionProducto, $alturaProducto, $epocaProducto, $tipoProducto, $cuidadoProducto, $precioProducto, $promocionProducto, $urlProducto) ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>
    <?php include './../includes/footer.php' ?>
    <script src="./../../assets/js/tablasPanel.js"></script>
    <script src="./../../assets/js/inputSearch.js"></script>


</body>

</html>