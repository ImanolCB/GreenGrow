<?php session_start();

require_once '../models/conexionBD.php';
require_once '../models/Producto.php';
require_once '../models/Usuario.php';
require_once '../models/Carro.php';



//Creación de una conexión a la BD
$conn = new ConexionBD();

$json = file_get_contents('php://input');
$datos = json_decode($json, true);

echo '<pre>';
print_r($datos) . '<br>';
print_r($_SESSION['carrito']);
echo '</pre>';
//Obtencion de los objetos del carro
$userId = $_SESSION['user_id'];
$productosCarrito = $_SESSION['carrito'];

if (is_array($datos)) {
    $metodoPago = 'paypal';
    $nombre = $datos['nombre'];
    $apellido = $datos['apellido'];
    $direccion = $datos['direccion'];
    $provincia = $datos['provincia'];
    $status = $datos['detalles']['status'];
    $estado;
    if ($status == 'COMPLETED') {
        $estado = 'pagado';
    } else $estado = 'pendiente';
    Carro::insertarCarrito($productosCarrito, $conn->conectar_bd(), $userId, $nombre, $apellido, $metodoPago, $direccion, $provincia, $estado);
    $_SESSION['carrito'] = [];
}