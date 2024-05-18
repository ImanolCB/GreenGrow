<?php

class Planta {
    private $id_planta;
    private $nombre;
    private $imagen;
    private $id_usuario;

    // Constructor
    public function __construct($id_planta = null, $nombre = null, $imagen = null, $id_usuario = null) {
        $this->id_planta = $id_planta;
        $this->nombre = $nombre;
        $this->imagen = $imagen;
        $this->id_usuario = $id_usuario;
    }

    // Getter for id_planta
    public function getIdPlanta() {
        return $this->id_planta;
    }

    // Setter for id_planta
    public function setIdPlanta($id_planta) {
        $this->id_planta = $id_planta;
    }

    // Getter for nombre
    public function getNombre() {
        return $this->nombre;
    }

    // Setter for nombre
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    // Getter for imagen
    public function getImagen() {
        return $this->imagen;
    }

    // Setter for imagen
    public function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    // Getter for id_usuario
    public function getIdUsuario() {
        return $this->id_usuario;
    }

    // Setter for id_usuario
    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }
}

?>
