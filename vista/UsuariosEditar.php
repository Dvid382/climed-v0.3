<?php
require_once '../controlador/UsuariosController.php';
require_once '../controlador/RolesController.php';
require_once '../controlador/ServiciosController.php';
require_once '../controlador/PersonasController.php';
$controladorUsuario = new UsuariosController();
$controladorRol = new RolesController();
$roles = $controladorRol->verTodos();
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
            require_once '../controlador/UsuariosController.php';

            // Crear una instancia de rolcontroller
            $usuariocontroller = new UsuariosController();


            // Verificar si se recibió el ID del Rol a editar
            if (isset($_GET['id'])) {
                $usuarioId = $_GET['id'];
        
                // Obtener los datos del Usuario con el ID proporcionado
                $usuario = $usuariocontroller->verUsuarioPorId($usuarioId);
        
                // Verificar si se enviaron los datos actualizados del Usuario
                if (isset($_FILES['foto']['name']) && isset($_POST['clave']) && isset($_POST['fk_persona']) && isset($_POST['fk_rol']) && isset($_POST['fk_servicio']) && isset($_POST['estatus'])) {
                    
                    $nuevaFoto = $_FILES['foto'];
                    $nuevaClave = $_POST['clave'];
                    $nuevoRol = $_POST['fk_rol'];
                    $nuevaPersona = $_POST['fk_persona'];
                    $nuevoServicio = $_POST['fk_servicio'];
                    $nuevoEstado = $_POST['estatus'];
                      
                    // Obtener menús y submenús seleccionados
                    $fk_menus = isset($_POST['fk_menu']) ? $_POST['fk_menu'] : [];
                    $fk_submenus = isset($_POST['fk_submenu']) ? $_POST['fk_submenu'] : [];

                    // Actualizar los datos del Usuario con los nuevos valores
                    $resultado = $usuariocontroller->modificarUsuario($usuarioId, $nuevaFoto, $nuevaClave, $nuevoRol, $nuevaPersona, $nuevoServicio, $nuevoEstado, $fk_menus, $fk_submenus);
                    
                    if ($resultado) {
                    echo "<script>alert('Usuario Modificado exitosamente.');</script>";
                    header("Location: Inicio.php");
                    } else {
                        echo "<script>alert('Error: No se pudo Modificar el usuario.');</script>";
                        header("Location: UsuariosCrear.php");
                    }
                }
            }
        ?>

<div class="bg-white rounded h-25 p-4" style="width: 50%; margin:auto;">
    <center><h1>Editar Usuario</h1></center>
            <form method="POST" enctype="multipart/form-data">
        

                <div class="form-floating mb-3">
                    <input class="form-control" type="text" id="cedula" name="cedula" value="<?php $personasUsuario = $controladorUsuario->buscarDatosPersonas($usuario['fk_persona']); echo $personasUsuario['cedula_persona'];?>"  readonly>
                    <label class="form-label " for="cedula">Cedula:</label>
                </div>

                <div id="datos_persona"></div>

                    

                <div class="form-floating mb-3">
                    <img class="form-label" src="<?php echo $usuario['foto']; ?>" width="10%" height="10%">
                    <input class="form-control" type="file" id="foto" name="foto" value="<?php echo $usuario['foto']; ?>">
                    <label class="form-label " for="foto">Foto:</label>
                    
                </div>

                <div class="form-floating mb-3">
                    <input class="form-control " type="password" name="clave" id="clave" required><br>
                    <label class="form-label " for="clave">Contraseña:</label>
                </div>

                <input type="hidden" name="fk_persona" id="fk_persona">


                <div class="form-floating mb-3">
                    <select class="form-select" aria-label="Default select example" name="fk_rol" id="fk_rol">
                            <?php
                            require_once '../controlador/RolesController.php';
                            $RolController = new RolesController();
                            $roles = $RolController->verTodos();

                            foreach ($roles as $rol) {
                                echo "<option value='" . $rol['id'] . "'>" . $rol['nombre'] . "</option>";
                            }
                            ?>
                    </select>
                    <label class="form-label " for="fk_rol">Rol del usuario:</label>
                </div>


                <div class="form-floating mb-3">
                    <select class="form-select" aria-label="Default select example" name="fk_servicio" id="fk_servicio">
                            <?php
                                require_once '../controlador/ServiciosController.php';
                                $ServiciosController = new ServiciosController();
                                $servicios = $ServiciosController->verTodos();

                                foreach ($servicios as $servicio) {
                                    echo "<option value='" . $servicio['id'] . "'>" . $servicio['nombre'] . "</option>";
                                }
                            ?>
                    </select>
                    <label class="form-label " for="fk_servicio">Servicio:</label>
                </div>

                <div class="form-floating mb-3">
                    <input class="form-control" type="hidden" name="estatus" id="estatus" value="1">
                </div>

                <!-- Menús y Submenús para Editar -->
<div id="menus-container" class="form-floating mb-3" style="display: none;">
    <label class="form-label" for="menus">Menús del rol:</label>
    <div id="menus"></div>
</div>

<script>
// Cargar menús automáticamente cuando hay un rol seleccionado
$(document).ready(function() {
    var rolId = $('#fk_rol').val(); // Obtener el rol seleccionado al cargar la página

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
    }

    // Agregar evento de cambio al campo de rol para cargar menús dinámicamente
    $('#fk_rol').change(function() {
        var rolId = $(this).val();
        if (rolId) {
            $.ajax({
                url: 'obtener_menus.php', // Archivo PHP que manejará la lógica
                type: 'POST',
                data: { rol_id: rolId },
                success: function(data) {
                    $('#menus').html(data);
                    // Descomentar si deseas mostrar el contenedor de menús cuando se cargan los datos
                    // $('#menus-container').show();
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

                <div class="form-floating mb-3">
                    <button class="btn btn-outline-success" type="submit">Crear Usuario. <i class="fa fa-check"></i></button>
                    <a class="btn btn-outline-info" href="UsuariosIndex.php">Volver <i class="fa fa-right-to-bracket"></i></a>
                </div>
            </form>
        </div>
    </div>
<script src="../dist/js/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {
    // Obtener el valor del campo cedula al cargar la página
    var cedula = $("#cedula").val();

    // Verificar si la persona ya existe en la base de datos
    verificarPersonaExistente(cedula);

    // Agregar un evento de cambio al campo cedula
    $("#cedula").on("input", function() {
        var cedula = $(this).val();
        verificarPersonaExistente(cedula);
    });
});

function verificarPersonaExistente(cedula) {
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
}
</script>


    <!-- libreries JS -->
    <script src="../dist/js/LimpiarInput.js"></script>
            <script src="../dist/plantilla/lib/bootstrap.bundle.min.js"></script>
                <script src="../dist/plantilla/lib/chart/chart.min.js"></script>
                    <script src="../dist/plantilla/lib/easing/easing.min.js"></script>
                        <script src="../dist/plantilla/lib/waypoints/waypoints.min.js"></script>
                    <script src="../dist/plantilla/lib/owlcarousel/owl.carousel.min.js"></script>
                <script src="../dist/plantilla/lib/tempusdominus/js/moment.min.js"></script>
            <script src="../dist/plantilla/lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="../dist/plantilla/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
 <script src="../dist/js/validarusuario.js"></script>
 <script src="../dist/js/validarpersona.js"></script>
</body>
</html>