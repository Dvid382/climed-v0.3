<?php
require_once '../controlador/UsuariosController.php';
$controladorUsuario = new UsuariosController();
$usuarios = $controladorUsuario->verTodosUsuarios();
$vistas = $controladorUsuario->Vistas();
$controlar = $controladorUsuario->controlarAcceso(__FILE__);
$controlar = $controladorUsuario->controlarAcceso(__FILE__);

require_once '../controlador/CitasController.php';
$controlador = new CitasController();
$citas = $controlador->verTodas();
?>


<!DOCTYPE html>
<html>
<head>
<?php include('dist/Plantilla.php');?>
    
</head>
<body>
<?php include('dist/Menu.php');?>
<div class="content open">
        <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown" style="margin-left: 10%;">
                         <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                         <img src="<?php echo $_SESSION['foto']?>" alt="" width="20px"  class="rounded-circle me-lg-2">
                            <span class="d-none d-lg-inline-flex"><?php echo   $_SESSION['nombre'] . " " . $_SESSION['apellido']  ; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="../controlador/cerrar_sesion.php" class="dropdown-item">Cerrar sesión</a>
                        </div>
                    </div>
                </div>
            </nav>
        <!-- Navbar End -->

        <!-- Catalogo Asignaciones -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded h-100 p-4">
            <h2>Catalogo de Citas.</h2>
            <!-- Buscador dinámico para buscar por nombre -->
            <input class="form-control" type="text" id="buscador" onkeyup="buscarEnTabla()" placeholder="Buscar">
            
            <div class="table-responsive">
                <?php  if($_SESSION['valor_rol'] == '1'): ?>
                <br><a class="btn btn-primary" href="CitasCrear.php">Nueva cita</a>
                <?php endif; ?>

                
                <table id="tabla" class="table">
                    <thead>
                        <tr>
                            <th>Pacientes</th>
                            <th>Consultorios</th>
                            <th>Servicios</th>
                            <th>Médicos</th>
                            <th>Usuario Creación</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Estatus</th>
                            <?php if($_SESSION['valor_rol'] == '1'): ?>
                                <th>Acciones</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once '../controlador/CitasController.php';
                        $citasController = new CitasController();
                        $citas = $citasController->index();
                        foreach ($citas as $cita):
                        ?>
                        <tr>
                            <td><?php echo $cita['nombre_paciente'] . ' ' . $cita['apellido_paciente']; ?></td>
                            <td><?php echo $cita['nombre_consultorio']; ?></td>
                            <td><?php echo $cita['nombre_servicio']; ?></td>
                            <td><?php echo $cita['nombre_medico'] . ' ' . $cita['apellido_medico']; ?></td>
                            <td><?php echo $cita['nombre_usuario'] . ' ' . $cita['apellido_usuario']; ?></td>
                            <td><?php echo $cita['fecha']; ?></td>
                            <td><?php echo $cita['hora']; ?></td>
                            <td><?php echo ($cita['estatus'] == 1) ? 'Activo' : 'Inactivo'; ?></td>
                            <?php if($_SESSION['valor_rol'] == '1'): ?>
                            <td>
                                <a class="btn btn-outline-warning m-2" href="CitasEditar.php?id=<?php echo $cita['id']; ?>"><i class="fa fa-pencil-alt"></i></a>
                                <a class="btn btn-outline-danger m-2" href="CitasEliminar.php?id=<?php echo $cita['id']; ?>"><i class="fa fa-trash-alt"></i></a>
                            </td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
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
    <script src="dist/plantilla/js/main.js"></script>
    <script src="dist/js/buscar.js"></script>
    <script src="dist/js/validacionseguridad.js"></script>
</body>
</html>
