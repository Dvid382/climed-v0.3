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
                    require_once('../controlador/UsuariosController.php');

                    // Crear una instancia de rolcontroller
                    $usuariosController = new UsuariosController();

                    // Verificar si se recibió el ID del Rol a editar
                    if (isset($_GET['id'])) {
                        $usuarioId = $_GET['id'];

                        // Obtener los datos del Rol con el ID proporcionado
                        $usuario = $usuariosController->verUsuarioPorId($usuarioId);
                        $personasUsuario = $controladorUsuario->buscarDatosPersonas($usuario['fk_persona']);
                        $rolUsuario = $controladorUsuario->buscarNombreRol($usuario['fk_rol']);
                        $serviciosUsuario = $controladorUsuario->buscarServiciosPersonas($usuario['fk_persona']);

                    }

                ?>

<div class="card bg-light shadow-sm align-items-center" style="width: 80%; margin: auto; margin-top: -30px;">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <center><h2 class="card-title text-primary">Datos de: <?php echo $personasUsuario['nombre_persona']. " ". $personasUsuario['apellido_persona']; ?></h2></center>
                
                <div class="row mb-3">
                    <div class="col-md-2">
                        <img src="<?php echo $usuario['foto']; ?>" alt="Foto de perfil" class="img-fluid rounded-circle mb-3" width="90px">
                    </div>
                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Cédula:</h5>
                        <p class="alert alert-info"><?php echo $personasUsuario['cedula_persona']; ?></p>
                    </div>

                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Nombre:</h5>
                        <p class="alert alert-info"><?php echo $personasUsuario['nombre_persona']; ?></p>
                    </div>

                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Apellido:</h5>
                        <p class="alert alert-info"><?php echo $personasUsuario['apellido_persona']; ?></p>
                    </div>

                    <div class="col-sm-4">
                        <h5 class="card-subtitle">Rol:</h5>
                        <p class="alert alert-info"><?php echo $rolUsuario['nombre_rol'];?></p>
                    </div>

                    <div class="col-sm-4">
                        <h5 class="card-subtitle">Correo:</h5>
                        <p class="alert alert-info"><?php echo $personasUsuario['correo_persona']; ?></p>
                    </div>

                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Servicio:</h5>
                        <p class="alert alert-info"><?php echo $serviciosUsuario['nombre_servicio']; ?></p>
                    </div>

                </div>

                <div class="row mb-3">

                    <div class="col-sm-3">
                        <h5 class="card-subtitle">Estatus:</h5>
                        <p class="alert alert-info"><?php echo $usuario['estatus'] == 1 ? 'Activo' : 'Inactivo'; ?></p>
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