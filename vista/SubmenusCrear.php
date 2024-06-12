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

        <?php
            require_once '../controlador/SubmenusController.php';

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $nombre = ucfirst($_POST['nombre']);
                $url = ($_POST['url']);
                $icono =($_POST['icono']); // Aquí se corrige el nombre del campo
                $orden = ucfirst($_POST['orden']);
                $fk_menus = ucfirst($_POST['fk_menus']);
                

                $submenuscontroller = new SubmenusController();

                // Verificar si el Laboratorio ya existe
                $existesubmenus = $submenuscontroller->verificarSubmenusExistente($nombre);

                if ($existesubmenus) {
                    echo "<script> alert ('Error: El Laboratorio ya existe.')</script>";
                } else {
                    $resultado = $submenuscontroller->crear($nombre, $url, $icono, $orden,  $fk_menus);

                    if ($resultado) {
                        echo "<script> alert '(Error: Estado creado exitosamente.)'</script>";
                        header("Location: SubmenusIndex.php"); 
                    } else {
                        echo "Error al crear el Laboratorio.";
                    }
                }
            }
            
        ?>

<div class="bg-white rounded h-25 p-4" style="width: 50%; margin:auto;">

            <center><h1>Crear menu</h1></center>

    <form method="POST" autocomplete="off">
        <div class="form-floating mb-3">
            <input class="form-control" type="text" name="nombre" id="nombre" required>
            <label for="nombre">Nombre:</label>
        </div>

        <div class="form-floating mb-3">
            <select class="form-select" id="url" aria-label="Default select example" name="url" required>
                <option value="">Selecciona una URL</option>
                <?php
                    $modelDir = '../modelo/';
                    $files = scandir($modelDir);
                        foreach ($files as $file) {
                            $selected = ($menu['id'] == $submenus['fk_menus']) ? 'selected' : '';
                            if ($file !== '.' && $file !== '..' && is_file($modelDir . $file)) {
                                $fileName = pathinfo($file, PATHINFO_FILENAME);
                                $selected = ($fileName == $submenus['url']) ? 'selected' : '';
                                echo "<option value='" . $fileName . "' $selected>" . $fileName . "</option>";
                            }
                        }
                ?>
            </select>
            <label for="url">URL:</label>
        </div>
        <div class="form-floating mb-3">
            <input class="form-control" type="text" name="icono" id="icono" required>
            <label for="icono">Icono:</label>
            <div class="form-control-icon">
                <i class="fas fa-search" id="icon-display"></i>
            </div>
        </div>
        <div class="form-floating mb-3">
            <input class="form-control" type="text" name="orden" id="orden" required>
            <label for="orden">Orden:</label>
        </div>

        <div class="form-floating mb-3">
            <select class="form-select" id="fk_menus" aria-label="Default select example" name="fk_menus" required>
                <option value="">Seleccione un menu</option>
                <?php
                    require_once '../controlador/MenusController.php';
                    $menusController = new MenusController();
                    $menus = $menusController->verTodos();

                    foreach ($menus as $menu) {
                        echo "<option value='" . $menu['id'] . "'>" . $menu['nombre'] . "</option>";
                    }
                ?>
            </select>
        </div>

        
        


        <div class="form-floating mb-3">
            <button class="btn btn-outline-success" type="submit">Guardar menu. <i class="fa fa-check"></i></button>
            <a class="btn btn-outline-info" href="SubmenusIndex.php">Volver <i class="fa fa-right-to-bracket"></i></a>
        </div>
    </form>
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
    <script src="../dist/plantilla/js/main.js"></script>
        <script src="../dist/js/buscar.js"></script>
       <!--  <script src="../dist/js/validaciongenerica.js"></script>
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
