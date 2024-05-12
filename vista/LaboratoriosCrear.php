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
<?php include('dist/Plantilla.php');?>
</head>
<body>
    <div class="container-fluid pt-4 px-4">

        <?php
            require_once '../controlador/LaboratoriosController.php';

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $nombre = ucfirst($_POST['nombre']);
                $estatus = ucfirst($_POST['estatus']);
                $valor = ucfirst($_POST['valor']);
                $descripcion = ucfirst($_POST['descripcion']);
                
                

                $laboratorioscontroller = new LaboratoriosController();

                // Verificar si el Laboratorio ya existe
                $existelaboratorios = $laboratorioscontroller->verificarLaboratoriosExistente($nombre);

                if ($existelaboratorios) {
                    echo "<script> alert ('Error: El Laboratorio ya existe.')</script>";
                } else {
                    $resultado = $laboratorioscontroller->crear($nombre, $estatus, $valor, $descripcion);

                    if ($resultado) {
                        echo "<script> alert '(Error: Estado creado exitosamente.)'</script>";
                        header("Location: LaboratoriosIndex.php"); 
                    } else {
                        echo "Error al crear el Laboratorio.";
                    }
                }
            }
            
        ?>

<div class="bg-white rounded h-25 p-4" style="width: 50%; margin:auto;">

            <center><h1>Crear Laboratorio</h1></center>

            <form method="POST">


            <div class="form-floating mb-3">
                <input class="form-control" type="text" name="nombre" id="nombre" required>
                <label  for="nombre">Nombre:</label>
            </div>

            <div class="form-floating mb-3">
                <select class="form-select" aria-label="Default select example" name="estatus" id="estatus">
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
                <label  for="estatus">Estatus:</label>
            </div>

            <div class="form-floating mb-3">
                <select class="form-select" aria-label="Default select example" name="valor" id="valor">
                    <option value="1">Análisis de sangre</option>
                    <option value="2">Análisis de orina</option>
                    <option value="3">Análisis de heces</option>
                    <option value="4">Examen de microbiología</option>
                    <option value="5">Pruebas de diagnóstico molecular</option>
                </select>
                <label  for="valor">Valor:</label>
            </div>

            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Descripcion"
                id="floatingTextarea" name="descripcion" style="height: 150px;" required></textarea>
                <label  for="nombre">Descripción:</label>
            </div>

            <div class="form-floating mb-3">
                <button class="btn btn-outline-success" type="submit">Guardar laboratorio. <i class="fa fa-check"></i></button>
                <a class="btn btn-outline-info" href="LaboratoriosIndex.php">Volver <i class="fa fa-right-to-bracket"></i></a>
            </div>

            </form>
            
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
        <script src="dist/js/validaciongenerica.js"></script>
    <script src="dist/js/validacionseguridad.js"></script>
</body>
</html>
