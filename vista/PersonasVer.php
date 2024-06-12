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
                    require_once('../controlador/PersonasController.php');

                    // Crear una instancia de rolcontroller
                    $PersonasController = new PersonasController();

                    // Verificar si se recibió el ID del Rol a editar
                    if (isset($_GET['id'])) {
                        $personaId = $_GET['id'];

                        // Obtener los datos del Rol con el ID proporcionado
                        $persona = $PersonasController->verPersonaPorId($personaId);

                    }

                ?>

<div class="card bg-light shadow-sm align-items-center" style="width: 80%; margin: auto; margin-top: -30px;">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <center><h2 class="card-title text-primary">Datos de: <?php echo $persona['nombre']. " ". $persona['apellido']; ?></h2></center>
                
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Cédula:</h5>
                        <p class="alert alert-info"><?php echo $persona['cedula']; ?></p>
                    </div>
                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Nombre:</h5>
                        <p class="alert alert-info"><?php echo $persona['nombre']; ?></p>
                    </div>
                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Segundo Nombre:</h5>
                        <p class="alert alert-info"><?php echo $persona['segundo_nombre']; ?></p>
                    </div>
                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Apellido:</h5>
                        <p class="alert alert-info"><?php echo $persona['apellido']; ?></p>
                    </div>

                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Segundo Apellido:</h5>
                        <p class="alert alert-info"><?php echo $persona['segundo_apellido']; ?></p>
                    </div>

                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Fecha de Nacimiento:</h5>
                        <p class="alert alert-info"><?php echo date('d/m/Y', strtotime($persona['f_nacimiento'])); ?></p>
                    </div>

                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Edad:</h5>
                        <p class="alert alert-info"><?php $f_nacimiento = "$persona[f_nacimiento]"; // Reemplazar con la fecha de nacimiento real
                                    $fecha_actual = date('Y-m-d');

                                    $diferencia_en_segundos = strtotime($fecha_actual) - strtotime($f_nacimiento);
                                    $segundos_en_un_año = 365.25 * 24 * 60 * 60;
                                    $edad_en_años = floor($diferencia_en_segundos / $segundos_en_un_año);

                                    echo " $edad_en_años";?></p>
                    </div>

                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Sexo:</h5>
                        <p class="alert alert-info"><?php echo $persona['sexo'] == 1 ? 'Masculino' : 'Femenino'; ?></p>
                    </div>

                </div>

                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Teléfono:</h5>
                        <p class="alert alert-info"><?php echo $persona['telefono']; ?></p>
                    </div>
                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Correo:</h5>
                        <p class="alert alert-info"><?php echo $persona['correo']; ?></p>
                    </div>

                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Dirección:</h5>
                        <p class="alert alert-info"><?php echo $persona['direccion']; ?></p>
                    </div>

                    <div class="col-sm-3">
                    <h5 class="card-subtitle">Estatus:</h5>
                    <p class="alert alert-info"><?php echo $persona['estatus'] == 1 ? 'Activo' : 'Inactivo'; ?></p>
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
    <script src="../dist/js/validarpersona.js"></script>
    <script src="../dist/js/validacionseguridad.js"></script>
</body>