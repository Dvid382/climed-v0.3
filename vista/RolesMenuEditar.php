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
    <?php
    $usuario_id = isset($_GET['id']) ? $_GET['id'] : null;
    $usuario = $usuario_id ? $controladorUsuario->verUsuarioPorId($usuario_id) : null;
    $rol_usuario = $usuario_id ? $controladorUsuario->buscarDatosUsuarios($usuario_id) : [];
    
    
    // Obtener los menús y submenús asociados al rol del usuario
    $rol_id = isset($_GET['fk_rol']) ? $_GET['fk_rol'] : null;
    $menus_submenus = $rol_id ? $controladorRoles->obtenerMenusSubMenusPorUsuario($usuario_id) : [];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fk_rol = ucfirst($_POST['fk_rol']);
        $fk_menus = $_POST['fk_menu'];
        $fk_submenus = $_POST['fk_submenu'];
        $fk_usuario = ucfirst($_POST['fk_usuario']);
    
            foreach ($fk_menus as $fk_menu) {
                foreach ($fk_submenus as $fk_submenu) {
                    $resultado = $controladorRoles->actualizarMenusSubMenusPorRol($rol_id, $fk_menus, $fk_submenus, $fk_usuario);
                }
            }
    
    }
    ?>
<div class="container-fluid pt-4 px-4">
    <div class="bg-white rounded h-25 p-4" style="width: 50%; margin:auto;">
        <center><h1>Editar Roles, Menus y Submenús</h1></center>

        <form method="POST">
            <div class="form-floating mb-3">
                <select class="form-select" aria-label="Default select example" name="fk_usuario" id="fk_usuario">
                    <option value="">Seleccione un Usuario</option>
                    <?php
                    $usuario = $controladorUsuario->verDatosUsuarioPorId($usuario_id);
                    if ($usuario) {
                        echo "<option value='" . $usuario['usuario_id'] . "' selected>" . $usuario['nombre'] . "</option>";
                    }
                    ?>
                </select>
                <label class="form-label" for="fk_usuario">Usuario:</label>
            </div>

            <div class="form-floating mb-3">
                <select class="form-select" aria-label="Default select example" name="fk_rol" id="fk_rol">
                    <option value="">Seleccione un Rol</option>
                    <?php
                    $usuario = $controladorUsuario->verDatosUsuarioPorId($usuario_id);
                    if ($usuario) {
                        echo "<option value='" . $usuario['rol_usuario'] . "' selected>" . $usuario['nombre_rol'] . "</option>";
                    }
                    ?>
                </select>
                <label class="form-label" for="fk_rol">Rol:</label>
            </div>

            <div class="form-floating mb-3">
    <div class="form-check">
        <?php
        require_once '../controlador/MenusController.php';
        $MenusController = new MenusController();
        $menus = $MenusController->verTodos();

        foreach ($menus as $menu) {
            $checked = false;
            foreach ($menus_submenus as $item) {
                if ($item['menu_id'] == $menu['id']) {
                    $checked = true;
                    break;
                }
            }
            echo "<div class='form-check form-check-inline menu-item'>";
            echo "<input class='form-check-input' type='checkbox' name='fk_menu[]' value='" . $menu['id'] . "' data-menu='" . $menu['id'] . "' " . ($checked ? 'checked' : '') . ">";
            echo "<label class='form-check-label'>" . $menu['nombre'] . "</label>";
            echo "</div>";
        }
        ?>
    </div>
</div>

<div class="form-floating mb-3">
    <div class="form-check" id="submenu-container">
        <?php
        require_once '../controlador/SubmenusController.php';
        $SubmenusController = new SubmenusController();
        $submenus = $SubmenusController->verSubmenusPorMenus();

        foreach ($submenus as $submenu) {
            $checked = false;
            foreach ($menus_submenus as $item) {
                if ($item['submenu_id'] == $submenu['id_submenus']) {
                    $checked = true;
                    break;
                }
            }
            echo "<div class='form-check form-check-inline submenu-item' data-menu='" . $submenu['fk_menu'] . "' style='display: none;'>";
            echo "<input class='form-check-input' type='checkbox' name='fk_submenu[]' value='" . $submenu['id_submenus'] . "' " . ($checked ? 'checked' : '') . ">";
            echo "<label class='form-check-label'>" . $submenu['nombre'] . "</label>";
            echo "</div>";
        }
        ?>
    </div>
