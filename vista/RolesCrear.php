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
            require_once '../controlador/RolesController.php';

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $nombre = ucfirst($_POST['nombre']);
                $valor = ucfirst($_POST['valor']);
                $descripcion = ucfirst($_POST['descripcion']);
                $fk_cargo =  $_POST['fk_cargos'];
                
                

                $rolcontroller = new RolesController();

                // Verificar si el estado ya existe
                $existeRol = $rolcontroller->verificarRolExistente($nombre);

                if ($existeRol) {
                    echo "<script> alert ('Error: El Rol ya existe.')</script>";
                } else {
                    $resultado = $rolcontroller->crear($nombre, $valor, $descripcion, $fk_cargo);

                    if ($resultado) {
                        echo "<script> alert '(Error: Estado creado exitosamente.)'</script>";
                    /*    header("Location: RolIndex.php"); */
                    } else {
                        echo "Error al crear el estado.";
                    }
                }
            }
            
        ?>
        <div class="bg-white rounded h-25 p-4" style="width: 50%; margin:auto;">
            <center><h1>Crear Rol</h1></center>


            <form method="POST">

                <div class="form-floating mb-3">
                    <input class="form-control " type="text" name="nombre" id="nombre" required>
                    <label class="form-label " for="nombre">Nombre:</label>
                </div>

                <div class="form-floating mb-3">
                    <select class="form-select" aria-label="Default select example" name="valor" id="valor">
                        <option value="1">Administrador</option>
                        <option value="2">Director</option>
                        <option value="3">Analista</option>
                        <option value="4">Medico</option>
                        <option value="5">Enfermero</option>
                    </select>
                    <label class="form-label " for="valor">Denominación del Cargo:</label>
                </div>

                <div class="form-floating mb-3">
                    <select class="form-select" id="fk_cargos" aria-label="Default select example" name="fk_cargos" required>
                        <option value="">Seleccione un Cargo</option>
                        <?php
                            require_once '../controlador/CargosController.php';
                            $cargosController = new CargosController();
                            $cargos = $cargosController->verTodos();

                            foreach ($cargos as $cargo) {
                                echo "<option value='" . $cargo['id'] . "'>" . $cargo['nombre'] . "</option>";
                            }
                        ?>
                    </select>
                </div>
                <a href="CargosCrear.php" id="link-agregar-cargo" style="display: none;">Crear Cargo, si no existe un cargo en la lista</a>
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Descripcion"
                    id="descripcion" name="descripcion" style="height: 150px;" required></textarea>
                    <label class="form-label " for="nombre">Descripción:</label>
                </div>

                <div class="form-floating mb-3">
                    <button class="btn btn-outline-success" type="submit">Crear Rol. <i class="fa fa-check"></i></button>
                    <a class="btn btn-outline-info" href="RolesIndex.php">Volver <i class="fa fa-right-to-bracket"></i></a>
                </div>

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
        // Obtener referencias a los elementos del formulario
    const cargoSelect = document.getElementById('fk_cargos');
    const linkAgregarCargo = document.getElementById('link-agregar-cargo');

    // Agregar evento de escucha al select
    cargoSelect.addEventListener('change', mostrarOcultarLink);

    // Función para mostrar u ocultar el enlace
    function mostrarOcultarLink() {
        // Verificar si se ha seleccionado un valor en el select
        if (cargoSelect.value === '') {
            linkAgregarCargo.style.display = 'inline-block'; // Mostrar enlace de agregar cargo
        } else {
            linkAgregarCargo.style.display = 'none'; // Ocultar enlace de agregar cargo
        }
    }

    // Llamar a la función al cargar la página para establecer el estado inicial del enlace
    mostrarOcultarLink();
    </script>
    <!-- Template Javascript -->
    <script src="../dist/plantilla/js/main.js"></script>
    <script src="../dist/js/buscar.js"></script>
    <script src="../dist/js/validaciongenerica.js"></script>
    <script src="../dist/js/validacionseguridad.js"></script>
</body>
</html>
