<?php

require_once 'carro.php'; // Asegúrate de ajustar la ruta según tu estructura de archivos

class Transaccion {
    private $cesta; // Objeto de la clase Cesta
    private $metodo;
    private $direccion;
    private $provincia;
    private $estado;
    private $fecha_transaccion;

    // Constructor
    public function __construct(Carro $cesta, $metodo, $direccion, $provincia, $estado, $fecha_transaccion) {
        $this->cesta = $cesta;
        $this->metodo = $metodo;
        $this->direccion = $direccion;
        $this->provincia = $provincia;
        $this->estado = $estado;
        $this->fecha_transaccion = $fecha_transaccion;
    }

    // Getter for cesta
    public function getCesta() {
        return $this->cesta;
    }

    // Setter for cesta
    public function setCesta(Carro $cesta) {
        $this->cesta = $cesta;
    }

    // Getter for metodo
    public function getMetodo() {
        return $this->metodo;
    }

    // Setter for metodo
    public function setMetodo($metodo) {
        $this->metodo = $metodo;
    }

    // Getter for direccion
    public function getDireccion() {
        return $this->direccion;
    }

    // Setter for direccion
    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    // Getter for provincia
    public function getProvincia() {
        return $this->provincia;
    }

    // Setter for provincia
    public function setProvincia($provincia) {
        $this->provincia = $provincia;
    }

    // Getter for estado
    public function getEstado() {
        return $this->estado;
    }

    // Setter for estado
    public function setEstado($estado) {
        $this->estado = $estado;
    }

    // Getter for fecha_transaccion
    public function getFechaTransaccion() {
        return $this->fecha_transaccion;
    }

    // Setter for fecha_transaccion
    public function setFechaTransaccion($fecha_transaccion) {
        $this->fecha_transaccion = $fecha_transaccion;
    }
}

?>
