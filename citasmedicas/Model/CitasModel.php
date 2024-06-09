<?php
include_once '../conexion.php';

class CitasModel {
    private $conn;

    public function __construct() {
        $this->conn = conectarse();
    }

    public function agendarCita($especialidadID, $medicoID, $pacienteID, $fecha, $hora) {
        $estado = 'Programada';
        $activo = 1;

        $stmt = $this->conn->prepare("INSERT INTO citas (EspecialidadID, MedicoID, PacienteID, FechaAtencion, InicioAtencion, Estado, Activo) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiisssi", $especialidadID, $medicoID, $pacienteID, $fecha, $hora, $estado, $activo);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function cancelarCita($citaID) {
        $stmt = $this->conn->prepare("UPDATE citas SET Estado = 'Cancelada', Activo = 0 WHERE ID = ?");
        $stmt->bind_param("i", $citaID);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function cerrarConexion() {
        $this->conn->close();
    }
}
?>
