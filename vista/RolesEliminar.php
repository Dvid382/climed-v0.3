<?php
    require_once '../controlador/UsuariosController.php';
    $controladorUsuario = new UsuariosController();
    $usuarios = $controladorUsuario->verTodosUsuarios();
    $vistas = $controladorUsuario->Vistas();
$controlar = $controladorUsuario->controlarAcceso(__FILE__);

    require_once '../controlador/RolesController.php';

    $id = $_GET['id'];
    $RolController = new RolesController();
    $rol = $RolController->verPorId($id);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $RolController->eliminar($id);
        header('Location: RolIndex.php');
    }
?>

<!DOCTYPE html>
<html>
<head>
<?php include('dist/Plantilla.php');?>
</head>
<body>
<div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded h-100 p-4">
            <center><h1>Eliminar Rol</h1></center>
            <p class="alert alert-danger"> <i class="fa fa-warning"></i> <strong>¿Está seguro que desea eliminar el Rol "<?php echo $rol['nombre'] ?>"? </strong></p>
            <form method="POST">
                <input class="btn btn-outline-danger" type="submit" value="X Eliminar">
                <a class="btn btn-outline-info" href="ServiciosIndex.php">Volver <i class="fa fa-right-to-bracket"></i></a>
            </form>
        </div>
    </div>
    <script src="dist/js/validacionseguridad.js"></script>
</body>
</html>
