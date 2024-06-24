<?php
require_once '../controlador/UsuariosController.php';
$controladorUsuario = new UsuariosController();
$usuarios = $controladorUsuario->verTodosUsuarios();
$vistas = $controladorUsuario->Vistas();
$controlar = $controladorUsuario->controlarAcceso(__FILE__);

require_once '../controlador/UnidadMedidasController.php';
$controlador = new UnidadMedidasController();
$unidadmedidas = $controlador->verTodos();
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
        <div class="container-fluid pt-4 px-4">
            <div class="bg-light rounded h-100 p-4">
                <h2>Ver Todas las forma farmacéutica</h2>
                <!-- Buscador dinámico para buscar por nombre -->
                <input class="form-control" type="text" id="buscador" onkeyup="buscarEnTabla()" placeholder="Buscar">
                
                <div class="table-responsive">
                    <?php  if($_SESSION['valor_rol'] == '1'): ?>
                    <br><a class="btn btn-outline-primary m-2" href="UnidadMedidasCrear.php"><i class="fa fa-plus"></i> Nueva forma farmacéutica</a>
                    
                    <?php endif; ?>
                    <?php if($_SESSION['valor_rol'] == '1'): ?>
                                <a  class="btn btn-outline-primary m-2" href="Reporte_UnidadMedidas.php">Imprimir lista <i class="fa-solid fa-file-pdf"></i></a>  
                    <?php endif;  ?>
                    
                
                    <table id="tabla" class="table table-bordered table-hover table-striped">
                            <tr>
                                <th>Nombre</th>
                                
                                <th width="25%">Descripción</th>
                                
                                <?php if($_SESSION['valor_rol'] == '1'): ?> 
                                    <th>Acciones</th>
                                <?php endif; ?>
                            </tr>
                            <?php foreach($unidadmedidas as $unidadmedida): ?>
                            <tr>
                                <td><?php echo $unidadmedida['nombre']; ?></td>

                                

                                <td ><?php echo $unidadmedida['descripcion'];?></td>

                                

                                <td>
                                <?php if($_SESSION['valor_rol'] == '1'):?>
                                    
                                    <a  class="btn btn-outline-warning" href="UnidadMedidasEditar.php?id=<?php echo $unidadmedida['id']; ?>"><i class="fa fa-pencil-alt"></i></a>
                                    <a class="btn btn-outline-danger" href="UnidadMedidasEliminar.php?id=<?php echo $unidadmedida['id']; ?>"><i class="fa fa-trash-alt"></i></a>
                                <?php endif; ?>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para ver a la persona -->
    <!-- Incluir el archivo PersonasVer.php en el modal -->
    <div class="modal fade" id="personaModal" tabindex="-1" aria-labelledby="personaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen" style=" width:95%; height:95%; margin-top:15px; margin-left:40px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Aquí se cargará el contenido del archivo PersonasVer.php -->
                </div>
            </div>
        </div>
    </div>

    <!-- Fin del modal -->

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
    <script>
$(document).ready(function() {
    // Ocultar filas con estatus inactivo al cargar la página
    $("table tr").each(function() {
        if ($(this).find("td:eq(4)").text().trim() === "INACTIVO") {
            $(this).hide();
        }
    });

    // Manejar clic en el botón
    $("#btnMostrarInactivos").click(function() {
        if ($(this).hasClass("btn-outline-success")) {
            // Mostrar filas inactivas
            $("table tr").each(function() {
                if ($(this).find("td:eq(4)").text().trim() === "INACTIVO") {
                    $(this).show();
                }
            });
            $(this).removeClass("btn-outline-success").addClass("btn-outline-danger").text("Ocultar inactivos");
        } else {
            // Ocultar filas inactivas
            $("table tr").each(function() {
                if ($(this).find("td:eq(4)").text().trim() === "INACTIVO") {
                    $(this).hide();
                }
            });
            $(this).removeClass("btn-outline-danger").addClass("btn-outline-success").text("Mostrar inactivos");
        }
    });
});
</script>
<script>
        $('#personaModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('rol_id');

        $.ajax({
            url: 'UnidadMedidaMenuEditar.php',
            type: 'GET',
            data: { id: id },
            success: function(data) {
            $('.modal-body').html(data);
            }
        });
        });
  </script>
</body>
</html>
