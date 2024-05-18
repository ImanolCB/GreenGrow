
<?php

require_once 'usuario.php';

class Carro
{

  private $id_cesta;
  private $usuario; // Objeto de la clase Usuario

  // Constructor
  public function __construct($id_cesta = null, Usuario $usuario = null) {
      $this->id_cesta = $id_cesta;
      $this->usuario = $usuario;
  }

  // Getter for id_cesta
  public function getIdCesta() {
      return $this->id_cesta;
  }

  // Setter for id_cesta
  public function setIdCesta($id_cesta) {
      $this->id_cesta = $id_cesta;
  }

  // Getter for usuario
  public function getUsuario() {
      return $this->usuario;
  }

  // Setter for usuario
  public function setUsuario(Usuario $usuario) {
      $this->usuario = $usuario;
  }


  //Función para dar de alta un usuario
  public static function mostrarProductoCarroPorId($productosCarrito)
  {
    $html = " ";
    $total = 0;
    if ($productosCarrito != null) {
      foreach ($productosCarrito as $producto){
        $html .= "
        
          <li class='list-group-item d-flex justify-content-between lh-condensed'>
              <div>
                  <h6 class='my-0'>" . $producto->nombre. "</h6>
                  <small class='text-muted'>" . $producto->descripcion . "</small>
              </div> <span class='text-muted'>".$producto->precio."€</span>
          </li>
          ";

          $total = $total + (float) $producto->precio;
      }
    }
    else{
      $html .= "<li class='list-group-item d-flex justify-content-between lh-condensed'>No hay productos añadidos</li>";
    }
    $html .= "<li class='list-group-item d-flex justify-content-between'> <span>Total (€)</span> <strong>" .$total . " €</strong> </li>";
      return [$html, $total];
    
  }
}
