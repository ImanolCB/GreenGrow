<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Grow - Tienda</title>
    <link rel="shortcut icon" href="./../../assets/img/logo.jpg" type="image/x-icon">
    <!-- Bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Required php -->
    <?php
    require_once './../../views/includes/fonts.php';
    require_once './../../models/Producto.php';
    require_once './../../models/carro.php';
    require_once './../../models/conexionBD.php';

    ?>

    <!-- Script PayPal y alert-->
    <script src="https://www.paypal.com/sdk/js?client-id=AXtYoa5e_weOoyVnQSHGrsJcwWpN__WLAzF0f7a0XULa3gfAsgy0UFGw92cxLiaKaNWMZsts9L9PdWS-&currency=EUR"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="./../../assets/css/style.css">
    <link rel="stylesheet" href="./../../assets/css/tienda.css">

</head>

<body>

    <!-- HEADER -->
    <?php include './../includes/header.php'; ?>

    <main>
        <div class="container p-4">

            <form action="./../../controllers/miControlador.php" method="post">
                <button type="submit" name="submit" value="Volver a tienda" id="btnVolverTienda" class="btn position-relative m-4">Volver</button>
            </form>

            <div class="row p-5 ">
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3"> <span class="text-muted">Carrito</span> <span class="badge badge-secondary badge-pill">3</span> </h4>
                    <ul class="list-group mb-3">

                        <?php
                        $conn = new ConexionBD;
                        $listaProductos = Producto::consultarProductos($conn->conectar_bd());
                        //Array que almacena los objetos de productos que se tienen que pintar
                        $productosCarrito = [];

                        if (isset($_SESSION['carrito'])) {
                            //Doble bucle para comparar los id con los productos diponibles 
                            foreach ($listaProductos as $producto)
                                foreach ($_SESSION['carrito'] as $idProducto) {
                                    if ($idProducto == $producto->id_producto) {
                                        array_push($productosCarrito, $producto);
                                    }
                                }
                        }
                        //Método para imprimir la estructura HTML con los datos de productos y calcular el total
                        $carrito = Carro::mostrarProductoCarroPorId($productosCarrito);
                        echo $carrito[0];
                        ?>

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
                    <form id="autoForm" action="./../../controllers/miControlador.php" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">Nombre de pila</label>
                                <input type="text" class="form-control" id="firstName" placeholder="Nombre" name="nombre" required>
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName">Apellido</label>
                                <input type="text" class="form-control" id="lastName" placeholder="Apellido" name="apellido" required>
                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['usermail'] ?>" placeholder="tu@ejemplo.com" required>
                            <div class="invalid-feedback">
                                Please enter a valid email address for shipping updates.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address">Dirección</label>
                            <input type="text" class="form-control" id="address" placeholder="1234 calle principal, Ciudad" name="direccion" required>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>
                        <div class="mb-5">
                            <label for="address2">Provincia</label>
                            <input type="text" class="form-control" id="address2" name="provincia" value="Cantabria" placeholder="Cantabria" required>
                        </div>

                        <img src="./../../assets/img/carrito.gif" class="m-2" width="150" alt="Carro de compras">
                        <h4 class="mb-3 mt-4">Pago</h4>
                        <hr class="mb-4">
                    </form>


                    <!-- PayPal -->
                    <div id="paypal-button-container" class="mt-4"></div>
                    <?php
                    $pagoRealizado = false
                    ?>
                    <script>
                        paypal.Buttons({
                            style: {
                                color: 'blue',
                                shape: 'pill',
                                label: 'pay'
                            },
                            createOrder: function(data, actions) {
                                return actions.order.create({
                                    purchase_units: [{
                                        amount: {
                                            value: <?php echo (float)$carrito[1] ?>
                                        }
                                    }]
                                });
                            },
                            onApprove: function(data, actions) {

                                let productosCarrito = <?php $productosCarrito ?>
                                actions.order.capture().then(function(detalles) {

                                    console.log(detalles);
                                    console.log(<?php echo $_SESSION['user_id'] ?>);

                                    //Alerta de compra realizada
                                    Swal.fire({
                                        position: "center",
                                        icon: "success",
                                        title: "Your work has been saved",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });

                                    return fetch('./../../controllers/miControladorPago.php', {
                                        method: 'post',
                                        headers: {
                                            'content-type': 'application/json'
                                        },
                                        body: JSON.stringify({
                                            detalles: detalles,
                                            direccion: document.getElementById('address').value,
                                            provincia: document.getElementById('address2').value,
                                            productosCarrito: productosCarrito
                                        })
                                    })

                                    $_POST['direccion'] = document.getElementById('address').value;
                                    $_POST['provincia'] = document.getElementById('address2').value;
                                    // document.addEventListener("DOMContentLoaded", function() {
                                    //     document.getElementById('autoForm').submit();
                                    // });
                                    // Redirige a la página de confirmación
                                    window.location.href = "./../../controllers/miControladorPago.php";
                                })

                            },

                            onCancel: function(data) {
                                alert('Pago cancelado')
                                console.log(data);
                            }
                        }).render('#paypal-button-container')
                    </script>
                </div>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <?php include './../includes/footer.php' ?>

    <!-- SCRIPTS -->
    <script src="./../../assets/js/funcionesSideBar.js"></script>

</body>

</html>