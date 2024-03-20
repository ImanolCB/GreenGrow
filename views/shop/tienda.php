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

    <!-- CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/tienda.css">

</head>

<body>
    <?php /*include 'views/includes/header.php' */
    require_once './../../models/Producto.php';
    ?>

    <!-- HEADER -->

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    <img src="/assets/img/logo.jpg" alt="logo" width="80" height="80">
                </a>
                <!-- <a class="navbar-brand fs-3 fw-bolder text-success" href="#">GreenGrow</a> -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 fs-5 ">
                        <li class="nav-item m-2">
                            <a class="nav-link active text-nowrap" id="linkNav" aria-current="page" href="#">Promociones</a>
                        </li>
                        <li class="nav-item m-2">
                            <a class="nav-link active text-nowrap" id="linkNav" aria-current="page" href="#">Tienda</a>
                        </li>
                        <li class="nav-item m-2">
                            <a class="nav-link active text-nowrap" id="linkNav" aria-current="page" href="#">Libros</a>
                        </li>
                        <li class="nav-item m-2">
                            <a class="nav-link active text-nowrap" id="linkNav" aria-current="page" href="#">Sobre nosotros</a>
                        </li>
                    </ul>
                    <!-- Botones de Iniciar sesión y Registrarse -->
                    <div class="d-flex">
                        <a class="btn m-2" id="btnMiCuenta" href="/views/login/login.php">Mi cuenta</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- MAIN -->

    <main class="main">

        <!-- ASIDE -->
        <?php 
        /**
         * TODO: PENDIENTE AÑADIR EL FORM CON LAS OPCIONES DE FILTROS CORRESPONDIENTES
         * TODO: PENSAR COMO REALIZAR LA CONSULTA SEGÚN LOS FILTROS SELECCIONADOS
         */
        ?>

        <div class="d-flex flex-column flex-shrink-0 p-3 bg-light aside" style="width: 280px;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <span class="fs-4">Filtros</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <label for="precio" class="col-form-label col-sm-10"><b>Precio</b></label>
                    <div class="col-sm-12 d-flex justify-content-evenly ">
                        <input type="range" id="precio" name="precio" min="0" max="200">
                        <p id="precioMostrado" class="m-0 precioMostrado">0</p>
                    </div>
                    <script>
                        const rango = document.querySelector("#precio");
                        const precioMostrado = document.querySelector("#precioMostrado");

                        rango.addEventListener("input", (e) => {
                            precioMostrado.textContent = rango.value;
                        })
                    </script>
                </li>
                <br>
                <li>
                    <label for="tipo" class="col-form-label col-sm-10"><b>Tipo</b></label>
                    <div class="col-sm-8 flex-column "><br>
                        <div class="d-flex justify-content-left">
                            <input type="checkbox" id="tipo" name="tipo" value="arbol"><br>
                            <label class="m-1">Arbol</label>
                        </div>

                        <div class="d-flex justify-content-left">
                            <input type="checkbox" id="tipo" name="tipo" value="arbusto"><br>
                            <label class="m-1">Arbusto</label>
                        </div>
                        <div class="d-flex justify-content-left">
                            <input type="checkbox" id="tipo" name="tipo" value="cactus"><br>
                            <label class="m-1">Cactus</label>
                        </div>

                        <div class="d-flex justify-content-left">
                            <input type="checkbox" id="tipo" name="tipo" value="flor"><br>
                            <label class="m-1">Flor</label>
                        </div>

                        <div class="d-flex justify-content-left">
                            <input type="checkbox" id="tipo" name="tipo" value="exotica"><br>
                            <label class="m-1">Planta exótica</label>
                        </div>

                        <div class="d-flex justify-content-left">
                            <input type="checkbox" id="tipo" name="tipo" value="interior"><br>
                            <label class="m-1">Planta interior</label>
                        </div>

                    </div>
                </li>

                <li>
                    <label for="tipo" class="col-form-label col-sm-10"><b>Cuidado</b></label>
                </li>
                <li>
                    <label for="tipo" class="col-form-label col-sm-10"><b>Epoca de floración</b></label>
                </li>
            </ul>
            <hr>
        </div>


        <!-- CONTENEDOR -->


    </main>

    <!-- FOOTER -->
    <?php include '../includes/footer.php' ?>
</body>

</html>