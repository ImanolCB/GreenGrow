<?php 

// Path de las clases y de las paginas estandar
// define("CLASS_PATH", dirname($_SERVER['PHP_SELF'])."/");
// define("APPLICATION_PATH", dirname($_SERVER['PHP_SELF'])."/");

//Configuraci�n de la conexion a la base de datos
define("BD_SERVIDOR", "localhost");
define("BD_NOMBRE", "greengrow_bd");
define ("BD_USUARIO", "imanol");
define ("BD_PASSWORD", "kk");

//Configuraci�n de logitudes minimas del login y el password de los usuario
//normales
define ("LONGITUD_MINIMA_LOGIN", 6);
define ("LONGITUD_MINIMA_PASSWORD", 6);

//Configuraci�n del numero de resultados de paginaci�n por cada pagina
// define ("PAGINACION", 10);

?>