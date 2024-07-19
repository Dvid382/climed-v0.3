<?php
require_once '../controlador/UsuariosController.php';
require_once '../controlador/CitasController.php';

$controladorUsuario = new UsuariosController();
$usuarios = $controladorUsuario->verTodosUsuarios();
$vistas = $controladorUsuario->Vistas();
$controlar = $controladorUsuario->controlarAcceso(__FILE__);

$CitasController = new CitasController();

// Verificar si se recibió el ID del paciente
if (isset($_GET['id'])) {
    $pacienteId = $_GET['id'];
    $datosHistoria = $CitasController->VerDatosHistoriaMedica($pacienteId);
} else {
    // Manejar el caso en que no se proporciona un ID
    die("No se proporcionó un ID de paciente válido.");
}

if (!$datosHistoria) {
    die("No se encontraron datos para este paciente.");
}

$datosPaciente = $datosHistoria['datos_paciente'];
$historiaMedica = $datosHistoria['historia_medica'];
?>

<!DOCTYPE html>
<html>
<head>
    <?php include('../dist/Plantilla.php');?>
    <title>Historia Médica del Paciente</title>
</head>
<body>
    <div class="container-fluid pt-4 px-4">
        <div class="card bg-light shadow-sm align-items-center" style="width: 80%; margin: auto; margin-top: -30px;">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <center><h2 class="card-title text-primary">Historia Médica del Paciente: <?php echo $datosPaciente['nombre_paciente'] . " " . $datosPaciente['apellido_paciente']; ?></h2></center>
                        
                        <div class="row mb-3">
    <h3>Historia Médica</h3><br><br>
    <div class="form-floating mb-3">
        <a class="btn btn-outline-info" href="HistoriasMedicasIndex.php">X</a>
    </div>
    <?php foreach ($historiaMedica as $fecha => $citasPorFecha): ?>
        <h4>Fecha: <?php echo date('d/m/Y', strtotime($fecha)); ?></h4><br><br>
        <?php foreach ($citasPorFecha as $claveCita => $cita): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Cita a las <?php echo $cita['hora']; ?></h5><br>
                    <p>Médico: <?php echo $cita['nombre_medico'] . ' ' . $cita['apellido_medico']; ?></p>
                    <p>Servicio: <?php echo $cita['nombre_servicio']; ?></p>
                    <p>Consultorio: <?php echo $cita['nombre_consultorio']; ?></p>
                    <p>Diagnóstico: <?php echo $cita['diagnostico_paciente']; ?></p>
                    <p>Patología: <?php echo $cita['patologia_paciente']; ?></p>
                    <p>Laboratorio: <?php echo $cita['laboratorio_paciente']; ?></p>
                    <p>Indicación medica: <?php echo $cita['receta_paciente']; ?></p>
                    <p>Medicamento: <?php echo $cita['nombre_medicamento']; ?></p>
                    <p>Tiempo del tratamiento: Desde el <?php echo $cita['inicio_recipe']. " al " . $cita['fin_recipe']; ?></p>
                    <p>Reposo: <?php echo $cita['descripcion_reposo']; ?></p>
                    <p>Tiempo estimado del reposo: Desde el <?php echo $cita['inicio_reposo'] ." al ". $cita['inicio_reposo']; ?></p>
                    <p>Altura: <?php echo $cita['altura_paciente']; ?> cm</p>
                    <p>Peso: <?php echo $cita['peso_paciente']; ?> kg</p>
                    <p>Tensión: <?php echo $cita['tension_paciente']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>
                    </div>
                </div>
            </div>
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
<!--     <script src="../dist/js/validarpersona.js"></script> -->
    <script src="../dist/js/validacionseguridad.js"></script>
</body>