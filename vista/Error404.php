<!DOCTYPE html>
<html lang="en">
<?php session_start();?>
<head>
<?php include('dist/Plantilla.php');?>
</head>

<body>
    <?php
        include('dist/Menu.php');
    ?>
    <div class="container-xxl position-relative bg-white d-flex p-0">


        <!-- Content Start -->
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

            <!-- 404 Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0">
                    <div class="col-md-6 text-center p-4">
                    <img
                        src="dist/plantilla/img/illustrations/page-misc-error-light.png"
                        alt="page-misc-error-light"
                        width="500"
                        class="img-fluid"
                        data-app-dark-img="illustrations/girl-doing-yoga-dark.png"
                        data-app-light-img="illustrations/girl-doing-yoga-light.png"
                    />
                        <h1 class="display-1 fw-bold">404</h1>
                        <h1 class="mb-4">Pagina no funciona</h1>
                        <p class="mb-4">¡Lo sentimos, la página que ha buscado no esta activa en nuestro sitio web!
                            ¿Quieres ir a nuestra página de inicio?</p>
                        <a class="btn btn-primary rounded-pill py-3 px-5" href="Inicio.php">Volver al inicio.</a>
                    </div>
                </div>
            </div>
            <!-- 404 End -->
        </div>
        <!-- Content End -->


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
    <script src="dist/js/validacionseguridad.js"></script>
</body>

</html>