<?php
require_once '../controlador/UsuariosController.php';
$controladorUsuario = new UsuariosController();
require_once '../controlador/RolesController.php';
$controladorRoles = new RolesController();
$rolesMenusSubmenus = $controladorRoles->verTodos();
$vistas = $controladorUsuario->Vistas();
$controlar = $controladorUsuario->controlarAcceso(__FILE__);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php include('../dist/Plantilla.php');?>
    <style>
        .menu-container {
            display: flex;
            flex-wrap: wrap; /* Permite que los menús se ajusten en varias líneas */
            gap: 20px; /* Espacio entre los menús */
        }
        .menu-item {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            width: 150px; /* Ancho fijo para los menús */
            position: relative;
        }
        .submenu-list {
            display: none; /* Ocultar submenús por defecto */
            max-height: 150px; /* Altura máxima para el scroll */
            overflow-y: auto; /* Barra de desplazamiento vertical */
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 10px;
            padding: 5px;
            background-color: #f9f9f9; /* Color de fondo */
            position: absolute; /* Para que se superponga al menú */
            left: 0;
            z-index: 1; /* Asegúrate de que esté por encima */
        }
    </style>
</head>
<body>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fk_rol = ucfirst($_POST['fk_rol']);
    $fk_menus = isset($_POST['fk_menu']) ? $_POST['fk_menu'] : []; // Asegurarse de que sea un array
    $fk_submenus = isset($_POST['fk_submenu']) ? $_POST['fk_submenu'] : []; // Asegurarse de que sea un array

    // Enviar los datos al controlador
    $resultado = $controladorRoles->crearRolMenu($fk_rol, $fk_menus, $fk_submenus);
}
?>

<div class="container-fluid pt-4 px-4">

    <!-- Formulario para seleccionar el rol y asignar el menú y submenús -->
    <div class="bg-white rounded h-25 p-4" style="width: 50%; margin:auto;">
        <center><h1>Asignar Roles, Menús y Submenús</h1></center>

        <form method="POST">
            <div class="form-floating mb-3">
                <select class="form-select" aria-label="Default select example" name="fk_rol" id="fk_rol" required>
                    <option value="">Seleccione un Rol</option>
                    <?php
                        foreach ($rolesMenusSubmenus as $rol) {
                            echo "<option value='" . $rol['id'] . "'>" . $rol['nombre'] . "</option>";
                        }
                    ?>
                </select>
                <label class="form-label" for="rol">Rol:</label>
            </div>

            <div class="form-floating mb-5">
                <label class="form-label">Menús y Submenús:</label><br><br>
                <div class="menu-container ">
                    <?php
                    require_once '../controlador/MenusController.php';
                    $MenusController = new MenusController();
                    $menus = $MenusController->verTodos();

                    // Obtener todos los submenús
                    require_once '../controlador/SubmenusController.php';
                    $SubmenusController = new SubmenusController();
                    $submenus = $SubmenusController->verSubmenusPorMenus();

                    // Agrupar submenús por menú
                    $submenusPorMenu = [];
                    foreach ($submenus as $submenu) {
                        $submenusPorMenu[$submenu['fk_menu']][] = $submenu;
                    }

                    foreach ($menus as $menu) {
                        echo "<div class='menu-item'>";
                        echo "<input class='form-check-input' type='checkbox' name='fk_menu[]' value='" . $menu['id'] . "' id='menu_" . $menu['id'] . "'>";
                        echo "<label class='form-check-label' for='menu_" . $menu['id'] . "'>" . $menu['nombre'] . "</label>";
                        echo "<div class='submenu-list'>"; // Contenedor para submenús

                        // Mostrar submenús correspondientes a este menú
                        if (isset($submenusPorMenu[$menu['id']])) {
                            foreach ($submenusPorMenu[$menu['id']] as $submenu) {
                                echo "<div class='form-check'>";
                                echo "<input class='form-check-input' type='checkbox' name='fk_submenu[]' value='" . $submenu['id_submenus'] . "' id='submenu_" . $submenu['id_submenus'] . "'>";
                                echo "<label class='form-check-label' for='submenu_" . $submenu['id_submenus'] . "'>" . $submenu['nombre'] . "</label>";
                                echo "</div>";
                            }
                        }
                        echo "</div>"; // Cierre de submenu-list
                        echo "</div>"; // Cierre de menu-item
                    }
                    ?>
                </div>
            </div>

            <div class="">
                <button class="btn btn-outline-success" type="submit">Asignar. <i class="fa fa-check"></i></button>
                <a class="btn btn-outline-info" href="RolesIndex.php">Volver <i class="fa fa-right-to-bracket"></i></a>
            </div>
        </form>
    </div>    
</div>

<script>
    // Obtener todos los checkboxes de menú
    var menuCheckboxes = document.querySelectorAll('.menu-container .menu-item input[type="checkbox"]');

    // Agregar evento de cambio a los checkboxes de menú
    menuCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            var submenuList = this.parentElement.querySelector('.submenu-list');
            if (submenuList) {
                submenuList.style.display = this.checked ? 'block' : 'none'; // Mostrar/ocultar submenús
            }
        });
    });
</script>
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
    <script src="../dist/js/validaciongenerica.js"></script>
    <script src="../dist/js/validacionseguridad.js"></script>
</body>
</html>
