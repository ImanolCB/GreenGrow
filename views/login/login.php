<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Grow</title>
    <link rel="shortcut icon" href="/assets/img/logo.jpg" type="image/x-icon">
    <!-- Bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Required PHP -->
    <?php
    require_once '../../views/includes/fonts.php';
    ?>

    <!-- CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/login.css">

</head>

<body>

    <!-- HEADER -->
    <?php include '../includes/header.php'; ?>


    <!-- MAIN -->

    <main class="main">
        <section>
            <div class="volver">
                <a href="/index.php">Volver a Inicio</a>
            </div>
            <form class="form-login" action="./../../controllers/miControlador.php" method="post">
                <fieldset>
                    <legend>Inicio de sesión</legend>
                    <hr><br>
                    <div class="mb-3 row">
                        <label for="emailLogin" class="col-form-label col-sm-4">E-mail</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="emailLogin" name="emailLogin" placeholder="ejemplo@gmail.com">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="passwordLogin" class="col-form-label col-sm-4">Contraseña</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="passwordLogin" name="passwordLogin" placeholder="Contraseña">
                        </div>
                    </div>
                    <div class="btnRegistro">
                        <a href="registro.php">Registrarme</a>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 offset-sm-4">
                            <button type="submit" name="submit" value="Iniciar sesion" class="btn btn-primary">Iniciar sesion</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </section>
        <!-- <aside class="imagenAside"></aside> -->
    </main>

    <!-- FOOTER -->


    <?php include '../includes/footer.php'; ?>
</body>

</html>