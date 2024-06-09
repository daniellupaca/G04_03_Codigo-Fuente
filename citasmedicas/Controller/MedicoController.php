<?php
include_once '../../Model/MedicoModel.php';

class MedicoController {
    private $medicoModel;

    public function __construct() {
        $this->medicoModel = new MedicoModel();
    }

    public function insertarDoctor($data) {
        return $this->medicoModel->insertarDoctor($data);
    }

    public function obtenerDetalleDoctor($id) {
        return $this->medicoModel->obtenerDetalleDoctor($id);
    }

    public function updateDoctor($data) {
        return $this->medicoModel->updateDoctor($data);
    }

    public function listarDoctores() {
        return $this->medicoModel->listarDoctores();
    }
}

// Manejo de la solicitud AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'getDoctorDetails') {
    $id = $_POST['id'];
    $controller = new MedicoController();
    $doctorDetails = $controller->obtenerDetalleDoctor($id);
    echo json_encode($doctorDetails);
    exit();
}
?>
