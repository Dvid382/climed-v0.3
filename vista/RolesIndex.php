<?php
require_once '../controlador/UsuariosController.php';
$controladorUsuario = new UsuariosController();
$usuarios = $controladorUsuario->verTodosUsuarios();
$vistas = $controladorUsuario->Vistas();

require_once '../controlador/RolesController.php';
$controlador = new RolesController();
$roles = $controlador->verTodos();
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
        <div class="container-fluid pt-4 px-4">
            <div class="bg-light rounded h-100 p-4">
                <h2>Ver Todos los Roles</h2>
                <!-- Buscador dinámico para buscar por nombre -->
                <input class="form-control" type="text" id="buscador" onkeyup="buscarEnTabla()" placeholder="Buscar">
                
                <div class="table-responsive">
                    <?php  if($_SESSION['valor_rol'] == '1'): ?>
                    <br><a class="btn btn-primary" href="RolesCrear.php">Nuevo Rol</a>
                    <?php endif; ?>

                
                    <table id="tabla" class="table">
                            <tr>
                                <th>Nombre</th>
                                <th>Estatus</th>
                                <th>Valor</th>
                                <th>Descripcion</th>
                                <?php if($_SESSION['valor_rol'] == '1'): ?> 
                                    <th>Acciones</th>
                                <?php endif; ?>
                            </tr>
                            <?php foreach($roles as $rol): ?>
                            <tr>
                                <td><?php echo $rol['nombre']; ?></td>
                                
                                <td><?php if ($rol['estatus']== 1)
                                {
                                    echo 'activo';
                                } else {
                                    echo "inactivo";
                                }


                                ?></td>
                                <td><?php echo $rol['valor'];?></td>
                                <td><?php echo $rol['descripcion'];?></td>
                                <td>
                                <?php if($_SESSION['valor_rol'] == '1'):?>
                                    <a  class="btn btn-outline-warning" href="RolesEditar.php?id=<?php echo $rol['id']; ?>"><i class="fa fa-pencil-alt"></i></a>
                                    <a class="btn btn-outline-danger" href="RolesEliminar.php?id=<?php echo $rol['id']; ?>"><i class="fa fa-trash-alt"></i></a>
                                <?php endif; ?>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
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
