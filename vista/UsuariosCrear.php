<?php
require_once '../controlador/UsuariosController.php';
$controladorUsuario = new UsuariosController();
require_once '../controlador/RolesController.php';
$controladorRoles = new RolesController();
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $foto = $_FILES['foto'];
            $clave = ucfirst($_POST['clave']);
            $fk_rol = ucfirst($_POST['fk_rol']);
            $fk_persona = ucfirst($_POST['fk_persona']);
            $fk_servicio = ucfirst($_POST['fk_servicio']);
            $estatus = $_POST['estatus'];

            $UsuarioController = new UsuariosController();

            // Verificar si el usuario ya existe
            $existeUsuario = $UsuarioController->verificarUsuarioExistente($fk_persona);

            if ($existeUsuario) {
                echo "<script>alert('Error: El usuario ya existe.');</script>";
            } else {
                // Crear el usuario
                $resultado = $UsuarioController->crearUsuario($foto, $clave, $fk_rol, $fk_persona, $fk_servicio, $estatus);

                if ($resultado) {
                    echo "<script>alert('Usuario creado exitosamente.');</script>";
                    header("Location: UsuarioIndex.php");
                } else {
                    echo "Error al crear el Usuario.";
                }
            }
        }
        ?>

        <div class="bg-white rounded h-25 p-4" style="width: 50%; margin:auto;">
            <center><h1>Crear Usuario</h1></center>
            <form method="POST" enctype="multipart/form-data">

                <div class="form-floating mb-3">
                    <input class="form-control" type="number" name="cedula" id="cedula" required><br>
                    <label class="form-label" for="cedula">Cédula:</label>
                </div>

                <div id="datos_persona"></div>
                <input type="hidden" name="fk_persona" id="fk_persona">

                <div id="agregar_persona" style="display: none;">
                    <a class="btn btn-outline-info" href="InsertarPersonaUsuario.php">Registrar Persona</a>
                </div>

                <div class="form-floating mb-3">
                    <input class="form-control" type="file" name="foto" id="foto" required><br>
                    <label class="form-label" for="foto">Foto:</label>
                </div>

                <div class="form-floating mb-3">
                    <input class="form-control" type="password" name="clave" id="clave" required><br>
                    <label class="form-label" for="clave">Contraseña:</label>
                </div>

                <div class="form-floating mb-3">
                    <select class="form-select" aria-label="Default select example" name="fk_rol" id="fk_rol" required>
                        <option value="">Seleccione un rol</option>
                        <?php
                        require_once '../controlador/RolesController.php';
                        $RolController = new RolesController();
                        $roles = $RolController->verTodos();

                        foreach ($roles as $rol) {
                            echo "<option value='" . $rol['id'] . "'>" . $rol['nombre'] . "</option>";
                        }
                        ?>
                    </select><br>
                    <label class="form-label " for="fk_rol">Rol del usuario:</label>
                    <a href="RolesCrear.php" id="btn-agregar-rol" style="display: none;">Crear Rol, si no existe Rol en la lista</a>
                </div>

                <div class="form-floating mb-3">
                    <select class="form-select" aria-label="Default select example" name="fk_servicio" id="fk_servicio" required>
                        <option value="">Seleccione un Servicio</option>
                        <?php
                        require_once '../controlador/ServiciosController.php';
                        $ServiciosController = new ServiciosController();
                        $servicios = $ServiciosController->verTodos();

                        foreach ($servicios as $servicio) {
                            echo "<option value='" . $servicio['id'] . "'>" . $servicio['nombre'] . "</option>";
                        }
                        ?>
                    </select><br>
                    <label class="form-label " for="fk_servicio">Servicio del usuario:</label>
                    <a href="ServiciosCrear.php" id="btn-agregar-servicio" style="display: none;">Crear Servicio, si no existe un servicio en la lista</a>
                </div>

                <div class="form-floating mb-3">
                    <input type="hidden" class="form-control" name="estatus" id="estatus" value="1">
                </div>

                <!-- Menús y Submenús -->
