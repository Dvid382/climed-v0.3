<?php
require_once '../controlador/UsuariosController.php';
$controladorUsuario = new UsuariosController();
require_once '../controlador/RolesController.php';
$controladorRoles = new RolesController();
$vistas = $controladorUsuario->Vistas();
$controlar = $controladorUsuario->controlarAcceso(__FILE__);

$usuario_id = isset($_GET['id']) ? $_GET['id'] : null;
$usuario = $usuario_id ? $controladorUsuario->verDatosUsuarioPorId($usuario_id) : null;
$rol_usuario = $usuario_id ? $controladorUsuario->verDatosUsuarioPorId($usuario_id) : [];

// Obtener los menús y submenús asociados al usuario
$menus_submenus_usuario = $usuario_id ? $controladorRoles->obtenerMenusSubMenusPorUsuario($usuario_id) : [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $fk_usuario = $_POST['fk_usuario'];
    $fk_menus = isset($_POST['fk_menu']) ? $_POST['fk_menu'] : [];
    $fk_submenus = isset($_POST['fk_submenu']) ? $_POST['fk_submenu'] : [];

    // Llamar al método que actualiza los menús y submenús del usuario
    $resultado = $controladorUsuario->actualizarMenusPorUsuario($fk_usuario, $fk_menus, $fk_submenus);

    if ($resultado) {
        echo "<script>alert('Menús y submenús actualizados exitosamente.');</script>";
        header("Location: UsuariosIndex.php");
        exit;
    } else {
        echo "<script>alert('Error al actualizar los menús y submenús.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <?php include('../dist/Plantilla.php');?>
</head>
<body>
<div class="container-fluid pt-4 px-4">
    <div class="bg-white rounded h-25 p-4" style="width: 50%; margin:auto;">
        <center><h1>Editar Roles, Menus y Submenús</h1></center>

        <form method="POST">
            <div class="form-floating mb-3">
                <select class="form-select" aria-label="Default select example" name="fk_usuario" id="fk_usuario">
                    <option value="">Seleccione un Usuario</option>
                    <?php
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
                    if ($rol_usuario) {
                        echo "<option value='" . $rol_usuario['rol_usuario'] . "' selected>" . $rol_usuario['nombre_rol'] . "</option>";
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
                        // Verificar si el menú está asignado al usuario
                        $checked = false;
                        foreach ($menus_submenus_usuario as $item) {
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

                    foreach ($menus as $menu) {
                        // Obtener submenús para el menú actual
                        $submenus = $SubmenusController->verSubmenusPorMenu($menu['id']); // Cambiar a tu método para obtener submenús por menú

                        foreach ($submenus as $submenu) {
                            // Verificar si el submenú está asignado al usuario
                            $checked = false;
                            foreach ($menus_submenus_usuario as $item) {
                                if ($item['submenu_id'] == $submenu['submenu_id'] && $item['menu_id'] == $menu['id']) {
                                    $checked = true;
                                    break;
                                }
                            }
                            echo "<div class='form-check form-check-inline submenu-item' data-menu='" . $submenu['fk_menu'] . "' style='display: none;'>";
                            echo "<input class='form-check-input' type='checkbox' name='fk_submenu[]' value='" . $submenu['submenu_id'] . "' " . ($checked ? 'checked' : '') . ">";
                            echo "<label class='form-check-label'>" . $submenu['nombre'] . "</label>";
                            echo "</div>";
                        }
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
// Función para mostrar/ocultar submenús según los menús seleccionados
function toggleSubmenuVisibility() {
    var menuCheckboxes = document.querySelectorAll('.menu-item input[type="checkbox"]');
    var submenuContainer = document.getElementById('submenu-container');
    var submenuItems = document.querySelectorAll('.submenu-item');

    var selectedMenus = Array.from(menuCheckboxes)
        .filter(function(cb) { return cb.checked; })
        .map(function(cb) { return cb.getAttribute('data-menu'); });

    submenuItems.forEach(function(item) {
        var itemMenu = item.getAttribute('data-menu');
        item.style.display = selectedMenus.includes(itemMenu) ? 'inline-block' : 'none';
    });

    submenuContainer.style.display = selectedMenus.length > 0 ? 'block' : 'none';
}

// Agregar evento de cambio a los checkboxes de menú
var menuCheckboxes = document.querySelectorAll('.menu-item input[type="checkbox"]');
menuCheckboxes.forEach(function(checkbox) {
    checkbox.addEventListener('change', toggleSubmenuVisibility);
});

// Llamar a la función al cargar la página para establecer el estado inicial de los submenús
toggleSubmenuVisibility();
</script>

</body>
</html>