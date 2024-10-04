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

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_reposo'])) {
        $descripcion = $_POST['descripcion'];
        $f_inicio_evolucion = $_POST['f_inicio_evolucion'];
        $f_fin_evolucion = $_POST['f_fin_evolucion'];

        // Lógica para guardar el reposo
        // Aquí puedes llamar a la función que guarda el reposo en la base de datos
        // Ejemplo: $citasMedicoController->CrearReposo(...);

        // Simulación de guardado
        echo "<script>alert('Reposo guardado con éxito.');</script>";
        
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php include('../dist/Plantilla.php'); ?>
</head>
<body>

<div class="container-fluid pt-4 px-4">
    <div class="bg-white rounded h-25 p-4" style="width: 90%; margin:auto;">
        <h1 class="text-center mb-4">Crear Reposo</h1>
        <form method="post" id="formulario-evolucion" autocomplete="off">
            <input type="hidden" value="<?php echo $cita['citas_enfermeria_id']; ?>" name="citas_enfermeria_id">
            
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea class="form-control" name="descripcion" id="descripcion" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="f_inicio_evolucion">Fecha de Inicio:</label>
                <input class="form-control" type="date" name="f_inicio_evolucion" id="f_inicio_evolucion" required>
            </div>

            <div class="form-group">
                <label for="f_fin_evolucion">Fecha de Fin:</label>
                <input class="form-control" type="date" name="f_fin_evolucion" id="f_fin_evolucion" required>
            </div>

            <button type="submit" name="submit_reposo" class="btn btn-success m-2">Guardar Reposo</button>
        </form>
    </div>
</div>

<!-- Librerías JS -->
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