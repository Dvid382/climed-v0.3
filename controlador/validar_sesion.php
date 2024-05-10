<?php
require_once 'UsuariosController.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cedula = $_POST['cedula'];
    $clave = $_POST['clave'];

    $sesionController = new UsuariosController();
    $sesionController->iniciarSesion($cedula, $clave);
}
?>
