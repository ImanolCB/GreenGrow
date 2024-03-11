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
