<?php

require_once 'carro.php'; // Asegúrate de ajustar la ruta según tu estructura de archivos

class Transaccion
{
    private $cesta; // Objeto de la clase Cesta
    private $metodo;
    private $direccion;
    private $provincia;
    private $estado;
    private $fecha_transaccion;

    // Constructor
    public function __construct(Carro $cesta, $metodo, $direccion, $provincia, $estado, $fecha_transaccion)
    {
        $this->cesta = $cesta;
        $this->metodo = $metodo;
        $this->direccion = $direccion;
        $this->provincia = $provincia;
        $this->estado = $estado;
        $this->fecha_transaccion = $fecha_transaccion;
    }

    // Getter for cesta
    public function getCesta()
    {
        return $this->cesta;
    }

    // Setter for cesta
    public function setCesta(Carro $cesta)
    {
        $this->cesta = $cesta;
    }

    // Getter for metodo
    public function getMetodo()
    {
        return $this->metodo;
    }

    // Setter for metodo
    public function setMetodo($metodo)
    {
        $this->metodo = $metodo;
    }

    // Getter for direccion
    public function getDireccion()
    {
        return $this->direccion;
    }

    // Setter for direccion
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    // Getter for provincia
    public function getProvincia()
    {
        return $this->provincia;
    }

    // Setter for provincia
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;
    }

    // Getter for estado
    public function getEstado()
    {
        return $this->estado;
    }

    // Setter for estado
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    // Getter for fecha_transaccion
    public function getFechaTransaccion()
    {
        return $this->fecha_transaccion;
    }

    // Setter for fecha_transaccion
    public function setFechaTransaccion($fecha_transaccion)
    {
        $this->fecha_transaccion = $fecha_transaccion;
    }

    public static function consultarTransaccion($conexion)
    {
        $html = '';

            //------------------------ Usuario-------------------------
            // Consulta de usuarios
            $query = "
            SELECT c.id_cesta,cp.id_producto, u.email, p.nombre, t.direccion, t.estado, t.fecha_transaccion,SUM(p.precio) as total
            FROM producto p, `cesta-producto` cp, cesta c, usuario u, transaccion t
            WHERE p.id_producto LIKE cp.id_producto
            AND c.id_cesta = cp.id_cesta
            AND c.id_usuario = u.id_usuario
            AND c.id_cesta = t.id_cesta
            group by cp.id_producto,c.id_cesta,c.id_usuario
            ORDER BY t.fecha_transaccion ASC
            ";

            // Preparar la declaración
            $stmt = mysqli_prepare($conexion, $query);

            // Ejecutar la declaración
            mysqli_stmt_execute($stmt);

            // Obtener resultados
            $resultado = mysqli_stmt_get_result($stmt);
            

            // Verificar si la consulta fue exitosa
            if (!$resultado) {
                die("Error al ejecutar la consulta: " . mysqli_error($conexion));
                return "Error al ejecutar la consulta: " . mysqli_error($conexion);
            } else {
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    $id_cesta = $fila['id_cesta'];
                    $id_producto = $fila['id_producto'];
                    $email = $fila['email'];
                    $producto = $fila['nombre'];
                    $direccion = $fila['direccion'];
                    // $provincia = $fila['provincia'];
                    $fecha = $fila['fecha_transaccion'];
                    $cantidad = $fila['total'];
                    $estado = $fila['estado'];

                    $html .= "
                    <form action='./../../views/myAccount/panelControl.php' method='post'>
                    <tr class = 'align-middle text-center'>
                        <td>" . $fecha ." </td>
                        <td>" . $email ." </td>
                        <td>" . $producto ." </td>
                        <td>" . $direccion ." </td>
                        <td>" . $cantidad ." € </td>
                        <td>" . $estado ." </td>
                        <td> 
                            <button type='submit' name='enviar' value='". $id_cesta . "," . $id_producto . "' class='btn btn-primary'>Enviar</button>
                        </td>
                    </tr>
                </form>
                    
                    ";
            }
            return $html;
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
