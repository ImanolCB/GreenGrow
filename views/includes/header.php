<?php session_start();
//Declaracion por defecto de los datos de rol de usuario
if (!isset($_SESSION['usermail']) && !isset($_SESSION['user_rol']) ) {
    
    $_SESSION['usermail'] = null;
    $_SESSION['user_rol'] = null;
}
?>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="/assets/img/logo.jpg" alt="logo" width="80" height="80">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <?php
            // Obtiene el nombre de la ruta del archivo en el que esta el usuario actualmente
            $current_page = basename($_SERVER['PHP_SELF']);
            echo basename($_SERVER['PHP_SELF']);
            // Verifica si estamos en la página inical o subdirectorio
            if ($current_page != 'index.php') {
            ?>
                <form class="form-nav w-100" action="./../../controllers/miControlador.php" method="post">

                <?php
            } else {
                ?>
                    <form class="form-nav w-100" action="./controllers/miControlador.php" method="post">
                    <?php } ?>
                    <!-- Lista de los enlaces de las distintas partes de la página -->
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 fs-5 ">
                            <li class="nav-item m-2">
                                <button id="linkNav" type="submit" name="submit" value="Promociones" class="btn btn-primary">Promociones</button>
                            </li>
                            <li class="nav-item m-2">
                                <button id="linkNav" type="submit" name="submit" value="Tienda" class="btn btn-primary">Tienda</button>
                            </li>
                            </li>
                            <li class="nav-item m-2">
                                <button id="linkNav" type="submit" name="submit" value="Libros" class="btn btn-primary">Libros</button>
                            </li>
                            <li class="nav-item m-2">
                                <button id="linkNav" type="submit" name="submit" value="Sobre nosotros" class="btn btn-primary">Sobre nosotros</button>
                            </li>
                        </ul>
                        <div class="d-flex m-3">
                            <!-- Muestra el nombre del usuario cuando esta registrado -->
                            <div class="d-flex m-2 text-secondary fst-italic">
                                <?php
                                $usuario = $_SESSION['usermail'];
                                if ($usuario != null) {
                                    //Primera letra mayúscula y el nombre antes del @
                                    echo ucfirst(explode( '@',$_SESSION['usermail'] )[0]);
                                }
                                ?>
                            </div>
                        
                        <?php
                            // Obtiene el nombre del archivo en el que esta el usuario actualmente
                            $current_page = basename($_SERVER['PHP_SELF']);

                            // Verifica si estamos en la página de inicio de sesión o registro
                            if ($current_page != 'login.php' && $current_page != 'registro.php') {
                                // Mostrará el botón dependiendo si estoy en el menu de inicio de sesión o no
                            ?>
                                <div class="d-flex">
                                    <button id="btnMiCuenta" type="submit" name="submit" value="Mi cuenta" class="btn btn-primary">Mi cuenta</button>
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                    </form>
        </div>
    </nav>
</header>