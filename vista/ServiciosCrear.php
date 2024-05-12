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
        require_once '../controlador/ServiciosController.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = ucfirst($_POST['nombre']);
            $estatus = ucfirst($_POST['estatus']);
            $valor = ucfirst($_POST['valor']);
            $descripcion = ucfirst($_POST['descripcion']);
            
            

            $servicioscontroller = new ServiciosController();

            // Verificar si el Servicio ya existe
            $existeservicios = $servicioscontroller->verificarServiciosExistente($nombre);

            if ($existeservicios) {
                echo "<script> alert ('Error: El Servicio ya existe.')</script>";
            } else {
                $resultado = $servicioscontroller->crear($nombre, $estatus, $valor, $descripcion);

                if ($resultado) {
                    echo "<script> alert '(Error: Estado creado exitosamente.)'</script>";
                     header("Location: ServiciosIndex.php"); 
                } else {
                    echo "Error al crear el Servicio.";
                }
            }
        }
        
     ?>
    
    <div class="bg-white rounded h-25 p-4" style="width: 50%; margin:auto;">
    <center><h1>Crear Servicio</h1></center>
        <form method="POST">

            <div class="form-floating mb-3">
                <input class="form-control" type="text" name="nombre" id="nombre" required>
                <label for="floatingTextarea">Nombre:</label>
            </div>
            
            <div class="form-floating mb-3">
                <select class="form-select" aria-label="Default select example" name="estatus" id="estatus">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
                </select>
                <label for="floatingTextarea">Estatus:</label>
            </div>

            <div class="form-floating mb-3">
                    <select class="form-select" aria-label="Default select example" name="valor" id="valor">
                    <option value="1">Administrativos</option>
                    <option value="2">Mantenimiento</option>
                    <option value="3">Medicina General</option>
                    <option value="4">Medicina Especialista</option>
                    <option value="5">Asistencial</option>
                </select>
                <label for="floatingTextarea">Valor:</label>
            </div>

            <div class="form-floating mb-3">
            <textarea class="form-control" placeholder="Descripcion"
                id="floatingTextarea" name="descripcion" style="height: 150px;" required></textarea>
            <label for="floatingTextarea">Descripcion</label>
            </div>

            <div class="form-floating mb-3">
                <button class="btn btn-outline-success" type="submit">Crear servicio. <i class="fa fa-check"></i></button>
                <a class="btn btn-outline-info" href="ServiciosIndex.php">Volver <i class="fa fa-right-to-bracket"></i></a>
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
