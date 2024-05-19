<?php

session_start();

require_once '../models/conexionBD.php';
require_once '../models/Producto.php';
require_once '../models/Usuario.php';
require_once '../models/Carro.php';



//Creación de una conexión a la BD
$conn = new ConexionBD();

$json = file_get_contents('php://input');
$datos = json_decode($json, true);

//Obtencion de los objetoas del carro
if (isset($_GET['productosCarrito'])) {
    $productosCarritoSerializado = $_GET['productosCarrito'];
    $productosCarrito = unserialize($provinciaSerializado);
    $provinciaSerializado = $_GET['productosCarrito'];
    $provincia = unserialize($provinciaSerializado);
}

echo '<pre>';
print_r ($datos);
echo '</pre>';
echo $provincia;
echo $productosCarrito[0];

if (is_array($datos)) {
    
    $id_transaccion = $datos['detalles'];
}



// <pre>Array
// (
//     [detalles] => Array
//         (
//             [id] => 2BX272371E4959724
//             [intent] => CAPTURE
//             [status] => COMPLETED
//             [purchase_units] => Array
//                 (
//                     [0] => Array
//                         (
//                             [reference_id] => default
//                             [amount] => Array
//                                 (
//                                     [currency_code] => EUR
//                                     [value] => 41.49
//                                 )

//                             [payee] => Array
//                                 (
//                                     [email_address] => sb-am447y30648020@business.example.com
//                                     [merchant_id] => 6PZ4Q592LRFFJ
//                                 )

//                             [shipping] => Array
//                                 (
//                                     [name] => Array
//                                         (
//                                             [full_name] => Bublium Richman
//                                         )

//                                     [address] => Array
//                                         (
//                                             [address_line_1] => calle Vilamari 76993- 17469
//                                             [admin_area_2] => Albacete
//                                             [admin_area_1] => Albacete
//                                             [postal_code] => 02001
//                                             [country_code] => ES
//                                         )

//                                 )

//                             [payments] => Array
//                                 (
//                                     [captures] => Array
//                                         (
//                                             [0] => Array
//                                                 (
//                                                     [id] => 80685081KG497590L
//                                                     [status] => COMPLETED
//                                                     [amount] => Array
//                                                         (
//                                                             [currency_code] => EUR
//                                                             [value] => 41.49
//                                                         )

//                                                     [final_capture] => 1
//                                                     [seller_protection] => Array
//                                                         (
//                                                             [status] => ELIGIBLE
//                                                             [dispute_categories] => Array
//                                                                 (
//                                                                     [0] => ITEM_NOT_RECEIVED
//                                                                     [1] => UNAUTHORIZED_TRANSACTION
//                                                                 )

//                                                         )

//                                                     [create_time] => 2024-05-19T21:14:09Z
//                                                     [update_time] => 2024-05-19T21:14:09Z
//                                                 )

//                                         )

//                                 )

//                         )

//                 )

//             [payer] => Array
//                 (
//                     [name] => Array
//                         (
//                             [given_name] => Bublium
//                             [surname] => Richman
//                         )

//                     [email_address] => sb-nh0wk29185630@business.example.com
//                     [payer_id] => C2YW5NSFUMDTJ
//                     [address] => Array
//                         (
//                             [country_code] => ES
//                         )

//                 )

//             [create_time] => 2024-05-19T21:13:55Z
//             [update_time] => 2024-05-19T21:14:09Z
//             [links] => Array
//                 (
//                     [0] => Array
//                         (
//                             [href] => https://api.sandbox.paypal.com/v2/checkout/orders/2BX272371E4959724
//                             [rel] => self
//                             [method] => GET
//                         )

//                 )

//         )

// )
// </pre>

