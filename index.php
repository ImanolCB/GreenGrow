<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Grow</title>
    <link rel="shortcut icon" href="./assets/img/logo.jpg" type="image/x-icon">
    <!-- Bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Required PHP -->
    <?php
    require_once './views/includes/fonts.php';
    require_once './models/producto.php';
    ?>

    <!-- CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/index.css">

</head>

<body>

    <!-- HEADER -->
    <?php include 'views/includes/header.php'; ?>

    <!-- MAIN -->

    <main class="main">
        <section class="parallax">
            <div class="textoTitulo">
                <!-- <h1>Green Grow</h1> -->
                <p class="text-uppercase">Cultiva y dale más vida a tu hogar</p>
            </div>
        </section>
        <section class=" promociones text-center">
            <h3>Promociones</h3>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4  row-cols-xxl-5">

                <?php
                /**
                 * Bucle que genera 5 estructuras de promociones
                 */
                for ($i = 0; $i < 5; $i++) {
                    echo '<div class="col m-10 d-flex justify-content-center">';
                    echo Producto::crearPromocion(
                        "https://images.unsplash.com/photo-1485955900006-10f4d324d411?q=80&w=1472&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                        "Promocion",
                        "Descripcion de prueba del producto"
                    );
                    echo '</div>';
                }
                ?>

            </div>

        </section>

    </main>
    <?php include 'views/includes/footer.php' ?>
</body>

</html>