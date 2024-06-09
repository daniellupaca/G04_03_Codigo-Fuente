<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/citasmedicas/conexion.php';

class MedicoModel {
    private $conn;
    private $table_name = "medicos";

    public function __construct() {
        $this->conn = conectarse();
    }

    public function insertarDoctor($data) {
        $nombre = $this->conn->real_escape_string($data['Nombres']);
        $apellido = $this->conn->real_escape_string($data['Apellidos']);
        $DNI = $this->conn->real_escape_string($data['DNI']);
        $direccion = $this->conn->real_escape_string($data['Direccion']);
        $correo = $this->conn->real_escape_string($data['Correo']);
        $telefono = $this->conn->real_escape_string($data['Telefono']);
        $sexo = $this->conn->real_escape_string($data['Sexo']);
        $numColegiatura = $this->conn->real_escape_string($data['NumColegiatura']);
        $fecha_nac = $this->conn->real_escape_string($data['FechaNacimiento']);
        $estado = $this->conn->real_escape_string($data['Activo']);

        $query = "INSERT INTO $this->table_name (Nombres, Apellidos, DNI, Direccion, Correo, Telefono, Sexo, NumColegiatura, FechaNacimiento, Activo)
                  VALUES ('$nombre', '$apellido', '$DNI', '$direccion', '$correo', '$telefono', '$sexo', '$numColegiatura', '$fecha_nac', 1)";

        if ($this->conn->query($query) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function obtenerDetalleDoctor($ID) {
        $ID = $this->conn->real_escape_string($ID);
        $query = "SELECT medicos.ID, medicos.Nombres, medicos.Apellidos, medicos.Direccion,
                  medicos.Correo, medicos.Telefono, medicos.Sexo, medicos.NumColegiatura, medicos.FechaNacimiento, medicos.Activo
                  FROM $this->table_name 
                  WHERE medicos.ID = '$ID'";
        
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function updateDoctor($data) {
        $query = "UPDATE $this->table_name SET
                    Nombres = '{$this->conn->real_escape_string($data['Nombres'])}',
                    Apellidos = '{$this->conn->real_escape_string($data['Apellidos'])}',
                    Direccion = '{$this->conn->real_escape_string($data['Direccion'])}',
                    Correo = '{$this->conn->real_escape_string($data['Correo'])}',
                    Telefono = '{$this->conn->real_escape_string($data['Telefono'])}',
                    Sexo = '{$this->conn->real_escape_string($data['Sexo'])}',
                    NumColegiatura = '{$this->conn->real_escape_string($data['NumColegiatura'])}',
                    FechaNacimiento = '{$this->conn->real_escape_string($data['FechaNacimiento'])}',
                    Activo = {$this->conn->real_escape_string($data['Activo'])}
                    WHERE ID = '{$this->conn->real_escape_string($data['ID'])}'";

        return $this->conn->query($query);
    }

    public function listarDoctores() {
        $query = "SELECT ID, Nombres, Apellidos, DNI, Direccion, Correo, Telefono, Sexo, NumColegiatura, FechaNacimiento, Activo 
                  FROM $this->table_name";
        $result = $this->conn->query($query);
        if ($result) {
            return $result;
        } else {
            return null;
        }
    }
}
?>
