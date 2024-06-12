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
        require_once '../controlador/AsignacionesController.php';

        $id = $_GET['id'];
        $AsignacionesController = new AsignacionesController();
        $Asignaciones = $AsignacionesController->verPorId($id);
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $AsignacionesController->eliminarAsignacion($id);
        }
    ?>
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded h-100 p-4">
            <center><h1>Eliminar Servicio</h1></center>
            <p class="alert alert-danger"> <i class="fa fa-warning"></i> <strong>¿Está seguro que desea eliminar el Servicio "<?php echo $Asignaciones['nombre'] ?>"? </strong></p>
            <form method="POST">
    <button class="btn btn-outline-danger" type="button" onclick="mostrarSweetAlert()">X Eliminar</button>
    <a class="btn btn-outline-info" href="AsignacionesIndex.php">Volver <i class="fa fa-right-to-bracket"></i></a>
    </form>

        </div>
    </div>
    <script src="../dist/js/validacionseguridad.js"></script>
    <script>
        function mostrarSweetAlert() {
            swal({
                title: '¿Estás seguro?',
                text: 'Seguro que quieres Cancelar la Asignación?.',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    // Enviar el formulario si se confirma la eliminación
                    document.querySelector('form').submit();
                } else {
                    swal('¡La Asignación no ha sido Cancelada!');
                }
            });
        }
    </script>
</body>
</html>
