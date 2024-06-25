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
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'EnviarCorreo') {
        $citaId = $_POST['id'];
        try {
            $controlador->EnviarCorreo($citaId);
            echo "<script>
            swal({
               title: 'Completado',
               text: 'Correo enviado correctamente.',
               icon: 'success',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'CitasIndex.php'; // Redirige a tu página PHP
               }
            });
         </script>";
        } catch (Exception $e) {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al enviar el correo: " . $e->getMessage() . "'
            });
            </script>";
        }
        exit;
    }

    if (isset($_POST['action']) && $_POST['action'] == 'ConfirmarCorreo') {
        $citaId = $_POST['id'];
        $controlador->ConfirmarCorreo($citaId);
        echo "<script>
        swal({
           title: 'Completado',
           text: 'Cita confirmada correctamente.',
           icon: 'success',
        }).then((willRedirect) => {
           if (willRedirect) {
              window.location.href = 'CitasIndex.php'; // Redirige a tu página PHP
           }
        });
     </script>";
        exit;
    }

    if (isset($_POST['action']) && $_POST['action'] == 'RestaurarCita') {
        $citaId = $_POST['id'];
        $controlador->RestaurarCita($citaId);
        echo "<script>
        swal({
           title: 'Completado',
           text: 'Cita restaurada correctamente.',
           icon: 'success',
        }).then((willRedirect) => {
           if (willRedirect) {
              window.location.href = 'CitasIndex.php'; // Redirige a tu página PHP
           }
        });
     </script>";
        exit;
    }
}
?>
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
            <h2>Catalogo de Citas.</h2>
            <!-- Buscador dinámico para buscar por nombre -->
            <input class="form-control" type="text" id="buscador" onkeyup="buscarEnTabla()" placeholder="Buscar">
            
            <div class="table-responsive">
                <?php  if($_SESSION['valor_rol'] == '1'): ?>
                <br><a class="btn btn-primary" href="CitasCrear.php">Nueva cita</a>
                <?php endif; ?>
                <button id="btnMostrarInactivos" class="btn btn-outline-success m-2">Mostrar inactivos</button>
                
                <table id="tabla" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Pacientes</th>
                            <th>Consultorios</th>
                            <th>Servicios</th>
                            <th>Médicos</th>
                            <th>Fecha</th>
                            <th>Hora</th>
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
                            <td><?php echo $cita['fecha']; ?></td>
                            <td><?php echo $cita['hora']; ?></td>

                            <?php if($_SESSION['valor_rol'] == '1'): ?>
                            <td>
                            <a class="btn btn-outline-success" href="#" data-bs-toggle='modal' data-bs-target='#personaModal' data-id="<?php echo $cita['id']; ?>"> <i class="fa fa-magnifying-glass"></i></a>
                            <a class="btn btn-outline-warning" href="CitasEditar.php?id=<?php echo $cita['id']; ?>"><i class="fa fa-pencil-alt"></i></a>
                            <a class="btn btn-outline-danger" href="CitasEliminar.php?id=<?php echo $cita['id']; ?>"><i class="fa fa-trash-alt"></i></a>
                            <?php if($cita['estatus'] == '1'): ?>
                                <form action="Citasindex.php" method="post" class="btn">
                                    <input type="hidden" name="action" value="EnviarCorreo">
                                    <input type="hidden" name="id" value="<?php echo $cita['id']; ?>">
                                    <button type="submit" class="btn btn-outline-primary" id="btn-send-email"><i class="fa fa-envelope"></i></button>
                                </form>
                            <?php endif; ?>
                            <?php if($cita['estatus'] == '2'): ?>
                                <form action="Citasindex.php" method="post" class="btn">
                                    <input type="hidden" name="action" value="ConfirmarCorreo">
                                    <input type="hidden" name="id" value="<?php echo $cita['id']; ?>">
                                    <button type="submit" class="btn btn-outline-success"><i class="fa fa-check"></i></button>
                                </form>
                            <?php endif; ?>
                            <?php if($cita['estatus'] == '7'): ?>
                                <form action="Citasindex.php" method="post" class="btn">
                                    <input type="hidden" name="action" value="RestaurarCita">
                                    <input type="hidden" name="id" value="<?php echo $cita['id']; ?>">
                                    <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-arrows-rotate"></i></button>
                                </form>
                            <?php endif; ?>
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
<!--     <script>
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
    </script> -->
        <script>
        // Botón de cierre del modal
        $('.btn-close').on('click', function() {
            window.location.href = 'CitasIndex.php';
        });

        // Botón "Cerrar"
        $('.btn-secondary').on('click', function() {
            window.location.href = 'CitasIndex.php';
        });

        $('#personaModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');

            $.ajax({
                url: 'CitasVer.php',
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
