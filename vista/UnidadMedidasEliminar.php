<?php
    require_once '../controlador/UsuariosController.php';
    $controladorUsuario = new UsuariosController();
    $usuarios = $controladorUsuario->verTodosUsuarios();
    $vistas = $controladorUsuario->Vistas();
$controlar = $controladorUsuario->controlarAcceso(__FILE__);
?>

<!DOCTYPE html>
<html>
<head>
<?php include('../dist/Plantilla.php');?>
</head>
<body>

    <?php
        require_once '../controlador/UnidadMedidasController.php';

        $id = $_GET['id'];
        $UnidadMedidasController = new UnidadMedidasController();
        $unidadmedida = $UnidadMedidasController->verPorId($id);
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $UnidadMedidasController->eliminar($id);
        }
    ?>
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded h-100 p-4">
            <center><h1>Eliminar forma farmacéutica</h1></center>
            <p class="alert alert-danger"> <i class="fa fa-warning"></i> <strong>¿Está seguro que desea eliminar la forma farmacéutica "<?php echo $unidadmedida['nombre'] ?>"? </strong></p>
            <form method="POST">
                <input class="btn btn-outline-danger" type="submit" value="X Eliminar">
                <a class="btn btn-outline-info" href="UnidadMedidasIndex.php">Volver <i class="fa fa-right-to-bracket"></i></a>
            </form>
        </div>
    </div>
    <script src="dist/js/validacionseguridad.js"></script>
</body>
</html>
