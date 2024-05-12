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
    <div class="container-fluid pt-4 px-4">
    <div class="bg-white rounded h-25 p-4" style="width: 50%; margin:auto;">
                

                <?php
                    require_once('../controlador/RolesController.php');

                    // Crear una instancia de rolcontroller
                    $rolcontroller = new RolesController();

                    // Verificar si se recibió el ID del Rol a editar
                    if (isset($_GET['id'])) {
                        $rolId = $_GET['id'];

                        // Obtener los datos del Rol con el ID proporcionado
                        $rol = $rolcontroller->verPorId($rolId);

                        // Verificar si se enviaron los datos actualizados del Rol
                        if (isset($_POST['nombre']) && isset($_POST['estado']) && isset($_POST['valor']) && isset($_POST['descripcion'])) {
                            $nuevoNombre = $_POST['nombre'];
                            $nuevoEstado = $_POST['estado'];
                            $nuevoValor = $_POST['valor'];
                            $nuevoDescripcion = $_POST['descripcion'];
                            

                            // Actualizar los datos del Rol con los nuevos valores
                            $rolcontroller->modificar($rolId, $nuevoNombre, $nuevoEstado, $nuevoValor, $nuevoDescripcion);

                            exit();
                        }
                    }
                ?>
                
                <center><h1>Editar Rol</h1></center>    

                <form method="POST">

                    <div class="form-floating mb-3">    
                        <input class="form-control form-control-lg" type="text" name="nombre" id="nombre" autocomplete="off" value="<?php echo $rol['nombre']; ?> ">
                        <label class="form-label form-control-sm" for="nombre">Nombre:</label>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <select class="form-select" name="estado" id="estado">
                            <?php if ($rol['estatus'] == true) {
                                    echo' <option value="1">Activo</option>
                                        <option value="0">Inactivo</option>';
                                        } else {
                                echo ' <option value="0">Inactivo</option>
                                        <option value="1">Activo</option>
                                        ';
                                }
                            ?>
                        </select>
                        <label class="form-label form-control-sm" for="estado">Estado:</label>
                    </div> 

                    <div class="form-floating mb-3">
                        <select class="form-select" name="valor" id="valor">
                            <?php if ($rol['valor'] == 1) {
                                    echo' <option value="1">Administrador</option>';
                                    echo '<option value="2">Director</option>';
                                    echo' <option value="3">Analista</option>';
                                    echo' <option value="4">Médico</option>';
                                    echo' <option value="5">Enfermera</option>';
                                        } else {
                                            if ($rol['valor'] == 2) {
                                                echo' <option value="2">Director</option>';
                                                echo '<option value="1">Administrador</option>';
                                                echo' <option value="3">Analista</option>';
                                                echo' <option value="4">Médico</option>';
                                                echo' <option value="5">Enfermera</option>';
                                        } else {
                                            if ($rol['valor'] == 3) {
                                                echo' <option value="3">Analista</option>';
                                                echo '<option value="1">Administrador</option>';
                                                echo' <option value="2">Director</option>';
                                                echo' <option value="4">Médico</option>';
                                                echo' <option value="5">Enfermera</option>';
                                        } else{
                                            if ($rol['valor'] == 4) {
                                                echo' <option value="4">Médico</option>';
                                                echo '<option value="1">Administrador</option>';
                                                echo' <option value="2">Director</option>';
                                                echo' <option value="3">Analista</option>';
                                                echo' <option value="5">Enfermera</option>';
                                    } else{
                                        if ($rol['valor'] == 5) {
                                            echo' <option value="5">Enfermera</option>';
                                            echo '<option value="1">Administrador</option>';
                                            echo' <option value="2">Director</option>';
                                            echo' <option value="3">Analista</option>';
                                            echo' <option value="4">Médico</option>';
                                            }
                                    }}}}                     
                            ?>
                        </select>
                        <label class="form-label form-control-sm" for="valor">Valor:</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input class="form-control form-control-lg" type="text" name="descripcion" autocomplete="off" id="descripcion" value="<?php echo $rol['descripcion']; ?> ">
                        <label class="form-label form-control-sm" for="nombre">Descripcion:</label>
                    </div>

                    <div class="form-floating mb-3">
                        <button class="btn btn-outline-success" type="submit">Guardar rol <i class="fa fa-check"></i></button>
                        <a class="btn btn-outline-info" href="RolesIndex.php">Volver <i class="fa fa-right-to-bracket"></i></a>
                    </div>

                </form>
                <?php /* var_dump($nombre, $estatus, $valor, $descripcion ); */?>
            </div>
        </div>

        <!-- libreries JS -->
        <script src="dist/js/jquery-3.7.1.min.js"></script>
            <script src="dist/plantilla/lib/bootstrap.bundle.min.js"></script>
                <script src="dist/plantilla/lib/chart/chart.min.js"></script>
                    <script src="dist/plantilla/lib/easing/easing.min.js"></script>
                        <script src="dist/plantilla/lib/waypoints/waypoints.min.js"></script>
                    <script src="dist/plantilla/lib/owlcarousel/owl.carousel.min.js"></script>
                <script src="dist/plantilla/lib/tempusdominus/js/moment.min.js"></script>
            <script src="dist/plantilla/lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="dist/plantilla/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- Template Javascript -->
        <script src="dist/js/LimpiarInput.js"></script>
        <script src="dist/plantilla/js/main.js"></script>
            <script src="dist/js/buscar.js"></script>
        <script src="dist/js/validaciongenerica.js"></script>
        <script src="dist/js/validacionseguridad.js"></script>

    </body>
</html>