<!-- No se muestra el contenedor -->
<div id="menus-container" class="form-floating mb-3" style="display: none;">
    <label class="form-label" for="menus">Menús del rol:</label>
    <div id="menus"></div>
</div>

<script>
$(document).ready(function() {
    $('#fk_rol').change(function() {
        var rolId = $(this).val();
        if (rolId) {
            $.ajax({
                url: 'obtener_menus.php', // Archivo PHP que manejará la lógica
                type: 'POST',
                data: { rol_id: rolId },
                success: function(data) {
                    $('#menus').html(data);
                    // Si deseas mostrar los menús bajo ciertas condiciones, puedes agregar lógica aquí
                    // Por ejemplo:
                    // $('#menus-container').show(); // Descomentar si deseas mostrarlo bajo ciertas condiciones
                },
                error: function() {
                    alert('Error al obtener los menús.');
                }
            });
        } else {
            $('#menus').html(''); // Limpiar menús si no hay rol seleccionado
        }
    });
});
</script>

                <div class="">
                    <button class="btn btn-outline-success" type="submit">Crear Usuario. <i class='fa fa-check'></i></button>
                    <a class='btn btn-outline-info' href='UsuariosIndex.php'>Volver <i class='fa fa-right-to-bracket'></i></a>
                </div>
            </form>
        </div>
    </div>


    <script src="../dist/js/jquery-3.7.1.min.js"></script>
    <script>
    $(document).ready(function() {
    // Obtener la cédula del parámetro de la URL
    var urlParams = new URLSearchParams(window.location.search);
    var cedula = urlParams.get('cedula');

    // Asignar la cédula al campo de cédula
    if (cedula) {
        $('#cedula').val(cedula);
        $('#cedula').trigger('input');
    }
        $("#cedula").on("input", function() {
            var cedula = $(this).val();
            if (cedula.trim() === "") {
                $("#datos_persona").html("");
                $("#agregar_persona").hide();
            } else {
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
                            $("#datos_persona").html("<div class='alert alert-info'>Nombre y Apellido: " + persona.nombre + " " + persona.apellido + "</div>");
                            $("#agregar_persona").hide();
                        } else {
                            $("#fk_persona").val("");
                            $("#datos_persona").html("");
                            $("#agregar_persona").html("<div class='alert alert-warning'>No se encontró una persona con esa cédula. <a class='btn btn-outline-info' href='InsertarPersonaCitas.php'>Agregar Paciente</a></div>");
                            $("#agregar_persona").show();
                        }
                    }
                });
            }
        });
    });
</script>
<script>
    // Obtener referencias a los elementos del formulario
const rolSelect = document.getElementById('fk_rol');
const servicioSelect = document.getElementById('fk_servicio');
const btnAgregarRol = document.getElementById('btn-agregar-rol');
const btnAgregarServicio = document.getElementById('btn-agregar-servicio');

// Agregar eventos de escucha a los select
rolSelect.addEventListener('change', mostrarOcultarBotones);
servicioSelect.addEventListener('change', mostrarOcultarBotones);

// Función para mostrar u ocultar los botones
function mostrarOcultarBotones() {
    // Verificar si se ha seleccionado un valor en los select
    if (rolSelect.value === '') {
        btnAgregarRol.style.display = 'inline-block'; // Mostrar botón de agregar rol
    } else {
        btnAgregarRol.style.display = 'none'; // Ocultar botón de agregar rol
    }

    if (servicioSelect.value === '') {
        btnAgregarServicio.style.display = 'inline-block'; // Mostrar botón de agregar servicio
    } else {
        btnAgregarServicio.style.display = 'none'; // Ocultar botón de agregar servicio
    }
}

// Llamar a la función al cargar la página para establecer el estado inicial de los botones
mostrarOcultarBotones();
</script>

    <!-- libreries JS -->

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
    <script src="../dist/js/validacionseguridad.js"></script>
    <script src="../dist/js/validarpersona.js"></script>
    <script src="../dist/js/validarusuario.js"></script>
</body>
</html>
