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
        require_once '../controlador/AsignacionesController.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = ucfirst($_POST['nombre']);
            $estatus = ucfirst($_POST['estatus']);
            $descripcion = ucfirst($_POST['descripcion']);
            $f_inicio = $_POST['f_inicio'];
            $f_fin = $_POST['f_fin'];
            $fk_servicios = $_POST['fk_servicios']; // Aquí se corrige el nombre del campo
            $fk_usuario = $_POST['fk_usuario'];

            $AsignacionesController = new AsignacionesController();
                $resultado = $AsignacionesController->crearAsignacion($nombre, $estatus, $descripcion, $f_inicio, $f_fin, $fk_servicios, $fk_usuario); // Aquí se pasa el servicioId en lugar de $fk_servicios 
        }
    ?>

<div class="bg-white rounded h-25 p-4" style="width: 50%; margin:auto;">
        <center><h1>Crear Asignacion</h1></center>
        <form method="POST">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput"
                name="nombre" id="nombre" required>
                <label for="floatingInput">Nombre</label>
            </div>

            <div class="form-floating mb-3">
                <select class="form-select" id="floatingSelect" aria-label="Default select example" name="estatus" id="estatus" required>
                    <option value="">Seleccione un estado</option>
                    <option value="1">Asignado</option>
                    <option value="2">En proceso</option>
                    <option value="3">Finalizado</option>
                    <option value="4">Cancelada</option>
                </select>
            </div>

            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Descripcion"
                id="floatingTextarea" name="descripcion" style="height: 150px;" required></textarea>
                <label for="floatingTextarea">Descripcion</label>
            </div>

            <div class="form-floating mb-3">
                <input class="form-control" type="date" name="f_inicio" id="f_inicio" required>
                <label for="f_inicio">Fecha de inicio:</label>
            </div>
        
            <div class="form-floating mb-3">
                <input class="form-control" type="date" name="f_fin" id="f_fin" required>
                <label for="f_fin">Fecha de fin:</label>
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
                <select class="form-select" id="fk_usuario" aria-label="Default select example" name="fk_usuario" required disabled>
                    <option value="">Seleccione un Usuario</option>
                    <?php
                    require_once '../controlador/UsuariosController.php';
                    $UsuariosController = new UsuariosController();
                    $Usuarios = $UsuariosController->verTodosAsignacion();

                    foreach ($Usuarios as $Usuario) {
                        echo "<option value='" . $Usuario['id_usuario'] . "' data-service='" . $Usuario['servicio'] . "'>" . $Usuario['nombre_usuario'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-floating mb-3">
                <button class="btn btn-outline-success" type="submit">Crear asignación <i class="fa fa-check"></i></button>
                <a class="btn btn-outline-info" href="AsignacionesIndex.php">Volver <i class="fa fa-right-to-bracket"></i></a>
            </div>
        </form>
    </div>
</div>
<script>
    document.getElementById('fk_servicios').addEventListener('change', function() {
        console.log('Servicio seleccionado:', this.value);
        var selectedService = this.value;
        var usersSelect = document.getElementById('fk_usuario');
        
        // Habilitar el select de usuarios
        usersSelect.disabled = false;
        
        // Filtrar las opciones del select de usuarios
        filterUserOptions(usersSelect, selectedService);
    });

    function filterUserOptions(usersSelect, selectedService) {
        var usersOptions = usersSelect.options;
        var hasMatchingUser = false;

        // Ocultar todas las opciones
        for (var i = 0; i < usersOptions.length; i++) {
            usersOptions[i].style.display = 'none';
        }

        // Mostrar solo las opciones con el mismo valor que el servicio seleccionado
        for (var i = 0; i < usersOptions.length; i++) {
            if (usersOptions[i].getAttribute('data-service') === selectedService) {
                usersOptions[i].style.display = 'block';
                hasMatchingUser = true;
            }
        }

        // Habilitar o deshabilitar el select según la coincidencia
        usersSelect.disabled = !hasMatchingUser;
        

        return hasMatchingUser;
    }
</script>
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