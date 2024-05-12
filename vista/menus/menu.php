<?php
require_once '../controlador/UsuariosController.php';
$controladorUsuario = new UsuariosController();
$vistas = $controladorUsuario->Vistas();
$controlar = $controladorUsuario->controlarAcceso(__FILE__);?>


    <?php
    $vistas = $controladorUsuario->Menu();
    echo $vistas;
    ?>
    