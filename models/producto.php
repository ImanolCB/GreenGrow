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
    public $url;

    // Constructor

    public function __construct($id_producto = null, $nombre = null, $descripcion = null, $altura = null, $epoca = null, $tipo = null, $cuidado = null, $precio = null, $promocion = null, $url = null)
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
        $this->url = $url;
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

    public function getUrl()
    {
        return $this->url;
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

    public function setUrl($url)
    {
        $this->promocion = $url;
    }

    public function toString()
    {
        return "Producto: [id_producto=" . $this->id_producto . ", nombre=" . $this->nombre . ", descripcion=" . $this->descripcion . ", altura=" . $this->altura . ", epoca=" . $this->epoca . ", tipo=" . $this->tipo . ", cuidado=" . $this->cuidado . ", precio=" . $this->precio . ", promocion=" . $this->promocion . ", url=" . $this->url . "]";
    }



    //Metodo para obtener los productos de la base de datos en un array
    public static function consultarProductos($conexion)
    {
        // Preparar la consulta SQL de Select
        $query = "SELECT * FROM producto ";

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
            $arrayProductos = [];
            //Muentras tenga resultados se le asocia a una fila un resultado y se hace un objeto
            while ($fila = mysqli_fetch_assoc($resultado)) {
                // var_dump($fila);
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

                $producto = new Producto;
                $producto->__construct(
                    $id,
                    $nombre,
                    $descripcion,
                    $altura,
                    $epoca,
                    $tipo,
                    $cuidado,
                    $precio,
                    $promocion,
                    $url
                );
                array_push($arrayProductos, $producto);
            }
            // Verificar qué datos se están agregando al array


            // var_dump($arrayProductos);
            return $arrayProductos;
        }
    }

    //Funcion para obtener los productos con los filtros establecidos
    public static function consultarProductosFiltrados($conexion, $filtro,  $parametros)
    {
        // Preparar la consulta SQL de Select
        $query = "SELECT * FROM producto $filtro";

        // Preparar la declaración
        $stmt = mysqli_prepare($conexion, $query);

        //comprueba que la sentencia se preparo correctamente
        if ($stmt === false) {
            die("Error al preparar la consulta: " . mysqli_error($conexion));
            return "Error al preparar la consulta: " . mysqli_error($conexion);
        }

        // Vincula los parámetros a la sentencia
        if (!empty($parametros)) {
            // Crear una cadena de tipos para los parámetros
            $types = str_repeat('s', count($parametros)); // Asumiendo que todos los parámetros son de tipo string
            mysqli_stmt_bind_param($stmt, $types, ...$parametros);
        }

        // Ejecutar la declaración
        mysqli_stmt_execute($stmt);

        // Obtener resultados
        $resultado = mysqli_stmt_get_result($stmt);

        // Verificar si la consulta fue exitosa
        if (!$resultado) {
            die("Error al ejecutar la consulta: " . mysqli_error($conexion));
            return "Error al ejecutar la consulta: " . mysqli_error($conexion);
        } else {
            $arrayProductos = [];
            //Muentras tenga resultados se le asocia a una fila un resultado y se hace un objeto
            while ($fila = mysqli_fetch_assoc($resultado)) {
                // var_dump($fila);
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

                $producto = new Producto;
                $producto->__construct(
                    $id,
                    $nombre,
                    $descripcion,
                    $altura,
                    $epoca,
                    $tipo,
                    $cuidado,
                    $precio,
                    $promocion,
                    $url
                );
                array_push($arrayProductos, $producto);
            }
            // Verificar qué datos se están agregando al array


            // var_dump($arrayProductos);
            return $arrayProductos;
        }
    }

    //Método para crear la estructura de productos
    public static function crearProductos($arrayProductos)
    {
        $html = '';

        //Concatenacion de estructura html con los datos obtenidos de la base de datos
        foreach ($arrayProductos as $producto) {
            $html .= "
         
             <div class='col producto searchable-item p-4'>
             <div class='card h-100' id='" . $producto->getIdProducto() . "'>
                 <img src=' " . $producto->getUrl() . " ' class='card-img-top'alt='" . $producto->getNombre() . "' title='" . $producto->getNombre() . "'>
                 <div class='card-body mt-2  '>
                     <h5 class='card-title searchable-item mb-4 d-flex flex-row justify-content-between'>"   . $producto->getNombre() . "<span class='text-black p-1 border border-success rounded-1'>" . number_format($producto->getPrecio(), 2, ',', '.') . " €</span></h5>
                     <p class='card-text text-start m-1'><span>Nivel de cuidado: </span>" . $producto->getCuidado() . "</p>
                     <p class='card-text text-start m-1'><span>Tipo de planta: </span>" . $producto->getTipo() . "</p>
                     <p class='card-text text-start m-1'><span>Altura máxima: </span>" . $producto->getAltura() . " cm</p>
                     <p class='card-text text-start m-1'><span>Época de floración: </span>" . $producto->getEpoca() . "</p>
                     <p class='card-text text-start mt-3'><span></span>" . $producto->getDescripcion() . "</p>
                     
                     <div class='card-footer bg-transparent '>
                     <form action='../../controllers/miControlador.php' method='post'>
                         <div data-mdb-input-init class='form-outline d-flex flex-row justify-content-evenly align-items-center'>
                         <input type='number' id='typeNumber' name='cantidad' value='1' class='form-control' min='0' max='5' placeholder='Cantidad' />
                         <input type='hidden' name='id-producto' value='" . $producto->getIdProducto() . "' id='" . $producto->getIdProducto() . "'>
                         <button id='" . $producto->getIdProducto() . "' type='submit' name='submit' value='anadir' class='btn btn-primary m-2'>Añadir</button>
                         </div>
                     </form>
                 </div>
                 </div>
             </div>
         </div>
             ";
        }
        return $html;
    }

    //Metodo para añadir producto a cesta
    public static function anadirProductoACesta($arrayCesta, $cantidad, $id_producto)
    {
        $nuevoArray = [];
        for ($i = 0; $i < $cantidad; $i++) {
            array_push($arrayCesta, $id_producto);
        }
        $nuevoArray = $arrayCesta;
        $_SESSION['carrito'] = $nuevoArray;
    }


    //Método estático para crear una carta de producto
    public static function crearPromocion($conexion, $cantidad)
    {
        if ($cantidad != 0) {
            // Preparar la consulta SQL de Select
            $query = "SELECT * FROM producto WHERE promocion like 'si' LIMIT 4";
        } else {
            // Preparar la consulta SQL de Select
            $query = "SELECT * FROM producto WHERE promocion like 'si'";
        }

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
            $html = "";

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
                $url = $fila['url'];

                $producto = new Producto;
                $producto->__construct(
                    $id,
                    $nombre,
                    $descripcion,
                    $altura,
                    $epoca,
                    $tipo,
                    $cuidado,
                    $precio,
                    $promocion,
                    $url
                );
                $html .= "
                <div class='container mt-5'>
                    <div class='card text-bg-dark card-custom'>
                        <img src='" . $producto->getUrl() . "' class='img-fluid promo' alt='" . $producto->getNombre() . "'>
                        <div class='card-img-overlay'>
                            <h5 class='card-title'>" . strtoupper($producto->getNombre()) . "</h5>
                            <p class='card-text'>" . $producto->getDescripcion() . "</p>
                        </div>
                    </div>
                </div>
                ";
            }
            return $html;
        }
    }

    // Método estático para insertar un producto en la base de datos
    public static function insertarProducto($conexion, $nombre, $descripcion, $altura, $epoca, $tipo, $cuidado, $precio, $promocion, $url)
    {
        // Preparar la consulta SQL de inserción
        $query = "INSERT INTO producto (nombre, descripcion, altura, epoca, tipo, cuidado, precio, promocion, url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Preparar la declaración
        $stmt = mysqli_prepare($conexion, $query);

        // Verificar si la preparación fue exitosa
        if ($stmt === false) {
            die("Error al preparar la consulta: " . mysqli_error($conexion));
        }

        // Asocia los parámetros con un tipo de dato
        mysqli_stmt_bind_param($stmt, "ssisssdss", $nombre, $descripcion, $altura, $epoca, $tipo, $cuidado, $precio, $promocion, $url);

        // Ejecución de la sentencia
        $resultado = mysqli_stmt_execute($stmt);

        // Verificar si la ejecución se ha realizado correctamente
        if ($resultado === false) {
            die("Error al ejecutar la consulta: " . mysqli_error($conexion));
        } else {
            echo "Producto insertado exitosamente.";
        }

        // Cerrar la declaración
        mysqli_stmt_close($stmt);
    }


    //Funcion para obtener todos los usuarios de base de datos
    public static function consultarProductosAdministrados($conexion)
    {
        // Preparacion de la consulta SQL de Select
        $query = "SELECT * FROM producto ";

        // Se prepara la sentencia con la conexion 
        $stmt = mysqli_prepare($conexion, $query);

        // Se ejecuta la sentencia 
        mysqli_stmt_execute($stmt);

        // Se obtienen los resultados
        $resultado = mysqli_stmt_get_result($stmt);

        // Verificacion si la consulta fue exitosa
        if (!$resultado) {
            die("Error al ejecutar la consulta: " . mysqli_error($conexion));
            return "Error al ejecutar la consulta: " . mysqli_error($conexion);
        } else {
            $html = "";

            //Mientras tenga resultados se le asocia a una fila un resultado y se hace un objeto
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

                //Se concatenan las estructuras html con los datos obtenidos de la consulta
                $html .= "
                    <form action='./../../views/myAccount/administrarProductos.php' method='post'>
                        <tr class='align-middle text-center'>
                            <td><input type='text' name='nombreProducto' value='$nombre' class='form-control'></td>
                            <td><textarea name='descripcionProducto' class='form-control' style='min-width: 200px; min-height: 100px;'>$descripcion</textarea></td>
                            <td><input type='number' name='alturaProducto' value='$altura' class='form-control'></td>
                            <td><select id='inputState' name='epocaProducto' value='$epoca' class='form-select'>
                                    <option value='$epoca'>$epoca</option>
                                    <option value='primavera'>Primavera</option>
                                    <option value='verano'>Verano</option>
                                    <option value='otoño'>Otoño</option>
                                    <option value='invierno'>Invierno</option>
                                </select></td>
                            <td><select id='inputState' class='form-select' value='$tipo' name='tipoProducto'>
                                    <option value='$tipo'>$tipo</option>
                                    <option value='flor'>Flor</option>
                                    <option value='exotica'>Exótica</option>
                                    <option value='interior'>Interior</option>
                                    <option value='arbol'>Arbol</option>
                                    <option value='cactus'>Cactus</option>
                                </select></td>
                            <td><select id='inputState' name='cuidadoProducto' class='form-select'>
                                    <option value='$cuidado'>$cuidado</option>
                                    <option value='sencillo'>Sencillo</option>
                                    <option value='moderado'>Moderado</option>
                                    <option value='complejo'>Complejo</option>
                                </select></td>
                            <td><input type='number' name='precioProducto' value='$precio' class='form-control'></td>
                            <td>
                                <input class='form-check-input' type='radio' name='promocionProducto' id='promocionProducto' value='si'";
                if ($promocion == 'si') {
                    $html .= 'checked';
                } else {
                    $html .= ' ';
                }
                $html .= ">
                                <label class='form-check-label' for='promocionProducto'>Sí</label>
                                <input class='form-check-input' type='radio' name='promocionProducto' id='promocionProducto' value='no'";
                if ($promocion == 'no') {
                    $html .= 'checked';
                } else {
                    $html .= ' ';
                }
                $html .= ">
                                <label class='form-check-label' for='promocionProducto'>No</label>
                            </td>
                            <td><input type='text' name='urlProducto' value='$url' class='form-control' id='urlProducto'></td>
                            <td>
                            

                                <button type='submit' name='actualizar' value='$id' class='btn btn-primary m-1'>Actualizar</button>
                                <button type='submit' name='borrarProducto' value='$id' class='btnRed btn btn-danger m-1'>Eliminar</button>
                            </td>
                        </tr>
                    </form>
                    ";
            }
            return $html;
        }
    }

    //Funcion para borrar un producto de la base de datos
    public static function borrarProducto($conexion, $id_producto)
    {
        // Prepara la consulta SQL de borrado
        $query = "DELETE FROM producto WHERE id_producto = ?";

        // Prepara la sentencia con la conexion
        $stmt = mysqli_prepare($conexion, $query);

        // Verifica si la preparación se ha realizado correctamente
        if ($stmt === false) {
            die("Error al preparar la consulta: " . mysqli_error($conexion));
        }

        // Vincular los parámetros a la declaración
        mysqli_stmt_bind_param($stmt, "i", $id_producto);

        // Ejecucion de la sentencia
        $resultado = mysqli_stmt_execute($stmt);

        // Verifica si la ejecución fue exitosa
        if ($resultado === false) {
            return false;
        } else {
            return true;
        }

        // Se cierra la sentencia preparada
        mysqli_stmt_close($stmt);
    }

    //Funcion para modificar los datos de un producto
    public static function actualizarDato($conexion, $id_producto, $nombre, $descripcion, $altura, $epoca, $tipo, $cuidado, $precio, $promocion)
    {
        //Preparación de la sentencia 
        $query = "UPDATE producto SET nombre=?, descripcion=?, altura=?, epoca=?, tipo=?, cuidado=?, precio=?, promocion=? WHERE id_producto=?";
        //Preparacion de sentencia con conexion
        $stmt = mysqli_prepare($conexion, $query);

        //Comprobación para ver si la sentencia se ha preparado correctamente
        if ($stmt === false) {
            die("Error al preparar la consulta: " . mysqli_error($conexion));
        }

        //Asignación del tipo de dato a cada parámetro de la sentencia
        mysqli_stmt_bind_param($stmt, "ssisssdsi", $nombre, $descripcion, $altura, $epoca, $tipo, $cuidado, $precio, $promocion, $id_producto);

        //Obtencion del resultado de la consulta
        $resultado = mysqli_stmt_execute($stmt);

        //Comprobación que se ha obtenido un resultado de la consulta
        if ($resultado === false) {
            return false;
        } else {
            return true;
        }

        //Se cierra la preparación de sentencias
        mysqli_stmt_close($stmt);
    }
}