</div>


            <div class="form-floating mb-3">
                <button class="btn btn-outline-success" type="submit">Actualizar. <i class="fa fa-check"></i></button>
                <a class="btn btn-outline-info" href="UsuariosIndex.php">Volver <i class="fa fa-right-to-bracket"></i></a>
            </div>
        </form>
    </div>
</div>

<script src="../dist/js/jquery-3.7.1.min.js"></script>
<script>
        function toggleSubmenuVisibility() {
    // Obtener todos los checkboxes de menú
    var menuCheckboxes = document.querySelectorAll('.menu-item input[type="checkbox"]');

    // Obtener el contenedor de submenús
    var submenuContainer = document.getElementById('submenu-container');

    // Obtener todos los elementos de submenú
    var submenuItems = document.querySelectorAll('.submenu-item');

    // Obtener los menús seleccionados
    var selectedMenus = Array.from(menuCheckboxes)
        .filter(function(cb) { return cb.checked; })
        .map(function(cb) { return cb.getAttribute('data-menu'); });

    // Mostrar/ocultar los elementos de submenú
    submenuItems.forEach(function(item) {
        var itemMenu = item.getAttribute('data-menu');
        if (selectedMenus.includes(itemMenu)) {
        item.style.display = 'inline-block';
        } else {
        item.style.display = 'none';
        }
    });

    // Mostrar el contenedor de submenús si hay al menos un menú seleccionado
    if (selectedMenus.length > 0) {
        submenuContainer.style.display = 'block';
    } else {
        submenuContainer.style.display = 'none';
    }
    }
</script>
<script>
    // Obtener todos los checkboxes de menú
    var menuCheckboxes = document.querySelectorAll('.menu-item input[type="checkbox"]');

    // Obtener el contenedor de submenús
    var submenuContainer = document.getElementById('submenu-container');

    // Obtener todos los elementos de submenú
    var submenuItems = document.querySelectorAll('.submenu-item');

    // Agregar evento de cambio a los checkboxes de menú
    menuCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            var selectedMenus = Array.from(menuCheckboxes)
                .filter(function(cb) { return cb.checked; })
                .map(function(cb) { return cb.getAttribute('data-menu'); });

            // Mostrar todos los elementos de submenú
            submenuItems.forEach(function(item) {
                item.style.display = 'inline-block';
            });

            // Ocultar solo los elementos de submenú que no pertenecen a los menús seleccionados
            submenuItems.forEach(function(item) {
                var itemMenu = item.getAttribute('data-menu');
                if (!selectedMenus.includes(itemMenu)) {
                    item.style.display = 'none';
                }
            });

            // Mostrar el contenedor de submenús si hay al menos un menú seleccionado
            if (selectedMenus.length > 0) {
                submenuContainer.style.display = 'block';
            } else {
                submenuContainer.style.display = 'none';
            }
        });
    });

    // Mostrar los elementos de submenú que pertenecen a los menús seleccionados al cargar la página
    var initiallySelectedMenus = Array.from(menuCheckboxes)
        .filter(function(cb) { return cb.checked; })
        .map(function(cb) { return cb.getAttribute('data-menu'); });

    initiallySelectedMenus.forEach(function(menu) {
        $('.submenu-item[data-menu="' + menu + '"]').show();
    });

    // Mostrar el contenedor de submenús si hay al menos un menú seleccionado al cargar la página
    if ($('.menu-item input[type="checkbox"]:checked').length > 0) {
        submenuContainer.style.display = 'block';
    } else {
        submenuContainer.style.display = 'none';
    }
</script>
</body>
</html>