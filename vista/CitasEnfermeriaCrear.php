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
                require_once('../controlador/CitasController.php');
                

                $citasController = new CitasController();

                if (isset($_GET['id'])) {
                    $citaId = $_GET['id'];
                    $cita = $citasController->verCitasEnfermeriaPorId($citaId);

                    if (isset($_POST['altura']) && isset($_POST['peso']) && isset($_POST['tension'])) {
                        $altura = $_POST['altura'];
                        $peso = $_POST['peso'];
                        $tension = $_POST['tension'];

                        require_once('../controlador/CitasEnfermeriaController.php');
                        $CitasEnfermeriaController = new CitasEnfermeriaController();
                        $CitasEnfermeriaController->crearCitaEnfermeria($altura, $peso, $tension, $citaId);

                        exit();
                    }
                }

            ?>


    <div class="container-fluid pt-4 px-4">
        <div class="bg-white rounded h-25 p-4" style="width: 90%; margin:auto;">
            <center><h1>Exámen Físico</h1></center>
            <form method="POST" enctype="multipart/form-data">

            <div class="row">
                <div class="col-sm-3">
                    <h5 class="card-subtitle">Cédula:</h5>
                    <p class="alert alert-info"><?php echo $cita['cedula_paciente']; ?></p>
                </div>
                <div class="col-sm-3">
                    <h5 class="card-subtitle">Nombre:</h5>
                    <p class="alert alert-info"><?php echo $cita['nombre_paciente']. " " .$cita['apellido_paciente']; ?></p>
                </div>
                <div class="col-sm-3">
                    <h5 class="card-subtitle">Médico:</h5>
                    <p class="alert alert-info"><?php echo $cita['nombre_medico']. " " . $cita['apellido_medico']; ?></p>
                </div>
                <div class="col-sm-3">
                    <h5 class="card-subtitle">Datos de la cita:</h5>
                    <p class="alert alert-info">Servicio: <?php echo $cita['nombre_servicio']. " Consultorio:" . $cita['nombre_consultorio'];?></p>
                </div>
            </div>
            

            <div class="form-floating mb-3 " id="divAltura">
                <input class="form-control" type="number" name="altura" id="altura" required>
                <label for="altura">Altura</label>
            </div>

            <div class="form-floating mb-3 " id="divPeso">
                <input class="form-control" type="number" name="peso" id="peso" required>
                <label for="peso">Peso</label>
            </div>

            <div class="form-floating mb-3 " id="divTension">
                <input class="form-control" type="text" name="tension" id="tension" required>
                <label for="tension">Tensión</label>
            </div>

                <div class="form-floating mb-3">
                    <button class="btn btn-outline-success" type="submit">Guardar. <i class="fa fa-check"></i></button>
                    <a class="btn btn-outline-info" href="CitasEnfermeriaIndex.php">Volver <i class="fa fa-right-to-bracket"></i></a>
                </div>
            </form>
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
    <script src="../dist/plantilla/js/main.js"></script>
        <script src="../dist/js/buscar.js"></script>
        <script src="../dist/js/validacionseguridad.js"></script>
    <!--     <script src="../dist/js/validarusuario.js"></script> -->
</body>
</html>