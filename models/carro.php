
<?php



class Carro
{



  //Función para dar de alta un usuario
  public static function mostrarProductoCarroPorId($productosCarrito)
  {
    $html = " ";
    $total = 0;
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
      $html .= "<li class='list-group-item d-flex justify-content-between'> <span>Total (€)</span> <strong>" .$total . " €</strong> </li>";
      return $html;
    
  }
}
