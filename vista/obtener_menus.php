<?php
require_once '../controlador/RolesController.php';
$RolesController = new RolesController();

if (isset($_POST['rol_id'])) {
    $rol_id = $_POST['rol_id'];

    // Obtener menús y submenús asociados al rol
    $menus = $RolesController->obtenerMenusSubMenusPorRolUsuario($rol_id); // Asegúrate de tener este método en tu controlador

    if (!empty($menus)) {
        foreach ($menus as $menu) {
            echo "<div class='form-check'>";
            echo "<input class='form-check-input' type='checkbox' name='fk_menu[]' value='" . $menu['id'] . "' id='menu_" . $menu['id'] . "' checked>";
            echo "<label class='form-check-label' for='menu_" . $menu['id'] . "'>" . $menu['nombre'] . "</label>";
            echo "<div class='submenu-list'>"; // Contenedor para submenús

            // Mostrar submenús correspondientes a este menú
            if (!empty($menu['submenus'])) {
                foreach ($menu['submenus'] as $submenu) {
                    echo "<div class='form-check'>";
                    echo "<input class='form-check-input' type='checkbox' name='fk_submenu[]' value='" . $submenu['id'] . "' id='submenu_" . $submenu['id'] . "' checked>";
                    echo "<label class='form-check-label' for='submenu_" . $submenu['id'] . "'>" . $submenu['nombre'] . "</label>";
                    echo "</div>";
                }
            }
            echo "</div>"; // Cierre de submenu-list
            echo "</div>"; // Cierre de form-check
        }
    } else {
        echo "<p>No hay menús disponibles para este rol.</p>";
    }
}
?>