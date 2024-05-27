<?php

class Anotacion
{
    private $id_anotacion;
    private $nota;
    private $fecha_nota;
    private $id_planta;

    // Constructor
    public function __construct($id_anotacion = null, $nota = null, $fecha_nota = null, $id_planta = null)
    {
        $this->id_anotacion = $id_anotacion;
        $this->nota = $nota;
        $this->fecha_nota = $fecha_nota;
        $this->id_planta = $id_planta;
    }

    // Getters and setters...
    public function getIdAnotacion() { return $this->id_anotacion; }
    public function setIdAnotacion($id_anotacion) { $this->id_anotacion = $id_anotacion; }
    public function getNota() { return $this->nota; }
    public function setNota($nota) { $this->nota = $nota; }
    public function getFechaNota() { return $this->fecha_nota; }
    public function setFechaNota($fecha_nota) { $this->fecha_nota = $fecha_nota; }
    public function getIdPlanta() { return $this->id_planta; }
    public function setIdPlanta($id_planta) { $this->id_planta = $id_planta; }

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
}
?>
