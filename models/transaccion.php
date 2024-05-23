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

    public static function consultarTransaccion($conexion)
    {
        // Preparar la consulta SQL de Select
        $query = "SELECT * FROM usuario ";

        // Preparar la declaración
        $stmt = mysqli_prepare($conexion, $query);

        // Ejecutar la declaración
        mysqli_stmt_execute($stmt);

        // Obtener resultados
        $resultado = mysqli_stmt_get_result($stmt);

        /**
         * TODO: PENDIENTE HACER CONSULTA A 3 TABLAS PARA TRANSACCION
         * TODO: PENDIENTE FUNCIONES DE UPDATE ROL Y ESTADO TRANSACCION
         */

        // Verificar si la consulta fue exitosa
        if (!$resultado) {
            die("Error al ejecutar la consulta: " . mysqli_error($conexion));
            return "Error al ejecutar la consulta: " . mysqli_error($conexion);
        } else {
            $html = "";
            // $arrayUsuarios = [];
            //Muentras tenga resultados se le asocia a una fila un resultado y se hace un objeto
            while ($fila = mysqli_fetch_assoc($resultado)) {
                // var_dump($fila);
                $id = $fila['id_usuario'];
                $email = $fila['email'];
                $password = $fila['password'];
                $rol = $fila['rol'];
                $fecha_alta = $fila['fecha_alta'];

                $usuario = new Usuario($id, $email, $password, $rol, $fecha_alta);
                $rolUs = '';
                if($usuario->getRol() == 'administrador'){$rolUs = 'Adm';} else $rolUs = 'Usu';

                $html .= "
                <tr class = 'align-middle text-center'>
                    <td>" . $usuario->getIdUsuario() ." </td>
                    <td>" . $usuario->getEmail() ." </td>
                    <td>" . $rolUs ." </td>
                    <td>" . $usuario->getFechaAlta() ." </td>
                    <td> 
                        <button type='submit' name='cambiar' value='". $usuario->getIdUsuario() . "' class='btn btn-primary'>Cambiar rol</button>
                        <button type='submit' name='eliminar' value='". $usuario->getIdUsuario() . "' class='btnRed btn btn-primary'>Eliminar</button>
                    </td>
                </tr>
                ";
                // array_push($arrayUsuarios, $usuario);
            }
            // var_dump($arrayProductos);
            return $html;
        }
    }
}

?>
