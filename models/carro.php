
<?php

require_once 'usuario.php';

class Carro
{

  private $id_cesta;
  private $usuario; // Objeto de la clase Usuario

  // Constructor
  public function __construct($id_cesta = null, Usuario $usuario = null)
  {
    $this->id_cesta = $id_cesta;
    $this->usuario = $usuario;
  }

  // Getter for id_cesta
  public function getIdCesta()
  {
    return $this->id_cesta;
  }

  // Setter for id_cesta
  public function setIdCesta($id_cesta)
  {
    $this->id_cesta = $id_cesta;
  }

  // Getter for usuario
  public function getUsuario()
  {
    return $this->usuario;
  }

  // Setter for usuario
  public function setUsuario(Usuario $usuario)
  {
    $this->usuario = $usuario;
  }

  // Funcion para insertar el carrito en la base de datos
  public static function insertarCarrito($productosCarrito, $conexion, $idUsuario, $nombre, $apellido, $metodoPago, $direccion, $provincia, $estado)
  {

    // Iniciar la transacción, con begin se realizan varias operaciones a la vez pudiendo hacer commit alñ final o cancelar con rollback
    $conexion->begin_transaction();

    try {
      // Insertar la nueva cesta con sentencias preparadas para evitar inyeccion
      $query = "INSERT INTO cesta (id_usuario) VALUES (?)";
      $stmt = $conexion->prepare($query);
      $stmt->bind_param("i", $idUsuario);
      $stmt->execute();

      // Obtener el id_cesta generado para utilizar en cesta-producto
      $idCesta = $conexion->insert_id;
      echo ('idCesta : ' . $idCesta);
      if (!$idCesta) {
        throw new Exception("Error obteniendo el ID de la cesta: " . $conexion->error);
      }
      
      //Insertar productos en la cesta-producto con sentencias preparadas para evitar inyeccion
      $query = "INSERT INTO `cesta-producto` (id_cesta, id_producto) VALUES (?, ?)";
      $stmt = $conexion->prepare($query);
      foreach ($productosCarrito as $productoId) {
        echo ('idProducto : ' . $productoId);
        $stmt->bind_param("ii", $idCesta, $productoId);
        $stmt->execute();
      }

      // 3. Registrar la transacción
      $fechaTransaccion = date('Y-m-d');
      

      $query = "
            INSERT INTO transaccion (id_cesta,nombre, apellido, metodo, direccion, provincia, estado, fecha_transaccion) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ";
      $stmt = $conexion->prepare($query);
      $stmt->bind_param("isssssss", $idCesta, $nombre, $apellido, $metodoPago, $direccion, $provincia, $estado, $fechaTransaccion);
      $stmt->execute();

      // Confirmar la transacción
      $conexion->commit();

      // Cerrar las declaraciones
      $stmt->close();

      return true;
    } catch (Exception $e) {
      // Si ocurre un error, deshacer la transacción
      $conexion->rollback();

      // Cerrar las declaraciones
      if (isset($stmt)) {
        $stmt->close();
      }

      die("Error al realizar la compra: " . $e->getMessage());
      return false;
    }
  }

  //Función para mostrar el objeto producto segun su id
  public static function mostrarProductoCarroPorId($productosCarrito)
  {
    $html = " ";
    $total = 0;
    if ($productosCarrito != null) {
      //Ordenacion de array 
      sort($productosCarrito);
      foreach ($productosCarrito as $producto) {
        $html .= "
        
          <li class='list-group-item d-flex justify-content-between lh-condensed'>
              <div>
                  <h6 class='my-0'>" . $producto->nombre . "</h6>
                  <small class='text-muted'>" . $producto->descripcion . "</small>
              </div> <span class='text-muted'>" . $producto->precio . "€</span>
              <form action='./../../views/shop/carrito.php' method='post'>
                <button type='submit' name='quitar' value='$producto->id_producto' id='btnVolverTienda' class='btnRed btn position-relative m-4'>Quitar</button>
            </form>
          </li>
          ";

        $total = $total + (float) $producto->precio;
      }
    } else {
      $html .= "<li class='list-group-item d-flex justify-content-between lh-condensed'>No hay productos añadidos</li>";
    }
    $html .= "<li class='list-group-item d-flex justify-content-between'> <span>Total (€)</span> <strong>" . $total . " €</strong> </li>";
    return [$html, $total];
  }
}
