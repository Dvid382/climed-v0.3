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

    <?php
    require_once('../controlador/CitasController.php');
    require_once('../controlador/CitasEnfermeriaController.php');
    require_once('../controlador/CitasMedicoController.php');

    $citasController = new CitasController();
    $citasEnfermeriaController = new CitasEnfermeriaController();
    $citasMedicoController = new CitasMedicoController();

    if (isset($_GET['id'])) {
        $citaId = $_GET['id'];
        $cita = $citasController->verCitasEnfermeriaMedicoPorId($citaId);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $diagnostico = $_POST['diagnostico'];
            $fk_patologia = $_POST['fk_patologia'];
            $fk_laboratorio = $_POST['fk_laboratorio'];
            $cita_enfermeria_id = $_POST['citas_enfermeria_id'];
            $receta = $_POST['receta'];
            $f_inicio = $_POST['f_inicio'];
            $fk_medicamento = $_POST['fk_medicamento'];
            $f_fin = $_POST['f_fin'];
            $descripcion = $_POST['descripcion'];
            $f_inicio_evolucion = $_POST['f_inicio_evolucion'];
            $f_fin_evolucion = $_POST['f_fin_evolucion'];


            $citasMedicoController->CrearHistoriaMedica($diagnostico, $fk_patologia, $fk_laboratorio, $cita_enfermeria_id, $receta, $f_inicio, $fk_medicamento, $f_fin, $descripcion, $f_inicio_evolucion, $f_fin_evolucion, $citaId);

            exit();
        }
    }
    ?>
    <?php
     $cita = $citasController->verCitasEnfermeriaMedicoPorId($citaId);

     if ($cita['estatus'] < 3) {
            echo "<script>
            swal({
                title: 'Error',
                text: 'No se puede generar este paso si no se ha creado, notificado y confirmado la cita.',
                icon: 'error',
                className: 'custom-swal'
            }).then((willRedirect) => {
                if (willRedirect) {
                    window.location.href = 'CitasMedicoIndex.php'; // Redirige a tu página PHP
                }
            });
        </script>";
         exit();
     }
    ?>

    <div class="container-fluid pt-4 px-4">
        <div class="bg-white rounded h-25 p-4" style="width: 90%; margin:auto;">
        <h1 class="text-center mb-4">Crear Historia Médica</h1>
        <div class="row">
                <div class="col-sm-3">
                    <h5 class="card-subtitle">Cédula:</h5>
                    <p class="alert alert-info"><?php echo $cita['cedula_paciente']; ?></p>
                </div>
                <div class="col-sm-3">
                    <h5 class="card-subtitle">Nombre:</h5>
                    <p class="alert alert-info"><?php echo $cita['nombre_paciente']. " " .$cita['apellido_paciente']; ?></p>
                </div>
                <div class="col-sm-3">
                    <h5 class="card-subtitle">Médico:</h5>
                    <p class="alert alert-info"><?php echo $cita['nombre_medico']. " " . $cita['apellido_medico']; ?></p>
                </div>
                <div class="col-sm-3">
                    <h5 class="card-subtitle">Datos de la cita:</h5>
                    <p class="alert alert-info">Servicio: <?php echo $cita['nombre_servicio']. " Consultorio:" . $cita['nombre_consultorio'];?></p>
                </div>
                <div class="col-sm-5">
                    <h5 class="card-subtitle">Examen Fisico:</h5>
                    <p class="alert alert-info">Peso: <?php echo $cita['peso']. ", altura:" . $cita['altura']. ", Tencion: " . $cita['tension'];?></p>
                </div>
            </div>
        <form  method="post" id="formulario-historia-medica" autocomplete="off">
            <div class="form-group">
                <h2>Datos de la Historia Médica</h2>
                <input type="hidden" value="<?php echo $cita['citas_enfermeria_id'];?>" name="citas_enfermeria_id" >
                <label for="diagnostico">Diagnóstico:</label>
                <textarea class="form-control" name="diagnostico" id="diagnostico" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="fk_patologia">Patologías:</label>
                <select class="form-control" name="fk_patologia" id="fk_patologia"  required>
                    <?php
                        require_once('../controlador/PatologiasController.php');
                        $PatologiasController = new PatologiasController();
                        $patologias = $PatologiasController->verTodos(); // Función para obtener las patologías desde la base de datos
                        foreach ($patologias as $patologia) {
                            echo "<option value='" . $patologia['id'] . "'>" . $patologia['nombre'] . "</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="fk_laboratorio">Laboratorios:</label>
                <select class="form-control" name="fk_laboratorio" id="fk_laboratorio"  required>
                    <?php
                        require_once('../controlador/LaboratoriosController.php');
                        $LaboratoriosController = new LaboratoriosController();
                        $laboratorios = $LaboratoriosController->verTodos(); // Función para obtener los laboratorios desde la base de datos
                        foreach ($laboratorios as $laboratorio) {
                            echo "<option value='" . $laboratorio['id'] . "'>" . $laboratorio['nombre'] . "</option>";
                        }
                    ?>
                </select>
            </div>

            <button type="button" class="btn btn-primary m-2" onclick="mostrarFormularioReceta()">Agregar Recipe</button>

            <div id="formulario-receta" class="mt-4" style="display: none;">
                <h2>Receta</h2>
                <div class="form-group">
                    <label for="receta">Receta:</label>
                    <textarea class="form-control" name="receta" id="receta" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label for="f_inicio">Fecha de Inicio:</label>
                    <input class="form-control" type="date" name="f_inicio" id="f_inicio" required>
                </div>

                <div class="form-group">
                    <label for="f_fin">Fecha de Fin:</label>
                    <input class="form-control" type="date" name="f_fin" id="f_fin" required>
                </div>

                <div class="form-group">
                    <label for="fk_medicamento">Medicamentos:</label>
                    <select class="form-control" name="fk_medicamento" id="fk_medicamento"  required>
                        <?php
                            require_once('../controlador/MedicamentosController.php');
                            $MedicamentosController = new MedicamentosController();
                            $medicamentos = $MedicamentosController->verTodos(); // Función para obtener los medicamentos desde la base de datos
                            foreach ($medicamentos as $medicamento) {
                                echo "<option value='" . $medicamento['id'] . "'>" . $medicamento['nombre_comercial'] . " " . $medicamento['nombre_unidad_medida'] . " " . $medicamento['cantidad'] . " " . $medicamento['nombre_unidad_peso'] . "</option>";
                            }
                        ?>
                    </select>
                </div>

                <button type="button" class="btn btn-primary m-2" onclick="mostrarFormularioEvolucion()">Agregar Reposo</button>
            </div>

            <div id="formulario-evolucion" class="mt-4" style="display: none;">
                <h2>Reposo</h2>
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea class="form-control" name="descripcion" id="descripcion" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label for="f_inicio_evolucion">Fecha de Inicio:</label>
                    <input class="form-control" type="date" name="f_inicio_evolucion" id="f_inicio_evolucion" required>
                </div>

                <div class="form-group">
                    <label for="f_fin_evolucion">Fecha de Fin:</label>
                    <input class="form-control" type="date" name="f_fin_evolucion" id="f_fin_evolucion" required>
                </div>
            </div>

            <button type="submit" class="btn btn-success m-2" id="btn-guardar" disabled>Guardar</button>
        </form>
        </div>
    </div>

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
    <script>
        function mostrarFormularioReceta() {
            document.getElementById("formulario-receta").style.display = "block";
        }

        function mostrarFormularioEvolucion() {
            document.getElementById("formulario-evolucion").style.display = "block";
        }
    </script>
    <script>
        // Obtener referencias a los elementos del formulario
        const formulario = document.getElementById('formulario-historia-medica');
        const btnGuardar = document.getElementById('btn-guardar');

        // Agregar evento de escucha al formulario
        formulario.addEventListener('input', () => {
            // Obtener todos los campos requeridos
            const camposRequeridos = formulario.querySelectorAll('input[required], textarea[required], select[required]');

            // Verificar si todos los campos requeridos están llenos
            let camposLlenos = true;
            for (let i = 0; i < camposRequeridos.length; i++) {
                if (camposRequeridos[i].value.trim() === '') {
                    camposLlenos = false;
                    break;
                }
            }

            // Habilitar o deshabilitar el botón de "Guardar"
            btnGuardar.disabled = !camposLlenos;
        });
    </script>
    <!-- Template Javascript -->
    <script src="../dist/plantilla/js/main.js"></script>
        <script src="../dist/js/buscar.js"></script>
        <script src="../dist/js/validacionseguridad.js"></script>
    <!--     <script src="../dist/js/validarusuario.js"></script> -->
</body>
</html>