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
            <h2>Catalogo de Citas de enfermeria.</h2>
            <!-- Buscador dinámico para buscar por nombre -->
            <input class="form-control" type="text" id="buscador" onkeyup="buscarEnTabla()" placeholder="Buscar">
            
            <div class="table-responsive">
                <button id="btnMostrarInactivos" class="btn btn-outline-success m-2">Mostrar inactivos</button>
                
                <table id="tabla" class="table table-bordered table-hover table-striped">
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
                        
                        // Verificar el valor del rol del usuario que inició sesión
                        if ($_SESSION['valor_rol'] == '1' || $_SESSION['valor_rol'] == '2') {
                            $citas = $citasController->indexTodas();
                        } elseif ($_SESSION['valor_rol'] == '4') {
                            $citas = $citasController->index();
                        } elseif ($_SESSION['valor_rol'] == '5') {
                            $citas = $citasController->indexEnfermeria();
                        }
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
                            <td>
                                <?php
                                    switch ($cita['estatus']) {
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
                                ?>
                            </td>
                            <?php if($_SESSION['valor_rol'] == '5' || $_SESSION['valor_rol'] == '1'): ?>
                            <td>
                            <a class="btn btn-outline-success" href="#" data-bs-toggle='modal' data-bs-target='#personaModal' data-id="<?php echo $cita['id']; ?>"> <i class="fa fa-magnifying-glass"></i></a>
                                <a class="btn btn-outline-warning m-2" href="CitasEnfermeriaCrear.php?id=<?php echo $cita['id']; ?>"><i class="fa fa-pencil-alt"></i></a>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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
    <script src="../dist/js/paginacion.js"></script>
    <script src="../dist/plantilla/js/main.js"></script>
    <script src="../dist/js/buscar.js"></script>
    <script src="../dist/js/validacionseguridad.js"></script>
    <script>
        $(document).ready(function() {
            // Ocultar filas con estatus inactivo al cargar la página
            $("table tr").each(function() {
                if ($(this).find("td:eq(7)").text().trim() === "INACTIVO") {
                    $(this).hide();
                }
            });

            // Manejar clic en el botón
            $("#btnMostrarInactivos").click(function() {
                if ($(this).hasClass("btn btn-outline-success m-2")) {
                    // Mostrar filas inactivas
                    $("table tr").each(function() {
                        if ($(this).find("td:eq(7)").text().trim() === "INACTIVO") {
                            $(this).show();
                        }
                    });
                    $(this).removeClass("btn btn-outline-success m-2").addClass("btn btn-outline-danger m-2").text("Ocultar inactivos");
                } else {
                    // Ocultar filas inactivas
                    $("table tr").each(function() {
                        if ($(this).find("td:eq(7)").text().trim() === "INACTIVO") {
                            $(this).hide();
                        }
                    });
                    $(this).removeClass("btn btn-outline-danger m-2").addClass("btn btn-outline-success m-2").text("Mostrar inactivos");
                }
            });
        });
    </script>
    <script>
        // Botón de cierre del modal
        $('.btn-close').on('click', function() {
            window.location.href = 'CitasEnfermeriaIndex.php';
        });

        // Botón "Cerrar"
        $('.btn-secondary').on('click', function() {
            window.location.href = 'CitasEnfermeriaIndex.php';
        });

        $('#personaModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');

            $.ajax({
                url: 'CitasEnfermeriaVer.php',
                type: 'GET',
                data: { id: id },
                success: function(data) {
                    $('.modal-body').empty().html(data);
                }
            });
        });
    </script>
</body>
</html>
