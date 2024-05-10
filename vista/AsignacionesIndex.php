<?php
require_once '../controlador/UsuariosController.php';
$controladorUsuario = new UsuariosController();
$usuarios = $controladorUsuario->verTodosUsuarios();
$vistas = $controladorUsuario->Vistas();


require_once '../controlador/AsignacionesController.php';
$controlador = new AsignacionesController();
$asignaciones = $controlador->verTodos();
$controladorAsignaciones = new AsignacionesController();

require_once '../controlador/ServiciosController.php';
$controladorServicios = new ServiciosController();

?>


<!DOCTYPE html>
<html>
<head>
<?php include('dist/Plantilla.php');?>
</head>
<body>
    <?php include('dist/Menu.php');?>
    <div class="content">
        <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <!-- <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">John Doe</span>
                        </a> -->
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
        <!-- Navbar End -->

        <!-- Catalogo Asignaciones -->
        <div class="container-fluid pt-4 px-4">
            <div class="bg-light rounded h-100 p-4">
                
                <h2>Catalogo de Asignaciones</h2>
                    <!-- Buscador dinámico para buscar por nombre -->
                    <input class="form-control" type="text" id="buscador" onkeyup="buscarEnTabla()" placeholder="Buscar"><br>

                    <div class="table-responsive">
                        <?php  if($_SESSION['valor_rol'] == '1'): ?>
                        <a class="btn btn-primary" href="AsignacionesCrear.php">Nueva Asignación</a>
                        <?php endif; ?>
                    <table id="tabla" class="table">
                        <thead>
                            <tr>
                            <th>Nombre</th>
                            <th>Estatus</th>
                            <th>Descripcion</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Servicio</th>
                            <th>Usuario</th>
                            <?php if($_SESSION['valor_rol'] == '1'): ?> 
                                <th>Acciones</th>
                            <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($asignaciones as $Asignacion): ?>
                        <tr>
                            <td id="nombre"><?php echo $Asignacion['nombre']; ?></td>
                            
                            <td><?php if ($Asignacion['estatus']== 1)
                            {
                                echo 'Asignado';
                            } else {
                                if ($Asignacion['estatus']== 2)
                            {
                                echo 'En proceso';
                            }else{
                                if ($Asignacion['estatus']== 3)
                            {
                                echo 'Finalizado';
                            } else{
                                if ($Asignacion['estatus']== 4)
                            {
                                echo 'Cancelada';
                            }
                            }
                            }
                            }


                            ?></td>
                            <td><?php echo $Asignacion['descripcion'];?></td>
                            <td><?php echo $Asignacion['f_inicio'];?></td>
                            <td><?php echo $Asignacion['f_fin'];?></td>

                            <td>
                                <?php
                                    $nombreservicio = $controladorAsignaciones->obtenerNombreServicioAsignacion($Asignacion['fk_usuario']);
                                    echo $nombreservicio['nombre_servicio'];
                                    
                                ?>
                            </td>
                            <td>
                                <?php
                                    $nombreApellidoPersona = $controladorAsignaciones->obtenerNombreApellidoPersonaAsignacion($Asignacion['fk_usuario']);
                                    echo $nombreApellidoPersona['nombre'] . " " . $nombreApellidoPersona['apellido'];
                                ?>
                            </td>
                            <td>
                            <?php if($_SESSION['valor_rol'] == '1'): ?>
                                <a  class="btn btn-outline-warning m-2" href="AsignacionesEditar.php?id=<?php echo $Asignacion['id']; ?>"><i class="fa fa-pencil-alt"></i></a>
                                <a class="btn btn-outline-danger m-2" href="AsignacionesEliminar.php?id=<?php echo $Asignacion['id']; ?>"><i class="fa fa-trash-alt"></i></a>
                            <?php endif;  ?>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Catalogo Asignaciones Fin-->
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
