<?php

include './../../models/anotacion.php';


class Planta
{
    private $id_planta;
    private $nombre;
    private $imagen;
    private $id_usuario;

    // Constructor
    public function __construct($id_planta = null, $nombre = null, $imagen = null, $id_usuario = null)
    {
        $this->id_planta = $id_planta;
        $this->nombre = $nombre;
        $this->imagen = $imagen;
        $this->id_usuario = $id_usuario;
    }

    // Getter for id_planta
    public function getIdPlanta()
    {
        return $this->id_planta;
    }

    // Setter for id_planta
    public function setIdPlanta($id_planta)
    {
        $this->id_planta = $id_planta;
    }

    // Getter for nombre
    public function getNombre()
    {
        return $this->nombre;
    }

    // Setter for nombre
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    // Getter for imagen
    public function getImagen()
    {
        return $this->imagen;
    }

    // Setter for imagen
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    // Getter for id_usuario
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    // Setter for id_usuario
    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    // Método para insertar en la base de datos
    public static function insertarPlanta($conn, $nombre, $url, $idUsuario)
    {
        try {

            $query = "INSERT INTO planta (nombre, imagen, id_usuario) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($query);

            if ($stmt === false) {
                throw new Exception("Error en la preparación de la consulta: " . $conn->error);
            }

            $stmt->bind_param("ssi", $nombre, $url, $idUsuario);

            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Error en la ejecución de la consulta: " . $stmt->error);
            }

            $stmt->close();
        } catch (Exception $exception) {
            echo "Error al insertar: " . $exception->getMessage();
            return false;
        }
    }

    // Método para consultar plantas desde la base de datos
    public static function consultarPlantas($conn, $idUsuario = null)
    {
        try {
            $query = "SELECT id_planta, nombre, imagen, id_usuario FROM planta WHERE id_usuario = ?";
            $stmt = $conn->prepare($query);

            if ($stmt === false) {
                throw new Exception("Error en la preparación de la consulta: " . $conn->error);
            }

            $stmt->bind_param("i", $idUsuario);

            $html = "";

            if ($stmt->execute()) {
                $accordionId = uniqid('accordionFlush'); // Unique id for the entire accordion
                $result = $stmt->get_result();

                while ($row = $result->fetch_assoc()) {
                    $idPlanta = $row['id_planta'];
                    $nombre = $row['nombre'];
                    $url = $row['imagen'];

                    // Consultar anotaciones para la planta actual
                    $anotaciones = Anotacion::consultarAnotaciones($conn, $idPlanta);
                    $anotacionesHtml = "";

                    foreach ($anotaciones as $anotacion) {
                        $anotacionesHtml .= "
                            <tr>
                                <td>" . $anotacion->getFechaNota() . "</td>
                                <td>" . $anotacion->getNota() . "</td>
                                <td>
                                    <button class='btn btnRed m-1' id='btnAnotacionEliminar' name='borrarAnotacion' value='" . $anotacion->getIdAnotacion() . "'>Eliminar </button>
                                </td>
                            </tr>";
                    }

                    $html .= "
                    <div class='accordion-item m-2'>
                        <form action='./../../views/myAccount/account.php' method='post'>
                        <h2 class='accordion-header' id='flush-heading-$idPlanta'>
                            <button class='accordion-button collapsed p-3 fs-6' type='button' data-bs-toggle='collapse' data-bs-target='#flush-collapse-$idPlanta' aria-expanded='false' aria-controls='flush-collapse-$idPlanta'>
                                $nombre
                            </button>
                        </h2>
                        <div id='flush-collapse-$idPlanta' class='accordion-collapse collapse' aria-labelledby='flush-heading-$idPlanta' data-bs-parent='#accordionFlushExample'>
                            <div class='container mt-1 bg-dark text-white'>
                                <h4 class='pt-4 fs-6 '>Anotaciones</h4>
                                <hr>
                                <div class='d-flex m-4'>
                                    <div class='input-group w-50'>
                                        <textarea class='form-control' name='anotacion' placeholder='Descrición de nueva anotación'></textarea>
                                    </div>
                                    <button type='submit' name='anadirAnotacion' value='$idPlanta' id='btnAnadirPlanta' class='btn position-relative m-4'>Añadir Anotacion</button>
                                </div>

                                <div class='row justify-content-evenly text-center'>
                                    <div class='flex col-sm-8'>
                                        <table class='table text-white'>
                                            <thead>
                                                <tr>
                                                    <th scope='col'>Fecha de anotación</th>
                                                    <th scope='col'>Nota</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                $anotacionesHtml
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class='col-sm-3'>
                                        
                                        <div class='text-center mb-4'>
                                            <img src='./../../$url' class='img-fluid img-thumbnail rounded' alt='mi Planta'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <button type='submit' name='borrarPlanta' value='$idPlanta' id='btnPlantaDelete' class='btn btnRed position-relative m-4'>Eliminar Planta</button>
                            </div>
                        </form>
                    </div>";
                }

                return $html;
            } else {
                throw new Exception("Error en la ejecución de la consulta: " . $stmt->error);
            }

            $stmt->close();
        } catch (Exception $exception) {
            echo "Error al consultar: " . $exception->getMessage();
            return false;
        }
    }

    // Método para consultar anotaciones por id_planta
    public static function consultarAnotaciones($conn, $idPlanta)
    {
        try {
            $query = "SELECT id_anotacion, nota, fecha_nota, id_planta FROM anotacion WHERE id_planta = ?";
            $stmt = $conn->prepare($query);

            if ($stmt === false) {
                throw new Exception("Error en la preparación de la consulta: " . $conn->error);
            }

            $stmt->bind_param("i", $idPlanta);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $anotaciones = [];

                while ($row = $result->fetch_assoc()) {
                    $anotacion = new Anotacion(
                        $row['id_anotacion'],
                        $row['nota'],
                        $row['fecha_nota'],
                        $row['id_planta']
                    );
                    $anotaciones[] = $anotacion;
                }

                $stmt->close();
                return $anotaciones;
            } else {
                throw new Exception("Error en la ejecución de la consulta: " . $stmt->error);
            }
        } catch (Exception $exception) {
            echo "Error al consultar anotaciones: " . $exception->getMessage();
            return false;
        }
    }


    // Método para eliminar una planta y sus anotaciones relacionadas
    public static function borrarPlanta($conn, $idPlanta)
    {
        try {
            // Eliminar anotaciones relacionadas
            $query = "DELETE FROM anotacion WHERE id_planta = ?";
            $stmt = $conn->prepare($query);

            if ($stmt === false) {
                throw new Exception("Error en la preparación de la consulta para eliminar anotaciones: " . $conn->error);
            }

            $stmt->bind_param("i", $idPlanta);

            if (!$stmt->execute()) {
                throw new Exception("Error en la ejecución de la consulta para eliminar anotaciones: " . $stmt->error);
            }

            $stmt->close();

            // Eliminar la planta
            $query = "DELETE FROM planta WHERE id_planta = ?";
            $stmt = $conn->prepare($query);

            if ($stmt === false) {
                throw new Exception("Error en la preparación de la consulta para eliminar planta: " . $conn->error);
            }

            $stmt->bind_param("i", $idPlanta);

            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                throw new Exception("Error en la ejecución de la consulta para eliminar planta: " . $stmt->error);
            }
        } catch (Exception $exception) {
            echo "Error al eliminar planta: " . $exception->getMessage();
            return false;
        }
    }
}
