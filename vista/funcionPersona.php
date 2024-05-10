<?php
require_once '../controlador/PersonasController.php';
$PersonasController = new PersonasController();
$persona = $PersonasController->verPersonaPorCedula($_POST['cedula']);

if (isset($persona['nombre']) && isset($persona['apellido'])) {
    $response = array(
        'id' => $persona['id'],
        'nombre' => $persona['nombre'],
        'apellido' => $persona['apellido']
    );
    echo json_encode($response);
} else {
    $response = array(
        'id' => '',
        'nombre' => '',
        'apellido' => ''
    );
    echo json_encode($response);
}
?>
