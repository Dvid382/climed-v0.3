<?php
require_once '../controlador/UsuariosController.php';
$controladorUsuario = new UsuariosController();
$usuarios = $controladorUsuario->verTodosUsuarios();
$vistas = $controladorUsuario->Vistas();
$controlar = $controladorUsuario->controlarAcceso(__FILE__);

require_once('../controlador/CitasController.php');
$citasController = new CitasController();

if (isset($_GET['id'])) {
    $citaId = $_GET['id'];
    $cita = $citasController->verCitasEnfermeriaMedicoPorId($citaId);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_receta'])) {
        $receta = $_POST['receta'];
        $f_inicio = $_POST['f_inicio'];
        $f_fin = $_POST['f_fin'];
        $fk_medicamento = $_POST['fk_medicamento'];

        // Lógica para guardar la receta
        // $citasMedicoController->CrearReceta(...);

        // Simulación de guardado
        echo "Receta guardada con éxito.";
        
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<?php include('../dist/Plantilla.php');?>
</head>
<body>

<div class="container-fluid pt-4 px-4">
    <div class="bg-white rounded h-25 p-4" style="width: 90%; margin:auto;">
        <h1 class="text-center mb-4">Crear Receta</h1>
        <form method="post" id="formulario-receta" autocomplete="off">
            <input type="hidden" value="<?php echo $cita['citas_enfermeria_id'];?>" name="citas_enfermeria_id">
            <div class="form-group">
                <label for="receta">Receta:</label>
                <textarea class="form-control" name="receta" id="receta" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="f_inicio">Fecha de Inicio:</label>
                <input class="form-control" type="date" name="f_inicio" id="f_inicio" required>
            </div>

            <div class="form-group">
                <label for="f_fin">Fecha de Fin:</label>
                <input class="form-control" type="date" name="f_fin" id="f_fin" required>
            </div>

            <div class="form-group">
                <label for="fk_medicamento">Medicamentos:</label>
                <select class="form-control" name="fk_medicamento" id="fk_medicamento" required>
                    <?php
                    require_once('../controlador/MedicamentosController.php');
                    $MedicamentosController = new MedicamentosController();
                    $medicamentos = $MedicamentosController->verTodos();
                    foreach ($medicamentos as $medicamento) {
                        echo "<option value='" . $medicamento['id'] . "'>" . $medicamento['nombre_comercial'] . " " . $medicamento['nombre_unidad_medida'] . " " . $medicamento['cantidad'] . " " . $medicamento['nombre_unidad_peso'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-success m-2">Guardar Receta</button>
        </form>
    </div>
</div>

<!-- Libreries JS -->
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
<script src="../dist/plantilla/js/main.js"></script>
<script src="../dist/js/buscar.js"></script>
<script src="../dist/js/validacionseguridad.js"></script>

</body>
</html>