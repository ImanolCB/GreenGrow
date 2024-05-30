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
        $idActual = null;
        $estadoAnterior = null;

        //------------------------ Usuario-------------------------
        // Consulta de usuarios
        $query = "
        SELECT c.id_cesta, cp.id_producto, u.email, p.nombre, t.direccion,t.estado, t.fecha_transaccion,t.nombre as nomUsuauario, t.apellido, p.precio
        FROM producto p
        JOIN 
            `cesta-producto` cp ON p.id_producto = cp.id_producto
        JOIN 
            cesta c ON c.id_cesta = cp.id_cesta
        JOIN 
            usuario u ON c.id_usuario = u.id_usuario
        JOIN 
            transaccion t ON c.id_cesta = t.id_cesta
        ORDER BY t.fecha_transaccion,t.estado,cp.id_cesta ASC
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
                $nombre = $fila['nomUsuauario'];
                $apellido = $fila['apellido'];
                $id_producto = $fila['id_producto'];
                $email = $fila['email'];
                $producto = $fila['nombre'];
                $direccion = $fila['direccion'];
                // $provincia = $fila['provincia'];
                $fecha = $fila['fecha_transaccion'];
                $cantidad = $fila['precio'];
                $estado = $fila['estado'];
                //Definicion de background
                // $back = 'rgba('.(strlen($email)*255/100).','.(strlen($direccion)*255/100).','.(strlen($id_cesta)*255/100).','.(random_int(10,50)/100).')';

                if ($idActual == $id_cesta) {
                    $html .= "
                        <tr class='align-middle text-center'>
                            <td>" . $id_cesta . " </td>
                            <td>" . $fecha . " </td>
                            <td>" . $email . " </td>
                            <td>" . $producto . " </td>
                            <td>" . $direccion . " </td>
                            <td>" . $cantidad . " € </td>
                            <td>" . $estado . " </td>
                        </tr>";
                } else {
                    if ($idActual !== null) {
                        // Cerrar la tabla anterior y añadir el botón correspondiente
                        $html .= "</tbody></table>";
                        if ($estadoAnterior == 'enviado') {
                            $html .= "<p class='mb-4 align-middle text-left text-success'>Ya enviado</p>";
                        } else {
                            $html .= "
                                <form action='./../../views/myAccount/panelControl.php' method='post'>
                                    <button type='submit' name='enviar' value='" . $idActual . "' class='mb-4 btn btn-primary'>Enviar</button>
                                </form>
                            ";
                        }
                    }
    
                    $idActual = $id_cesta;
                    $estadoAnterior = $estado;
    
                    // Comenzar una nueva tabla
                    $html .= "
                        <p class='fs-3 mb-1 mt-4 searchable-item'>" . $nombre . " " . $apellido . "</p>
                        <table class='table table-bordered table-striped mt-0 searchable-item'>
                            <thead class='thead-custom'>
                                <tr>
                                    <th>ID-Cesta</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Fecha</th>
                                    <th>Correo</th>
                                    <th>Producto</th>
                                    <th>Direccion</th>
                                    <th>Precio</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody id='ordersTable'>
                                <tr class='align-middle text-center'>
                                <td>" . $id_cesta . " </td>
                                <td>" . $nombre . " </td>
                                <td>" . $apellido . " </td>
                                <td>" . $fecha . " </td>
                                <td>" . $email . " </td>
                                <td>" . $producto . " </td>
                                <td>" . $direccion . " </td>
                                <td>" . $cantidad . " € </td>
                                <td>" . $estado . " </td>
                                </tr>";
                }
            }
    
            // Añadir el botón para la última tabla
            if ($idActual !== null) {
                $html .= "</tbody></table>";
                if ($estadoAnterior == 'enviado') {
                    $html .= "<p class='mb-4 align-middle text-left text-success searchable-item'>Ya enviado</p>";
                } else {
                    $html .= "
                        <form action='./../../views/myAccount/panelControl.php' method='post'>
                            <button type='submit' name='enviar' value='" . $idActual . "' class='mb-4 btn btn-primary searchable-item'>Enviar</button>
                        </form>
                    ";
                }
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


    public static function actualizarEstadoTransaccion($id_cesta, $conexion)
    {
        // Consulta para obtener el estado actual
        $query = "SELECT estado FROM transaccion WHERE id_cesta = ?";
        $stmt = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($stmt, 'i', $id_cesta);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $estado_actual);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        // Determinar el nuevo estado
        $nuevo_estado = '';
        if ($estado_actual == 'pagado') {
            $nuevo_estado = 'enviado';
        } elseif ($estado_actual == 'pendiente') {
            $nuevo_estado = 'pagado';
        }

        // Actualizar el estado en la base de datos
        $update_query = "UPDATE transaccion SET estado = ? WHERE id_cesta = ?";
        $update_stmt = mysqli_prepare($conexion, $update_query);
        mysqli_stmt_bind_param($update_stmt, 'si', $nuevo_estado, $id_cesta);
        $resultado = mysqli_stmt_execute($update_stmt);
        mysqli_stmt_close($update_stmt);

        return $resultado;
    }
}
