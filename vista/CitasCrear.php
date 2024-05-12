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

<?php
        require_once '../controlador/CitasController.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fk_persona = ucfirst($_POST['fk_persona']);
            $fk_servicio = ucfirst($_POST['fk_servicio']);
            $fk_usuario = ucfirst($_POST['fk_usuario']);
            $fecha = ucfirst($_POST['fecha']);
            $hora = ucfirst($_POST['hora']);
            $estatus = ucfirst($_POST['estatus']);
            $fk_usuario_sesion = ucfirst($_POST['fk_usuario_sesion']);
            $fk_consultorio = ucfirst($_POST['fk_consultorio']);
            
            
            
            

            $CitasController = new CitasController();

            // Verificar si el estado ya existe
            $existeCitas = $CitasController->verificarCitasExistentes($fk_persona, $fk_servicio, $fk_usuario, $fecha, $hora);

            if ($existeCitas) {
                echo "<script> alert ('Error: El Consultorio ya existe.')</script>";
            } else {
                $resultado = $CitasController->crearCitas($fk_persona, $fk_servicio, $fk_usuario, $fecha, $hora, $estatus, $fk_usuario_sesion, $fk_consultorio);

                if ($resultado) {
                    echo "<script> alert '(Error: Estado creado exitosamente.)'</script>";
                     header("Location: ConsultoriosIndex.php"); 
                } else {
                    echo "Error al crear el estado.";
                }
            }
        }
        
     ?>


    <div class="container-fluid pt-4 px-4">
        <div class="bg-white rounded h-25 p-4" style="width: 50%; margin:auto;">
            <center><h1>Crear citas</h1></center>
            <form method="POST" enctype="multipart/form-data">

                <div class="form-floating mb-3">
                    <input class="form-control " type="number" name="cedula" id="cedula" required><br>
                    <label class="form-label " for="cedula">Cedula:</label>
                </div>

                <div id="datos_persona"></div>
                <input type="hidden" name="fk_persona" id="fk_persona">

                <div class="form-floating mb-3">
                    <select class="form-select" id="fk_consultorio" aria-label="Default select example" name="fk_consultorio" required>
                        <option value="">Seleccione un Consultorio</option>
                            <?php
                                require_once '../controlador/ConsultoriosController.php';
                                $ConsultoriosController = new ConsultoriosController();
                                $consultorios = $ConsultoriosController->verTodos();

                                foreach ($consultorios as $consultorio) {
                                        echo "<option value='" . $consultorio['id'] . "'>" . $consultorio['nombre'] . "</option>";
                                }
                            ?>
                    </select>
                </div>

                <div class="form-floating mb-3">
                    <select class="form-select" id="fk_servicio" aria-label="Default select example" name="fk_servicio" required>
                        <option value="">Seleccione un Servicio</option>
                            <?php
                                require_once '../controlador/ServiciosController.php';
                                $ServiciosController = new ServiciosController();
                                $servicios = $ServiciosController->verTodos();

                                foreach ($servicios as $servicio) {
                                    /* ($servicio['valor'] == 3 && $servicio['valor'] == 4) */
                                    if ($servicio['valor'] == 3 || $servicio['valor'] == 4){
                                        echo "<option value='" . $servicio['id'] . "'>" . $servicio['nombre'] . "</option>";
                                    }
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
                    <input class="form-control " type="date" name="fecha" id="fecha" required><br>
                    <label class="form-label " for="fecha">Fecha:</label>
                </div>

                <div class="form-floating mb-3">
                    <input class="form-control " type="time" name="hora" id="hora" required><br>
                    <label class="form-label " for="hora">Hora:</label>
                </div>

                <div class="form-floating mb-3">
                    <select class="form-select" id="floatingTextarea" aria-label="Default select example" name="estatus" id="estatus">
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                    </select>
                    <label  for="floatingTextarea">Estatus:</label>
                </div>

                <input type='hidden' class='form-control form-control-sm' name='fk_usuario_sesion' id='fk_usuario_sesion' value='<?php echo $_SESSION['id_usuario'] ?>'>

                <div class="form-floating mb-3">
                    <button class="btn btn-outline-success" type="submit">Guardar cita. <i class="fa fa-check"></i></button>
                    <a class="btn btn-outline-info" href="CitasIndex.php">Volver <i class="fa fa-right-to-bracket"></i></a>
                </div>
            </form>
        </div>
    </div>

<script src="dist/js/jquery-3.7.1.min.js"></script>
<!-- Nombre y Apellido de Usuario -->
<script>
    $(document).ready(function() {
        $("#cedula").on("input", function() {
            var cedula = $(this).val();
            $.ajax({
                url: "funcionPersona.php",
                type: "POST",
                data: {
                    cedula: cedula
                },
                success: function(data) {
                    var persona = JSON.parse(data);
                    if (persona.id) {
                        $("#fk_persona").val(persona.id);
                        $("#datos_persona").html("<p>Nombre y Apellido: " + persona.nombre + " " + persona.apellido + "</p>");
                    } else {
                        $("#fk_persona").val("");
                        $("#datos_persona").html("<p>No se encontró una persona con esa cédula.</p>");
                    }
                }
            });
        });
    });
</script>

<!-- Usuarios Asignados -->
<script>
    document.getElementById('fk_servicio').addEventListener('change', function() {
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
        <script src="dist/js/validacionseguridad.js"></script>
    <script src="dist/js/validarusuario.js"></script>
</body>
</html>