<?php

//POJO de Producto DML
class Producto
{
    // Propiedades
    public $id_producto;
    public $nombre;
    public $descripcion;
    public $altura;
    public $epoca;
    public $tipo;
    public $cuidado;
    public $precio;
    public $promocion;

    // Constructor

    public function constructorVacio()
    {
    }


    public function constructorCompleto($id_producto, $nombre, $descripcion, $altura, $epoca, $tipo, $cuidado, $precio, $promocion)
    {
        $this->id_producto = $id_producto;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->altura = $altura;
        $this->epoca = $epoca;
        $this->tipo = $tipo;
        $this->cuidado = $cuidado;
        $this->precio = $precio;
        $this->promocion = $promocion;
    }

    // Métodos de acceso (getters)
    public function getIdProducto()
    {
        return $this->id_producto;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getAltura()
    {
        return $this->altura;
    }

    public function getEpoca()
    {
        return $this->epoca;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function getCuidado()
    {
        return $this->cuidado;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function getPromocion()
    {
        return $this->promocion;
    }


    // Métodos de establecimiento (setters)
    public function setIdProducto($id_producto)
    {
        $this->id_producto = $id_producto;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function setAltura($altura)
    {
        $this->altura = $altura;
    }

    public function setEpoca($epoca)
    {
        $this->epoca = $epoca;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function setCuidado($cuidado)
    {
        $this->cuidado = $cuidado;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    public function setPromocion($promocion)
    {
        $this->promocion = $promocion;
    }

    // Método para obtener la información del producto como un array con clave valor (asociativo)
    public function obtenerInfo()
    {
        return [
            'id_producto' => $this->id_producto,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'altura' => $this->altura,
            'epoca' => $this->epoca,
            'tipo' => $this->tipo,
            'cuidado' => $this->cuidado,
            'precio' => $this->precio,
            'promocion' => $this->promocion
        ];
    }

    /**
     * ! Arreglar el funcionamiento de la consulta
     */

     //Metodo para obtener los productos de la base de datos en un array
     public static function consultarProductos($conexion)
     {
         // Construir la consulta SQL de Select
         $query = 'SELECT * FROM producto';
 
         // Ejecutar la consulta
         $resultado = mysqli_query($conexion, $query);
 
         // Verificar si la consulta fue exitosa
         if (!$resultado) {
             die("Error al ejecutar la consulta: " . mysqli_error($conexion));
             return "Error al ejecutar la consulta: " . mysqli_error($conexion);
         } else {
             $arrayProductos = [];
             //Muentras tenga resultados se le asocia a una fila un resultado y se hace un objeto
             while ($fila = mysqli_fetch_assoc($resultado)) {
                 $id = $fila['id_producto'];
                 $nombre = $fila['nombre'];
                 $descripcion = $fila['descripcion'];
                 $altura = $fila['altura'];
                 $epoca = $fila['epoca'];
                 $tipo = $fila['tipo'];
                 $cuidado = $fila['cuidado'];
                 $precio = $fila['precio'];
                 $promocion = $fila['promocion'];
 
                 $producto = new Producto($id, $nombre, $descripcion, $altura, $epoca, $tipo,  $cuidado, $precio, $promocion);
                 array_push($arrayProductos, $producto);
             }
             return $arrayProductos;
         }
     }
 
     //Método para crear la estructura de productos
 
     public static function crearProductos($arrayProductos)
     {
         $html = '';
 
         foreach ($arrayProductos as $producto) {
             $html .= "
         
             <div class='col'>
             <div class='card h-100'>
                 <img src='https://images.unsplash.com/photo-1477554193778-9562c28588c0?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' class='card-img-top'alt=''..'>
                 <div class='card-body'>
                     <h5 class='card-title'>" . $producto->getNombre() . "</h5>
                     <p class='card-text'>" . $producto->getCuidado() . "</p>
                     <p class='card-text'>" . $producto->getTipo() . "</p>
                     <p class='card-text'>" . $producto->getAltura() . "</p>
                     <p class='card-text'>" . $producto->getEpoca() . "</p>
                     <p class='d-inline-flex gap-1'>
                         <a class='btn btn-primary' data-bs-toggle='collapse' href='#multiCollapseExample3' role='button' aria-expanded='false' aria-controls='multiCollapseExample1'>Toggle first element</a>
                     </p>
                     <div class='row'>
                         <div class='col'>
                             <div class='collapse multi-collapse' id='multiCollapseExample3'>
                                 <div class='card card-body'>
                                     Some placeholder content for the first collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class='card-footer'>
                         <small class='text-body-secondary'>Last updated 3 mins ago</small>
                     </div>
                 </div>
             </div>
         </div>
             ";
         }
         return $html;
     }
    

    //Método estático para crear una carta de producto
    public static function crearPromocion($imageUrl, $title, $description)
    {
        return "
        <div class='card' style='width: 18rem;'>
        <img src='$imageUrl' class='card-img-top' alt='...'>
        <div class='card-body'>
          <h5 class='card-title'>$title</h5>
          <p class='card-text'>$description</p>
          <a href='#' class='btn btn-primary'>Go somewhere</a>
        </div>
      </div>
        ";
    }
}
