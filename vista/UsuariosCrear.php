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
                    

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $foto = $_FILES['foto'];
                        $clave = ucfirst($_POST['clave']);
                        $fk_persona = ucfirst($_POST['fk_persona']);
                        $fk_rol = ucfirst($_POST['fk_rol']);
                        $fk_servicio = ucfirst($_POST['fk_servicio']);
                        $estatus = $_POST['estatus'];

                        $UsuarioController = new UsuariosController();

                        // Verificar si el municipio ya existe
                        $existeUsuario = $UsuarioController->verificarUsuarioExistente($fk_persona);

                        if ($existeUsuario) {
                            echo "<script>alert('Error: El usuario ya existe.');</script>";
                        } else {
                            $resultado = $UsuarioController->crearUsuario( $foto, $clave, $fk_persona, $fk_rol, $fk_servicio, $estatus);

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
                        <input class="form-control " type="number" name="cedula" id="cedula" required><br>
                        <label class="form-label " for="cedula">Cedula:</label>
                    </div>

                    <div id="datos_persona"></div>

                    <div class="form-floating mb-3">
                        <input class="form-control " type="file" name="foto" id="foto" required><br>
                        <label class="form-label " for="foto">Foto:</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input class="form-control " type="password" name="clave" id="clave" required><br>
                        <label class="form-label " for="clave">Contraseña:</label>
                    </div>

                    <input type="hidden" name="fk_persona" id="fk_persona">


                    <div class="form-floating mb-3">
                        <select class="form-select" aria-label="Default select example" name="fk_rol" id="fk_rol" required>
                            <option value="">Seleccione un rol</option>
                            <!-- Populate the options with the list of states from the database -->
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
                    </div>


                    <div class="form-floating mb-3">
                        <select class="form-select" aria-label="Default select example" name="fk_servicio" id="fk_servicio" required>
                            <option value="">Seleccione un Servicio</option>
                            <!-- Populate the options with the list of states from the database -->
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
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" aria-label="Default select example" name="estatus" id="estatus">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                        </select>
                        <label for="floatingTextarea">Estatus:</label>
                    </div>

                    <div class="form-floating mb-3">
                        <button class="btn btn-outline-success" type="submit">Crear Usuario. <i class="fa fa-check"></i></button>
                        <a class="btn btn-outline-info" href="UsuariosIndex.php">Volver <i class="fa fa-right-to-bracket"></i></a>
                    </div>
                </form>
         </div>
    </div>

    <script src="dist/js/jquery-3.7.1.min.js"></script>
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
