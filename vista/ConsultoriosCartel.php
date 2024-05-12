<?php
require_once '../controlador/UsuariosController.php';
$controladorUsuario = new UsuariosController();
$usuarios = $controladorUsuario->verTodosUsuarios();
$vistas = $controladorUsuario->Vistas();
$controlar = $controladorUsuario->controlarAcceso(__FILE__);
// Incluir TCPDF
require_once('TCPDF/tcpdf.php');

// Verificar si se presionó el botón de imprimir PDF
if (isset($_POST['imprimir_pdf'])) {
    // Crear instancia de TCPDF en orientación horizontal
    $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->AddPage();
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Mi Aplicación');
    $pdf->SetTitle('Consultorio');
    $pdf->SetHeaderData('', 0, '', '');
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    $pdf->SetMargins(0, 0, 0);
    $pdf->SetHeaderMargin(0);
    $pdf->SetFooterMargin(0);
    $pdf->SetAutoPageBreak(TRUE, 0);
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // Establecer el fondo de pantalla en orientación horizontal
    $pdf->Image('dist/marco.jpg', 0, 0, 297, 210, '', '', '', false, 600, '', false, false, 0);

    // Capturar el HTML de la vista con los estilos
    ob_start();
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <style>
            .container {
                width: 70%;
            }
            h3 {
                text-align: center;
            }
            h1 {
                text-align: center;
            }
        </style>
    </head>
    <body>
    <?php
        require_once('../controlador/ConsultoriosController.php');
        $consultorioscontroller = new ConsultoriosController();

        if (isset($_GET['id'])) {
            $consultorioId = $_GET['id'];
            $consultorio = $consultorioscontroller->verPorId($consultorioId);
        }
        ?>
        <div class="container"  >
    <center>
        <h3>REPÚBLICA BOLIVARIANA DE VENEZUELA</h3>
        <h3>INSTITUTO AUTONOMO DE LA SALUD DEL ESTADO YARACUY</h3>
        <h3>ALCALDIA DEL MUNICIPIO INDEPENDENCIA</h3>
        <h3>CONSULTORIO MEDICO POPULAR "HUMBERTO SILVA"</h3>
    </center>
    <br><br><br><br><br><br><br><br><br>
        <div class="container-fluid" >
            <center>
                <h1 style="font-size: 300%;"><?php echo $consultorio['nombre']; ?></h1>
            </center>
        </div>
</div>
    </body>
    </html>

    <?php
    $html = ob_get_clean();

    // Escribir el HTML en el PDF
    $pdf->writeHTML($html);

    // Descargar el PDF
    $pdf->Output('consultorio.pdf', 'D');
    exit; // Salir del script después de generar el PDF
}
?>

<!DOCTYPE html>
<html>
<head>
    <?php include('dist/Plantilla.php'); ?>

    <style>
        body {
            background-image: url('dist/marco.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    </style>
</head>
<body>
    <div class="container" style="width: 50%;">
        <?php
        require_once('../controlador/ConsultoriosController.php');
        $consultorioscontroller = new ConsultoriosController();

        if (isset($_GET['id'])) {
            $consultorioId = $_GET['id'];
            $consultorio = $consultorioscontroller->verPorId($consultorioId);
        }
        ?>

        <center>
            <h3>REPÚBLICA BOLIVARIANA DE VENEZUELA</h3>
            <h3>INSTITUTO AUTONOMO DE LA SALUD DEL ESTADO YARACUY</h3>
            <h3>ALCALDIA DEL MUNICIPIO INDEPENDENCIA</h3>
            <h3>CONSULTORIO MEDICO POPULAR "HUMBERTO SILVA"</h3>
        </center>
        <br><br><br>
        <center>
            <form method="POST">
                <div class="form-floating mb-3">
                    <h1><?php echo $consultorio['nombre']; ?></h1>
                </div>

                <div class="form-floating mb-3">
                    <br><br><br><br><br><br><br>
                    <button class="btn btn-outline-primary" type="submit" name="imprimir_pdf">Imprimir PDF <i class="fa fa-file-pdf"></i></button>
                    <a class="btn btn-outline-info" href="ConsultoriosIndex.php">Volver <i class="fa fa-right-to-bracket"></i></a>
                </div>
            </form>
        </center>
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
    <script src="dist/js/LimpiarInput.js"></script>
    <script src="dist/plantilla/js/main.js"></script>
    <script src="dist/js/buscar.js"></script>
    <script src="dist/js/validaciongenerica.js"></script>
    <script src="dist/js/validacionseguridad.js"></script>
</body>
</html>
