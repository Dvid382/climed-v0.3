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
<style>
        .form-control {
            padding-right: 2.5rem;
        }
        .form-control-icon {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: #6c757d;
        }
    </style>
</head>
    <body>
    <div class="container-fluid pt-4 px-4">
    <div class="bg-white rounded h-25 p-4" style="width: 50%; margin:auto;">

                <center><h1>Editar Menus</h1></center>

                <?php
                    require_once('../controlador/MenusController.php');

                    // Crear una instancia de rolcontroller
                    $menuscontroller = new MenusController();

                    // Verificar si se recibió el ID del Rol a editar
                    if (isset($_GET['id'])) {
                        $menusId = $_GET['id'];

                        // Obtener los datos del Rol con el ID proporcionado
                        $menus = $menuscontroller->verPorId($menusId);

                        // Verificar si se enviaron los datos actualizados del Rol
                        if (isset($_POST['nombre']) && isset($_POST['url']) && isset($_POST['icono']) && isset($_POST['orden'])) {
                            $nuevoNombre = $_POST['nombre'];
                            $nuevoUrl = $_POST['url'];
                            $nuevoIcono = $_POST['icono'];
                            $nuevoOrden = $_POST['orden'];
                            
                           
                            

                            // Actualizar los datos del Rol con los nuevos valores
                            $menuscontroller->modificar($menusId, $nuevoNombre, $nuevoUrl,  $nuevoIcono, $nuevoOrden);

                            exit();
                        }
                    }
                ?>

                <form method="POST">


                    <div class="form-floating mb-3">
                        <input class="form-control " type="text" name="nombre" id="nombre" value="<?php echo $menus['nombre']; ?> ">
                        <label for="nombre">Nombre:</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="url" aria-label="Default select example" name="url" required>
                            <option value="">Selecciona una URL</option>
                            <option value="#" selected>Lista</option>
                            <?php
/*                                 $modelDir = '../modelo/';
                                $files = scandir($modelDir);
                                $baseUrl = $menus['url']; // Obtener el valor de la base de datos
                                $baseUrlName = preg_replace('/Index$/', '', basename($baseUrl, '.php'));

                                foreach ($files as $file) {
                                    if ($file !== '.' && $file !== '..' && is_file($modelDir . $file)) {
                                        $fileName = pathinfo($file, PATHINFO_FILENAME);
                                        $urlName = preg_replace('/Index$/', '', $fileName);
                                        $selected = ($urlName == $baseUrlName) ? 'selected' : '';
                                        echo "<option value='" . $urlName . "' $selected>" . $urlName . "</option>";
                                    }
                                } */
                            ?>
                        </select>
                        <label for="url">URL:</label>
                    </div>

                    <div class="form-floating mb-3">
                    <input class="form-control" type="text" name="icono" id="icono" required value="<?php
                        $iconoClass = $menus['icono'];
                        preg_match('/fa-solid fa-([^"]+)/', $iconoClass,$matches);
                        echo htmlspecialchars($matches[1]);
                    ?>">



                        <label for="icono">Icono:</label>
                        <div class="form-control-icon">
                            <i class="fas fa-search" id="icon-display"></i>
                        </div>
                    </div>


                    <div class="form-floating mb-3">
                        <input class="form-control " type="text" name="orden" id="orden" value="<?php echo $menus['orden']; ?> ">
                        <label for="orden"> Orden:</label>
                    </div>

                    

                    <div class="form-floating mb-3">
                        <button class="btn btn-outline-success" type="submit">Guardar Menus. <i class="fa fa-check"></i></button>
                        <a class="btn btn-outline-info" href="MenusIndex.php">Volver <i class="fa fa-right-to-bracket"></i></a>
                    </div>

                </form>
                <?php /* var_dump($nombre, $estatus, $valor, $descripcion ); */?>

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

        <!-- Template Javascript -->
        <script src="../dist/js/LimpiarInput.js"></script>
        <script src="../dist/plantilla/js/main.js"></script>
            <script src="dist/js/buscar.js"></script>
       <!--      <script src="../dist/js/validaciongenerica.js"></script>
        <script src="../dist/js/validacionseguridad.js"></script> -->
        <script>
    const iconInput = document.getElementById('icono');
    const iconDisplay = document.getElementById('icon-display');

    iconInput.addEventListener('input', function() {
        const iconClass = `fa fa-${this.value}`;
        iconDisplay.className = iconClass;
    });
</script>
    </body>
</html>
