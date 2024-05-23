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
    // require_once './../../models/Producto.php';
    // // require_once './../../models/conexionBD.php';
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

        <!-- ASIDE -->
        <?php
        /**
         * TODO: PENDIENTE AÑADIR EL FORM CON LAS OPCIONES DE FILTROS CORRESPONDIENTES
         * TODO: PENSAR COMO REALIZAR LA CONSULTA SEGÚN LOS FILTROS SELECCIONADOS
         */
        ?>


        <section class="container mt-4">
            <form action="./../../controllers/miControlador.php" method="post">

                <!-- Search -->
                <div class="input-group m-4">
                    <input id="busqueda" type="text" class="form-control" placeholder="Buscar productos..." aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Buscar</button>
                </div>
                <button type="submit" name="submit" value="plantaAdd" id="btnPlantaAdd" class="btn position-relative m-4">Añadir planta</button>
            </form>
            <!-- Acordeon -->
            <!-- I1 -->
            <div class="accordion accordion-flush mt-4" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-1">
                        <button class="accordion-button collapsed pt-4 fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Mi cactus del balcón
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="container mt-4 ">
                            <h4 class="pt-4 fs-6 ">Anotaciones</h4>
                            <hr>
                            <div class="row justify-content-between text-center">
                                <div class="flex col-sm-8">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Fecha de anotación</th>
                                                <th scope="col">Last</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="ID DE ANOTACION">
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>
                                                    <button class="btn ver m-1" id="btnAnotacion-ID" value="CONTENIDO DE ANOTACION" onclick="ver(this.value)">Ver</button>
                                                    <button class="btn btnRed m-1" id="btnAnotacion" value="Borrar anotacion">Eliminar</button>
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-sm-3">
                                    <img src="https://images.unsplash.com/photo-1560453456-387820618020?q=80&w=2670&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="img-responsive m-3 shadow-md" style="width:100%" alt="Image">
                                </div>
                            </div>
                        </div>
                        <form action="./../../controllers/miControlador.php" method="post">
                            <button type="submit" name="submit" value="plantaDelete" id="btnPlantaDelete" class="btn btnRed position-relative m-4">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
            
        </section>




    </main>

    <!-- FOOTER -->
    <?php include './../includes/footer.php' ?>

    <!-- SCRIPTS -->
    <script src="./../../assets/js/verAnotacion.js"></script>

</body>

</html>