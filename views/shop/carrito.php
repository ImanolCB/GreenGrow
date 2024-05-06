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
        <div class="container p-4">
            <div class="row p-5 ">
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3"> <span class="text-muted">Carrito</span> <span class="badge badge-secondary badge-pill">3</span> </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Nombre del producto</h6>
                                <small class="text-muted">Breve descripción</small>
                            </div> <span class="text-muted">$12</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">segundo producto</h6>
                                <small class="text-muted">Breve descripción</small>
                            </div> <span class="text-muted">$8</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">tercer artículo</h6>
                                <small class="text-muted">Breve descripción</small>
                            </div> <span class="text-muted">$5</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <div class="text-success">
                                <h6 class="my-0">Código promocional</h6>
                                <small>CÓDIGO DE EJEMPLO</small>
                            </div> <span class="text-success">-$5</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between"> <span>Total (€)</span> <strong>$20</strong> </li>
                    </ul>
                    <form class="card p-2">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Código promocional">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary">Aplicar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-8 order-md-1">
                    <h4 class="mb-3">Dirección de Envio</h4>
                    <form class="needs-validation" novalidate="">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">Nombre de pila</label>
                                <input type="text" class="form-control" id="firstName" placeholder="Nombre" value="" required="">
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName">Apellido</label>
                                <input type="text" class="form-control" id="lastName" placeholder="Apellido" value="" required="">
                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" placeholder="tu@ejemplo.com">
                            <div class="invalid-feedback">
                                Please enter a valid email address for shipping updates.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address">Dirección</label>
                            <input type="text" class="form-control" id="address" placeholder="1234 calle principal" required="">
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address2">Provincia</label>
                            <input type="text" class="form-control" id="address2" placeholder="apartamento o suite">
                        </div>
                        <h4 class="mb-3">Pago</h4>
                        <div class="d-block my-3">
                            <div class="custom-control custom-radio">
                                <input id="credit" name="paymentMethod" type="radio" disabled class="custom-control-input">
                                <label class="custom-control-label" for="credit">Tarjeta de crédito</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="debit" name="paymentMethod" type="radio" disabled class="custom-control-input" >
                                <label class="custom-control-label" for="debit">Tarjeta de débito</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" checked="" required="">
                                <label class="custom-control-label" for="paypal">Paypal</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cc-name">Nombre en la tarjeta</label>
                                <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                                <small class="text-muted">Nombre completo como se muestra en la tarjeta</small>
                                <div class="invalid-feedback">
                                    Name on card is required
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cc-number">Número de Tarjeta de Crédito</label>
                                <input type="text" class="form-control" id="cc-number" placeholder="" required="">
                                <div class="invalid-feedback">
                                    Credit card number is required
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="cc-expiration">Vencimiento</label>
                                <input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
                                <div class="invalid-feedback">
                                    Expiration date required
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="cc-cvv">CVV</label>
                                <input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                                <div class="invalid-feedback">
                                    Security code required
                                </div>
                            </div>
                        </div>
                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Continuar a la comprobación</button>
                    </form>
                </div>
            </div>
        </div>




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