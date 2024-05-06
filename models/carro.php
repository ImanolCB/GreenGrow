
<?php



class Usuario
{



    //Función para dar de alta un usuario
    public function mostrarProductoCarroPorId($idProducto, $conexion)
    {
        $html = " ";
        // Construir la consulta SQL de Select
        $query = "SELECT * FROM producto WHERE id = '$idProducto' ";

        // Ejecutar la consulta
        $resultado = mysqli_query($conexion, $query);

        // Verificar si la consulta fue exitosa
        if (!$resultado) {
            die("Error al ejecutar la consulta: " . mysqli_error($conexion));
            return false;
        } else {
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
                $url = $fila['url'];
                $html .= "
                    <ol class='list-group list-group-numbered'>
                        <li class='list-group-item d-flex justify-content-between align-items-start'>
                          <div class='ms-2 me-auto'>
                            <div class='fw-bold'>Subencabezado</div>
                            Contenido para el elemento de la lista
                          </div>
                          <span class='badge bg-primary rounded-pill'>14</span>
                        </li>
                        <li class='list-group-item d-flex justify-content-between align-items-start'>
                          <div class='ms-2 me-auto'>
                            <div class='fw-bold'>Subencabezado</div>
                            Contenido para el elemento de la lista
                          </div>
                          <span class='badge bg-primary rounded-pill'>14</span>
                        </li>
                        <li class='list-group-item d-flex justify-content-between align-items-start'>
                          <div class='ms-2 me-auto'>
                            <div class='fw-bold'>Subencabezado</div>
                            Contenido para el elemento de la lista
                          </div>
                          <span class='badge bg-primary rounded-pill'>14</span>
                        </li>
                    </ol>
                ";
            }
            return $html;
        }
    }
}
