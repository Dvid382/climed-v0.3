<?php
require_once '../controlador/UsuariosController.php';
$controladorUsuario = new UsuariosController();
$usuarios = $controladorUsuario->verTodosUsuarios();
$vistas = $controladorUsuario->Vistas();
$controlar = $controladorUsuario->controlarAcceso(__FILE__);
?>

<!DOCTYPE html>
<html>
<head>
<?php include('../dist/Plantilla.php');?>
</head>
<body>
    <div class="container-fluid pt-4 px-4">

        <?php
            require_once '../controlador/CargosController.php';

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $nombre = ucfirst($_POST['nombre']);
                $descripcion = ucfirst($_POST['descripcion']);
                $fk_servicio = $_POST['fk_servicios']; // Aquí se corrige el nombre del campo
                
                

                $cargoscontroller = new CargosController();

                // Verificar si el Laboratorio ya existe
                $existecargos = $cargoscontroller->verificarCargosExistente($nombre);

                if ($existecargos) {
                    echo "<script> alert ('Error: El Laboratorio ya existe.')</script>";
                } else {
                    $resultado = $cargoscontroller->crear($nombre, $descripcion, $fk_servicio);

                    if ($resultado) {
                        echo "<script> alert '(Error: Estado creado exitosamente.)'</script>";
                        header("Location: CargosIndex.php"); 
                    } else {
                        echo "Error al crear el Laboratorio.";
                    }
                }
            }
            
        ?>

<div class="bg-white rounded h-25 p-4" style="width: 50%; margin:auto;">

            <center><h1>Crear Cargo</h1></center>

            <form method="POST" autocomplete="off">
    <div class="form-floating mb-3">
        <input class="form-control" type="text" name="nombre" id="nombre" required>
        <label for="nombre">Nombre:</label>
    </div>

    <div class="form-floating mb-3">
        <textarea class="form-control" placeholder="Descripcion" id="descripcion" name="descripcion" style="height: 150px;" required></textarea>
        <label for="descripcion">Descripción:</label>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" id="fk_servicios" aria-label="Default select example" name="fk_servicios" required>
            <option value="">Seleccione un Servicio</option>
            <?php
                require_once '../controlador/ServiciosController.php';
                $ServiciosController = new ServiciosController();
                $servicios = $ServiciosController->verTodos();

                foreach ($servicios as $servicio) {
                    echo "<option value='" . $servicio['id'] . "'>" . $servicio['nombre'] . "</option>";
                }
            ?>
        </select>
    </div>


    <div class="form-floating mb-3">
        <button class="btn btn-outline-success" type="submit">Guardar Cargo. <i class="fa fa-check"></i></button>
        <a class="btn btn-outline-info" href="CargosIndex.php">Volver <i class="fa fa-right-to-bracket"></i></a>
    </div>
</form>
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
        <script src="../dist/js/validaciongenerica.js"></script>
    <script src="../dist/js/validacionseguridad.js"></script>
</body>
</html>
