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
                

                <?php
                    require_once('../controlador/CitasController.php');

                    // Crear una instancia de rolcontroller
                    $CitasController = new CitasController();

                    // Verificar si se recibió el ID del Rol a editar
                    if (isset($_GET['id'])) {
                        $citasId = $_GET['id'];

                    }
                    $datos = $CitasController->VerDatos($citasId);
                ?>

<div class="card bg-light shadow-sm align-items-center" style="width: 80%; margin: auto; margin-top: -30px;">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <center><h2 class="card-title text-primary">Datos de: <?php echo $datos['nombre_paciente']. " ". $datos['apellido_paciente']; ?></h2></center>
                
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Cédula:</h5>
                        <p class="alert alert-info"><?php echo $datos['cedula_paciente']; ?></p>
                    </div>
                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Nombre:</h5>
                        <p class="alert alert-info"><?php echo $datos['nombre_paciente']; ?></p>
                    </div>
                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Segundo Nombre:</h5>
                        <p class="alert alert-info"><?php echo $datos['segundo_nombre_paciente']; ?></p>
                    </div>
                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Apellido:</h5>
                        <p class="alert alert-info"><?php echo $datos['apellido_paciente']; ?></p>
                    </div>

                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Segundo Apellido:</h5>
                        <p class="alert alert-info"><?php echo $datos['segundo_apellido_paciente']; ?></p>
                    </div>

                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Fecha de Nacimiento:</h5>
                        <p class="alert alert-info"><?php echo date('d/m/Y', strtotime($datos['fecha_nacimiento'])); ?></p>
                    </div>

                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Edad:</h5>
                        <p class="alert alert-info"><?php $f_nacimiento = "$datos[fecha_nacimiento]"; // Reemplazar con la fecha de nacimiento real
                                    $fecha_actual = date('Y-m-d');

                                    $diferencia_en_segundos = strtotime($fecha_actual) - strtotime($f_nacimiento);
                                    $segundos_en_un_año = 365.25 * 24 * 60 * 60;
                                    $edad_en_años = floor($diferencia_en_segundos / $segundos_en_un_año);

                                    echo " $edad_en_años";?></p>
                    </div>

                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Sexo:</h5>
                        <p class="alert alert-info"><?php echo $datos['sexo'] == 1 ? 'Masculino' : 'Femenino'; ?></p>
                    </div>

                </div>

                <div class="row mb-3">
                    <p>Datos del Doctor</p>
                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Nombre:</h5>
                        <p class="alert alert-info"><?php echo $datos['nombre_medico']; ?></p>
                    </div>
                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Apellido:</h5>
                        <p class="alert alert-info"><?php echo $datos['apellido_medico']; ?></p>
                    </div>
                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Servicio:</h5>
                        <p class="alert alert-info"><?php echo $datos['nombre_servicio']; ?></p>
                    </div>

                </div>

                <div class="row mb-3">
                    <p>Datos de  la cita</p>

                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Fecha y hora:</h5>
                        <p class="alert alert-info">Programada el <?php echo $datos['fecha']. " a las ". $datos['hora']; ?></p>
                    </div>

                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Consultorio:</h5>
                        <p class="alert alert-info"><?php echo $datos['nombre_consultorio']; ?></p>
                    </div>

                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Usuario que creo la cita:</h5>
                        <p class="alert alert-info"><?php echo $datos['nombre_usuario']. " ". $datos['apellido_usuario']; ?></p>
                    </div>
<!-- 
                
                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Teléfono:</h5>
                        <p class="alert alert-info"><?php echo $datos['telefono']; ?></p>
                    </div>
                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Correo:</h5>
                        <p class="alert alert-info"><?php echo $datos['correo']; ?></p>
                    </div>

                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Dirección:</h5>
                        <p class="alert alert-info"><?php echo $datos['direccion']; ?></p>
                    </div> -->

                    <div class="col-sm-3">
                    <h5 class="card-subtitle">Estatus:</h5>
                    <p class="alert alert-info">
                                <?php
                                    switch ($datos['estatus']) {
                                        case 1:
                                            echo 'CREADA';
                                            break;
                                        case 2:
                                            echo 'NOTIFICADA';
                                            break;
                                        case 3:
                                            echo 'CONFIRMADA';
                                            break;
                                        case 4:
                                            echo 'REVISIÓN';
                                            break;
                                        case 5:
                                            echo 'EN PROCESO';
                                            break;
                                        case 6:
                                            echo 'FINALIZADA';
                                            break;
                                        default:
                                            echo 'CANCELADA';
                                            break;
                                    }
                                ?></p>
                    </div>
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