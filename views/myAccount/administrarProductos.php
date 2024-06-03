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
    require_once './../../models/Usuario.php';
    require_once './../../models/Producto.php';
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
    if (isset($_REQUEST['actualizar'])) {
        $id = intval($_REQUEST['actualizar']);
        $nombreProducto = $_REQUEST['nombreProducto'];
        $descripcionProducto = $_REQUEST['descripcionProducto'];
        $alturaProducto = intval($_REQUEST['alturaProducto']);
        $epocaProducto = $_REQUEST['epocaProducto'];
        $tipoProducto = $_REQUEST['tipoProducto'];
        $cuidadoProducto = $_REQUEST['cuidadoProducto'];
        $precioProducto = floatval($_REQUEST['precioProducto']);
        $promocionProducto = $_REQUEST['promocionProducto'];
        $urlProducto = $_REQUEST['urlProducto'];

        if ($nombreProducto != null && $nombreProducto != null && $descripcionProducto != null && $alturaProducto != null && $epocaProducto != null && $tipoProducto != null && $cuidadoProducto != null && $precioProducto != null && $promocionProducto != null && $urlProducto != null) {
            Producto::actualizarDato($conn->conectar_bd(), $id, $nombreProducto, $descripcionProducto, $alturaProducto, $epocaProducto, $tipoProducto, $cuidadoProducto, $precioProducto, $promocionProducto, $urlProducto);
            $_SESSION['mensaje'] = 'El producto se ha actualizado correctamente';
        }else{
            $_SESSION['error'] = 'Los campos no pueden estar vacíos';
        }
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }

    //Cuando se pulsa eliminar producto
    if (isset($_REQUEST['borrarProducto'])) {

        $id = intval($_REQUEST['borrarProducto']);
        Producto::borrarProducto($conn->conectar_bd(), $id);
        $_SESSION['mensaje'] = 'El producto se ha eliminado';
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }

    //Cuando se añade un producto
    if (isset($_REQUEST['anadir'])) {

        $nombreProducto = $_REQUEST['nombreProducto'];
        $descripcionProducto = $_REQUEST['descripcionProducto'];
        $alturaProducto = intval($_REQUEST['alturaProducto']);
        $epocaProducto = $_REQUEST['epocaProducto'];
        $tipoProducto = $_REQUEST['tipoProducto'];
        $cuidadoProducto = $_REQUEST['cuidadoProducto'];
        $precioProducto = floatval($_REQUEST['precioProducto']);
        $promocionProducto = $_REQUEST['promocionProducto'];
        $urlProducto = $_REQUEST['urlProducto'];

        if ($nombreProducto != null && $nombreProducto != null && $descripcionProducto != null && $alturaProducto != null && $epocaProducto != null && $tipoProducto != null && $cuidadoProducto != null && $precioProducto != null && $promocionProducto != null && $urlProducto != null) {
            echo Producto::insertarProducto($conn->conectar_bd(), $nombreProducto, $descripcionProducto, $alturaProducto, $epocaProducto, $tipoProducto, $cuidadoProducto, $precioProducto, $promocionProducto, $urlProducto);
            $_SESSION['mensaje'] = 'El producto se ha añadido correctamente';
        } else {
            $_SESSION['error'] = 'Los campos no pueden estar vacíos';
        }

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
        <div class="container">
            <!-- Mensaje de error -->
            <?php if (isset($_SESSION['error'])) :
                echo "
                <div class='alert alert-danger' role='alert'>
                    " . $_SESSION['error'] . "
                </div>
                ";
                unset($_SESSION['error']); ?>
            <?php endif; ?>
        </div>


        <!-- Formulario para añadir producto -->
        <div class="container bg-dark rounded text-white shadow-md">
            <form action="./../../views/myAccount/administrarProductos.php" class="row g-1 p-2" method="post">
                <!-- Nombre -->
                <div class="col-md-6 m-2">
                    <label for="nombreProducto" class="form-label">Nombre Planta</label>
                    <input type="text" class="form-control" name="nombreProducto" id="nombreProducto">
                </div>

                <!-- Cuidado -->
                <div class="col-md-2 m-2">
                    <label for="inputState" class="form-label">Nivel de cuidado</label>
                    <select id="inputState" name="cuidadoProducto" class="form-select">
                        <option value=""></option>
                        <option value="sencillo">Sencillo</option>
                        <option value="moderado">Moderado</option>
                        <option value="complejo">Complejo</option>
                    </select>
                </div>
                <!-- Tipo -->
                <div class="col-md-2  m-2">
                    <label for="inputState" class="form-label">Tipo de producto</label>
                    <select id="inputState" class="form-select" name="tipoProducto">
                        <option></option>
                        <option value='flor'>Flor</option>
                        <option value='exotica'>Exótica</option>
                        <option value='interior'>Interior</option>
                        <option value='arbol'>Arbol</option>
                        <option value='cactus'>Cactus</option>
                    </select>
                </div>
                <!-- Descripcion -->
                <div class="col-md-12 m-2">
                    <label for="inputState" class="form-label">Descripción</label>
                    <div class="input-group">
                        <textarea class="form-control" name="descripcionProducto" placeholder="Máximo 500 palabras"></textarea>
                    </div>
                </div>

                <!-- Promocion -->
                <div class="col-md-3">
                    <label for="inputState" class="form-label">Promoción de producto</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="promocionProducto" id="promocionProducto" value="si">
                        <label class="form-check-label" for="promocionProducto">
                            Sí, se promociona
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="promocionProducto" id="promocionProducto" value="no" checked>
                        <label class="form-check-label" for="promocionProducto">
                            No, no se promociona
                        </label>
                    </div>
                </div>

                <!-- Epoca -->
                <div class="col-md-2 m-2">
                    <label for="inputState" class="form-label">Época de floración</label>
                    <select id="inputState" name="epocaProducto" class="form-select">
                        <option value="primavera">Primavera</option>
                        <option value="verano">Verano</option>
                        <option value="otoño">Otoño</option>
                        <option value="invierno">Invierno</option>
                    </select>
                </div>

                <!-- Altura -->
                <div class="col-md-2">
                    <label for="alturaProducto" class="form-label">Altura</label>
                    <input type="text" class="form-control" name="alturaProducto" id="alturaProducto" placeholder="En centímetros">
                </div>

                <!-- Precio -->
                <div class="col-md-3">
                    <label for="precioProducto" class="form-label">Precio</label>
                    <input type="text" class="form-control" name="precioProducto" id="precioProducto" placeholder="En euros">
                </div>

                <!-- URL -->
                <div class="col-md-10 m-2">
                    <label for="urlProducto" class="form-label">URL de imagen de planta</label>
                    <input type="text" name="urlProducto" class="form-control" id="urlProducto">
                </div>
                <button type="submit" name="anadir" value="anadir" class="btn btn-primary w-50 m-auto my-4 p-2">Añadir producto</button>
            </form>
        </div>


        <!-- Muestra de productos de base de datos -->

        <div id="contenedor" class="container d-flex flex-column align-items-left mt-5 shadow-md">
            <div class="row" id="tablaUsuario">
                <div class="col-md-12">
                    <h2 class="text-left text-secondary">Productos</h2>
                    <table class="table table-bordered table-striped p-2">
                        <thead class="thead-custom">
                            <tr>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Altura (cm)</th>
                                <th>Epoca</th>
                                <th>Tipo</th>
                                <th>Cuidado</th>
                                <th>Precio(€)</th>
                                <th>Promocionado</th>
                            </tr>
                        </thead>
                        <tbody id="usersTable">
                            <?php echo Producto::consultarProductosAdministrados($conn->conectar_bd()) ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>
    <?php include './../includes/footer.php' ?>
    <!-- <script src="./../../assets/js/tablasPanel.js"></script> -->
    <!-- <script src="./../../assets/js/inputSearch.js"></script> -->


</body>

</html>