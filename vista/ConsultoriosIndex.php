<?php
require_once '../controlador/UsuariosController.php';
$controladorUsuario = new UsuariosController();
$usuarios = $controladorUsuario->verTodosUsuarios();
$vistas = $controladorUsuario->Vistas();
$controlar = $controladorUsuario->controlarAcceso(__FILE__);
$controlar = $controladorUsuario->controlarAcceso(__FILE__);

require_once '../controlador/ConsultoriosController.php';
$controlador = new ConsultoriosController();
$consultorios = $controlador->verTodos();
?>


<!DOCTYPE html>
<html>
<head>
<?php include('../dist/Plantilla.php');?>
    
</head>
<body>
<?php include('menus/menu.php');?>
<div class="content open">
        <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown" style="margin-left: 10%;">
                         <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                                  <img src="<?php echo $_SESSION['foto']?>" alt="" width="35px"  class="rounded-circle me-lg-2">
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
            <h2>Catalogo de Consultorios.</h2>
            <!-- Buscador dinámico para buscar por nombre -->
            <input class="form-control" type="text" id="buscador" onkeyup="buscarEnTabla()" placeholder="Buscar">
            
            <div class="table-responsive">
                <?php  if($_SESSION['valor_rol'] == '1'): ?>
                <br><a class="btn btn-primary" href="ConsultoriosCrear.php">Nueva Consultorio</a>
                <?php endif; ?>
                <?php if($_SESSION['valor_rol'] == '1'): ?>
                                <a  class="btn btn-outline-primary m-2" href="Reporte_Consultorios.php">Imprimir lista <i class="fa-solid fa-file-pdf"></i></a>
                                
                            <?php endif;  ?>
                <?php  if($_SESSION['valor_rol'] == '1'): ?>
                <a class="btn btn-success" href="Mantenimiento.php">Cronograma</a>
                <?php endif; ?>
                <?php  if($_SESSION['valor_rol'] == '1'): ?>
                <a class="btn btn-info" href="ConsultoriosIndentificadores.php">Indentificadores</a>
                <?php endif; ?>
                <button id="btnMostrarInactivos" class="btn btn-outline-success m-2">Mostrar inactivos</button>

                
                <table id="tabla" class="table table-bordered table-hover table-striped">
                        <tr>
                            <th>Nombre</th>
                            <th>Estatus</th>
                           
                            <th>Descripcion</th>
                            <th>Acciones</th>
                        </tr>
                        <?php foreach($consultorios as $consultorio): ?>
                        <tr>
                            <td><?php echo $consultorio['nombre']; ?></td>
                            
                            <td><?php echo ($consultorio['estatus'] == 1) ? 'ACTIVO' : 'INACTIVO'; ?></td>
                            
                            <td><?php echo $consultorio['descripcion'];?></td>
                            <td>
                            <?php if($_SESSION['valor_rol'] == '1'): ?>
                                <a  class="btn btn-outline-warning m-2" href="ConsultoriosEditar.php?id=<?php echo $consultorio['id']; ?>"><i class="fa fa-pencil-alt"></i></a>
                                <a class="btn btn-outline-danger m-2" href="ConsultoriosEliminar.php?id=<?php echo $consultorio['id']; ?>"><i class="fa fa-trash-alt"></i></a>
                            <?php endif;  ?>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
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
    <script src="../dist/js/paginacion.js"></script>
    <script src="../dist/plantilla/js/main.js"></script>
    <script src="../dist/js/buscar.js"></script>
    <script src="../dist/js/validacionseguridad.js"></script>
    <script>
        $(document).ready(function() {
            // Ocultar filas con estatus inactivo al cargar la página
            $("table tr").each(function() {
                if ($(this).find("td:eq(1)").text().trim() === "INACTIVO") {
                    $(this).hide();
                }
            });

            // Manejar clic en el botón
            $("#btnMostrarInactivos").click(function() {
                if ($(this).hasClass("btn btn-outline-success m-2")) {
                    // Mostrar filas inactivas
                    $("table tr").each(function() {
                        if ($(this).find("td:eq(1)").text().trim() === "INACTIVO") {
                            $(this).show();
                        }
                    });
                    $(this).removeClass("btn btn-outline-success m-2").addClass("btn btn-outline-danger m-2").text("Ocultar inactivos");
                } else {
                    // Ocultar filas inactivas
                    $("table tr").each(function() {
                        if ($(this).find("td:eq(1)").text().trim() === "INACTIVO") {
                            $(this).hide();
                        }
                    });
                    $(this).removeClass("btn btn-outline-danger m-2").addClass("btn btn-outline-success m-2").text("Mostrar inactivos");
                }
            });
        });
    </script>
</body>
</html>
