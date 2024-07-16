<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <title>Iniciar Sesión</title>
     <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="dist/fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="stylesheet" href="dist/plantilla/lib/bootstrap-icons.css">

    <!-- Libraries Stylesheet -->
    <script src="dist/js/jquery-3.7.1.min.js"></script>
    <script src="dist/sweetalert2/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="dist/sweetalert2/sweetalert2.min.css">
    <script src="dist/js/sweetalert.min.js"></script>
    <link href="dist/plantilla/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="dist/plantilla/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="dist/plantilla/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="dist/plantilla/css/style.css" rel="stylesheet">
</head>
<body>
<div class="container-xxl position-relative bg-white d-flex p-0">
    <!-- Spinner Start -->
   <!--  <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Cargando...</span>
        </div>
    </div> -->
    <!-- Spinner End -->

    <!-- Sign In Start -->
    <div class="container-fluid">
        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                    <img src="dist/climed.jpg" width="25%" height="25%" style="border-radius: 70%;">
                        <h3>Iniciar sesion.</h3>
                    </div>
                    <form action="controlador/validar_sesion.php" method="POST">
                        <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInput" name="cedula"  placeholder="Cedula" autocomplete="off">
                            <label for="floatingInput">Cedula de identidad.</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="floatingPassword" name="clave"  placeholder="Contraseña" autocomplete="off">
                            <label for="floatingPassword">Contraseña</label>
                        </div>
                        <input type="submit" value="Iniciar Sesión" class="btn btn-primary py-3 w-100 mb-4">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Sign In End -->
</div>
    <script>
        $(document).ready(function() {
            // Validar que el campo cedula solo contenga números y esté entre 1,000,000 y 50,000,000
            $('#cedula').keypress(function(e) {
                var keyCode = e.which;
                if ((keyCode < 48 || keyCode > 57)) {
                    e.preventDefault();
                    alert('El campo cedula solo permite números');
                }
            }).change(function() {
                if (this.value < 1000000 || this.value > 50000000) {
                    alert('La cedula debe estar entre 1,000,000 y 50,000,000');
                }
            }).focus(function() {
                $(this).after('<div id="cedulaHelp" class="text-info">Campo requerido. Solo se permiten números. La cedula debe estar entre 1,000,000 y 50,000,000.</div>');
            }).blur(function() {
                $('#cedulaHelp').remove();
            });

            // Validar que todos los campos estén llenos antes de enviar el formulario
            $('form').submit(function(e) {
                $('input').each(function() {
                    if ($.trim(this.value).length == 0) {
                        e.preventDefault();
                        alert('Todos los campos son requeridos');
                    }
                });
            });
        });
    </script>

    <?php
    if (isset($_SESSION['swal_message'])) {
        echo "<script>".$_SESSION['swal_message']."</script>";
        unset($_SESSION['swal_message']);
    }
    ?>

    <!-- libreries JS -->
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
