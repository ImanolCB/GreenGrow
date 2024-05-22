<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Grow</title>
    <link rel="shortcut icon" href="./../../assets/img/logo.jpg" type="image/x-icon">
    <!-- Bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

     <!-- Required PHP -->
    <?php 
        require_once './../../views/includes/fonts.php';
    ?>

    <!-- CSS -->
    <link rel="stylesheet" href="./../../assets/css/style.css">
    <link rel="stylesheet" href="./../../assets/css/registro.css">

</head>

<body>

    <!-- HEADER -->
    <?php include './../includes/header.php';?>


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


    <?php include './../includes/footer.php'; ?>
    <script src="./../../assets/js/funcionesPassword.js"></script>
</body>

</html>