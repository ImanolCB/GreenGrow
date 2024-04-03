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

<<<<<<< HEAD
    <?php 
        require_once '../../views/includes/fonts.php';
    ?>
=======
    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

>>>>>>> beb3957

    <!-- CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/registro.css">

</head>

<body>
    <?php
    /*
    include '../includes/header.php'; 
     TODO AÑADIR LOS ENLACES A INICIO EN CADA LOGO DEL NAV
    */ ?>

    <!-- HEADER -->

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    <img src="/assets/img/logo.jpg" alt="logo" width="80" height="80">
                </a>
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
                    <?php
                    /**
                     * TODO: COMPROBAR SI EL USUARIO ESTA REGISTRADO O NO MOSTRAR EL BOTÓN DE MI CUENTA
                     */
                    ?>
                    <!-- <div class="d-flex">
                        <a class="btn m-2" id="btnMiCuenta" href="/views/login/login.php">Mi cuenta</a>
                    </div> -->
                </div>
            </div>
        </nav>
    </header>

    <!-- MAIN -->

    <main class="main">

        <section>
            <div class="volver">
                <a href="login.php">Volver</a>
            </div>
            <form class="form-login" action="./../../controllers/miControlador.php" method="post">
                <fieldset>
                    <legend>Registrarme</legend>
                    <hr><br>
                    <div class="mb-3 row">
                        <label for="emailRegistro" class="col-form-label col-sm-4">E-mail</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="emailRegistro" name="emailRegistro" placeholder="ejemplo@gmail.com" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="passwordRegistro" class="col-form-label col-sm-4">Contraseña</label>
                        <div class="col-sm-8">
                            <input type="password" onkeyup="keyPressPasswordValidacion('passwordRegistro')" class="form-control" id="passwordRegistro" name="passwordRegistro" placeholder="Contraseña (mayus y símbolo)" pattern="(?=.*[A-Z])(?=.*[!@#$%^&*()\\-_=+[{}\\]\\\\|;:'&quot;&lt;.&gt;/?])[\\w!@#$%^&*()\\-_=+[{}\\]\\\\|;:'&quot;&lt;.&gt;/?]{8,}" title="La contraseña debe contener al menos una letra mayúscula y al menos un símbolo. Debe tener al menos 8 caracteres de longitud." required>
                            <!-- <input type="checkbox" onclick="togglePasswordVisibile('passwordRegistro')"> Mostrar contraseña -->
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="passwordRegistroRep" class="col-form-label col-sm-4">Repetir contraseña</label>
                        <div class="col-sm-8">
                            <input type="password" onkeyup="keyPressPasswordValidacion('passwordRegistroRep')" class="form-control" id="passwordRegistroRep" name="passwordRegistroRep" placeholder="Repita la contraseña" pattern="(?=.*[A-Z])(?=.*[!@#$%^&*()\\-_=+[{}\\]\\\\|;:'&quot;&lt;.&gt;/?])[\\w!@#$%^&*()\\-_=+[{}\\]\\\\|;:'&quot;&lt;.&gt;/?]{8,}" title="La contraseña debe contener al menos una letra mayúscula y al menos un símbolo. Debe tener al menos 8 caracteres de longitud." required>
                            <!-- <input type="checkbox" onclick="togglePasswordVisibile('passwordRegistroRep')"> Mostrar contraseña -->
                        </div>

                        <div class="row">
                            <div class="col-sm-8 offset-sm-4">
                                <button type="submit" name="submit" value="Registrar" id="submit" class="btn btn-success ">Registrar</button>
                            </div>
                        </div>

                </fieldset>
            </form>
        </section>

    </main>

    <!-- FOOTER -->


    <?php include '../includes/footer.php'; ?>
    <script src="/assets/js/funcionesPassword.js"></script>
</body>

</html>