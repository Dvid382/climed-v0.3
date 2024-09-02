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

    require_once '../controlador/UsuariosController.php';

    $id = $_GET['id'];
    $usuariosController = new UsuariosController();
    $usuario = $usuariosController->verUsuarioPorId($id);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $usuariosController->eliminarUsuario($id);
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
                                    $personasUsuario = $usuariosController->buscarDatosPersonas($usuario['fk_persona']);
                                    echo $personasUsuario['cedula_persona'];
                                ?>
                            </p>
                            <p><strong>Nombre:</strong>
                            <?php
                                        $datosUsuario = $usuariosController->buscarDatosPersonas($usuario['fk_persona']);
                                        echo $datosUsuario['nombre_persona'] . " " . $datosUsuario['apellido_persona']. " " . $datosUsuario['fk_rol'];
                                        ?>
                            </p>

                            <p><strong>Rol:</strong>
                            <?php
                                        $datosRolUsuario = $usuariosController->buscarNombreRol($usuario['fk_rol']);
                                        echo $datosRolUsuario['nombre_rol'];
                                        ?>
                            </p>
                        </center>
                    </div>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">

                        <?php
                        if ($_SESSION['id_usuario'] == $usuario['id']) {
                            echo "<script>
                                        swal({
                                        title: 'Error',
                                        text: 'No se puede Autodestruir un usuario.',
                                        icon: 'error',
                                        }).then((willRedirect) => {
                                        if (willRedirect) {
                                            window.location.href = 'UsuariosIndex.php'; // Redirige a tu página PHP
                                        }
                                        });
                                    </script>";
                            exit;
                        }elseif($datosRolUsuario['valor_rol'] == "1") {
                            echo "<script>
                            swal({
                               title: 'Error',
                               text: 'No se puede Eliminar un usuario Administrador.',
                               icon: 'error',
                            }).then((willRedirect) => {
                               if (willRedirect) {
                                  window.location.href = 'UsuariosIndex.php'; // Redirige a tu página PHP
                               }
                            });
                         </script>";
                            exit;
                        }
                        ?>
                        <button class="btn btn-outline-danger" type="button" onclick="mostrarSweetAlert()">X Eliminar</button>
                        <a class="btn btn-outline-info" href="UsuariosIndex.php">Volver <i class="fa fa-right-to-bracket"></i></a>
                    </form>
            </div>
    </div>
    <script src="../dist/js/validacionseguridad.js"></script>
        <script>
        function mostrarSweetAlert() {
            swal({
                title: '¿Estás seguro?',
                text: 'Seguro que quieres eliminar el usuario?.',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    // Enviar el formulario si se confirma la eliminación
                    document.querySelector('form').submit();
                } else {
                    swal('¡El usuario no ha sido eliminado!');
                }
            });
        }
    </script>
</body>
</html>
