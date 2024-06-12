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
    <div class="container-fluid pt-4 px-4">
    <div class="bg-white rounded h-25 p-4" style="width: 50%; margin:auto;">

                <center><h1>Editar cargos</h1></center>

                <?php
                    require_once('../controlador/CargosController.php');

                    // Crear una instancia de rolcontroller
                    $cargoscontroller = new CargosController();

                    // Verificar si se recibió el ID del Rol a editar
                    if (isset($_GET['id'])) {
                        $cargosId = $_GET['id'];

                        // Obtener los datos del Rol con el ID proporcionado
                        $cargos = $cargoscontroller->verPorId($cargosId);

                        // Verificar si se enviaron los datos actualizados del Rol
                        if (isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['estado']) && isset($_POST['fk_servicios'])) {
                            $nuevoNombre = $_POST['nombre'];
                            $nuevoDescripcion = $_POST['descripcion'];
                            $nuevoEstado = $_POST['estado'];
                            $nuevoFk_servicio = $_POST['fk_servicios'];
                            
                           
                            

                            // Actualizar los datos del Rol con los nuevos valores
                            $cargoscontroller->modificar($cargosId, $nuevoNombre, $nuevoDescripcion, $nuevoEstado, $nuevoFk_servicio);

                            exit();
                        }
                    }
                ?>

                <form method="POST">


                    <div class="form-floating mb-3">
                        <input class="form-control " type="text" name="nombre" id="nombre" value="<?php echo $cargos['nombre']; ?> ">
                        <label for="nombre">Nombre:</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input class="form-control " type="text" name="descripcion" id="descripcion" value="<?php echo $cargos['descripcion']; ?> ">
                        <label for="nombre">Descripcion:</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" name="estado" id="estado">
                            <?php if ($cargos['estatus'] == 1) {
                                    echo' <option value="1">Activo</option>
                                        <option value="0">Inactivo</option>';
                                        } else {
                                echo ' <option value="0">Inactivo</option>
                                        <option value="1">Activo</option>
                                        ';
                                }
                            ?>
                        </select>
                        <label for="estado">Estatus:</label>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <select class="form-select" id="fk_servicios" aria-label="Default select example" name="fk_servicios" required>
                            <option value="">Seleccione un Servicio</option>
                            <?php
                                require_once '../controlador/ServiciosController.php';
                                $ServiciosController = new ServiciosController();
                                $servicios = $ServiciosController->verTodos();

                                foreach ($servicios as $servicio) {
                                    echo "<option value='" . $servicio['id'] . "'>" . $servicio['nombre'] . "</option>";
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-floating mb-3">
                        <button class="btn btn-outline-success" type="submit">Guardar cargos. <i class="fa fa-check"></i></button>
                        <a class="btn btn-outline-info" href="CargosIndex.php">Volver <i class="fa fa-right-to-bracket"></i></a>
                    </div>

                </form>
                <?php /* var_dump($nombre, $estatus, $valor, $descripcion ); */?>

            </div>
        </div>
        <!-- libreries JS -->
        <script src="../dist/js/jquery-3.7.1.min.js"></script>
        <script src="../dist/plantilla/lib/bootstrap.bundle.min.js"></script>
            <script src="../dist/plantilla/lib/chart/chart.min.js"></script>
                <script src="../dist/plantilla/lib/easing/easing.min.js"></script>
                    <script src="../dist/plantilla/lib/waypoints/waypoints.min.js"></script>
                <script src="../dist/plantilla/lib/owlcarousel/owl.carousel.min.js"></script>
            <script src="../dist/plantilla/lib/tempusdominus/js/moment.min.js"></script>
        <script src="../dist/plantilla/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../dist/plantilla/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- Template Javascript -->
        <script src="../dist/js/LimpiarInput.js"></script>
        <script src="../dist/plantilla/js/main.js"></script>
            <script src="../dist/js/buscar.js"></script>
            <script src="../dist/js/validaciongenerica.js"></script>
        <script src="../dist/js/validacionseguridad.js"></script>
    </body>
</html>
