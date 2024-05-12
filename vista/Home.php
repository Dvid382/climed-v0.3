<?php
require_once '../controlador/UsuariosController.php';
$controladorUsuario = new UsuariosController();
$usuarios = $controladorUsuario->verTodosUsuarios();

if (!isset($_SESSION['rol'])) {
    echo "<script>alert('Usted debe iniciar sesión para acceder a esta página.'); window.location.href = '../Index.php';</script>";
    exit;
}

require_once '../controlador/RolesController.php';
$controlador = new RolesController();
$roles = $controlador->verTodos();

$vistas = $controladorUsuario->Vistas();
$controlar = $controladorUsuario->controlarAcceso(__FILE__);
?>


<!DOCTYPE html>
<html lang="es">
<head>

</head>
<body>
    <?php
        include('menus/menu.php');
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
    <div class="container-fluid pt-4 px-4">
        <center >
            <?php
                $_SESSION['valor_rol'];
                echo "<h1>Bienvenido, " . $_SESSION['nombre'] . " " . $_SESSION['apellido'] ."</h1>";
                echo "<h2>Rol: " . $_SESSION['rol'] . "</h2>";
            ?>
        </center>
        <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-2 px-2">
                <div class="row g-5">
                    <div class="col-sm-6 col-md-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-user fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-1">Pacientes.</p>
                                <h6 class="mb-0">5</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-clipboard-list fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Citas.</p>
                                <h6 class="mb-0">3</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-warning fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Alertas epidemiologicas.</p>
                                <h6 class="mb-0">0</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-clipboard-check fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Asignaciones.</p>
                                <h6 class="mb-0">10</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->
            <!-- Chart Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Single Line Chart</h6>
                            <canvas id="line-chart"></canvas>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Multiple Line Chart</h6>
                            <canvas id="salse-revenue"></canvas>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Single Bar Chart</h6>
                            <canvas id="bar-chart"></canvas>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Multiple Bar Chart</h6>
                            <canvas id="worldwide-sales"></canvas>
                        </div>
                    </div>
<!--                     <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Pie Chart</h6>
                            <canvas id="pie-chart"></canvas>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Doughnut Chart</h6>
                            <canvas id="doughnut-chart"></canvas>
                        </div>
                    </div> -->
                </div>
            </div>
            <!-- Chart End -->
    </div>
</div>

</body>
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
    <script src="dist/plantilla/lib/chart/chart.min.js"></script>
    <script src="dist/plantilla/js/main.js"></script>
    <script src="dist/js/validacionseguridad.js"></script>
</html>