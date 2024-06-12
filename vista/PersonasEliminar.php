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
        require_once '../controlador/PersonasController.php';

        $id = $_GET['id'];
        $PersonasController = new PersonasController();
        $persona = $PersonasController->verPersonaPorId($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $PersonasController->eliminarPersona($id);
            header('Location: PersonasIndex.php');
        }
    ?>

    <div class="container-fluid pt-4 px-4">
            <div class="bg-light rounded h-100 p-4">
                <center><h1>Eliminar Persona</h1></center>
                <p class="alert alert-danger"> <i class="fa fa-warning"></i> <strong>¿Está seguro que desea eliminar a la persona "<?php echo $persona['nombre']. " ".$persona['apellido']?>"? </strong></p>
                <form method="POST">
                    <button class="btn btn-outline-danger" type="button" onclick="mostrarSweetAlert()">X Eliminar</button>
                    <a class="btn btn-outline-info" href="PersonasIndex.php">Volver <i class="fa fa-right-to-bracket"></i></a>
                </form>
            </div>
        </div>
        <script src="../dist/js/validacionseguridad.js"></script>
            <script>
        function mostrarSweetAlert() {
            swal({
                title: '¿Estás seguro?',
                text: 'Seguro que quieres eliminar a la persona?.',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    // Enviar el formulario si se confirma la eliminación
                    document.querySelector('form').submit();
                } else {
                    swal('¡La persona no ha sido eliminada!');
                }
            });
        }
    </script>
</body>
</html>
