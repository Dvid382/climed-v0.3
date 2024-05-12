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
<?php include('dist/Plantilla.php');?>
</head>
<body>

    

    <?php
        require_once '../controlador/UsuariosController.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];

            $usuariosController = new UsuariosController();

            $resultado = $usuariosController->eliminarUsuario($id);

            if ($resultado) {
                echo "<script>alert('Usuario eliminado exitosamente.');</script>";
                header("Location: UsuariosIndex.php");
            } else {
                echo "Error al eliminar el Usuario.";
            }
        } else {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                $usuariosController = new UsuariosController();
                $usuario = $usuariosController->verUsuarioPorId($id);

                if (!$usuario) {
                    echo "Error: Usuario no encontrado.";
                    exit;
                }
            } else {
                echo "Error: ID del Usuario no proporcionado.";
                exit;
            }
        }
    ?>

    
    <div class="container-fluid pt-4 px-4">
        <center><h1>Eliminar Usuario</h1></center>
            <div class="bg-light rounded h-100 p-4">
                    <p class="alert alert-danger"> <i class="fa fa-warning"></i> ¿Estás seguro de que deseas eliminar el siguiente Usuario?</p>

                    <div class="col alert alert-warning">
                        <center>
                            <p><strong>Cedula:</strong>
                                <?php
                                    $personasUsuario = $controladorUsuario->buscarDatosPersonas($usuario['fk_persona']);
                                    echo $personasUsuario['cedula_persona'];
                                ?>
                            </p>
                            <p><strong>Nombre:</strong>
                            <?php
                                        $datosUsuario = $usuariosController->buscarDatosPersonas($usuario['fk_persona']);
                                        echo $datosUsuario['nombre_persona'] . " " . $datosUsuario['apellido_persona'];
                                        ?>
                            </p>
                        </center>
                    </div>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                        <input class="btn btn-outline-danger" type="submit" value="X Eliminar">
                        <a class="btn btn-outline-info" href="UsuariosIndex.php">Volver <i class="fa fa-right-to-bracket"></i></a>
                    </form>
            </div>
    </div>
    <script src="dist/js/validacionseguridad.js"></script>
</body>
</html>
