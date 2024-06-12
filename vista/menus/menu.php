<?php
require_once '../controlador/UsuariosController.php';
$controladorUsuario = new UsuariosController();
$menus_submenus = $controladorUsuario->obtenerMenuDinamico();

// Organizar los submenús por sus menús correspondientes y ordenarlos
$menus = [];
foreach ($menus_submenus as $item) {
    $menu_id = $item['menu_id'];
    $submenu_menu = $item['submenu_menu'];
    $submenu_id = $item['submenu_id'];
    $submenu_nombre = $item['submenu_nombre'];
    $submenu_icono = $item['submenu_icono'];
    $submenu_url = $item['submenu_url'];
    $submenu_orden = $item['submenu_orden'];

    if (!isset($menus[$menu_id])) {
        $menus[$menu_id] = [
            'menu_id' => $item['menu_id'],
            'menu_nombre' => $item['menu_nombre'],
            'menu_icono' => $item['menu_icono'],
            'menu_orden' => $item['menu_orden'],
            'submenus' => []
        ];
    }

    if ($submenu_menu == $menu_id) {
        $menus[$menu_id]['submenus'][$submenu_orden] = [
            'submenu_id' => $submenu_id,
            'submenu_nombre' => $submenu_nombre,
            'submenu_icono' => $submenu_icono,
            'submenu_url' => $submenu_url
        ];
    }
}

// Ordenar los menús y submenús por su orden
ksort($menus);
foreach ($menus as $menu_id => $menu) {
    ksort($menus[$menu_id]['submenus']);
}
?>

<div class="sidebar pe-5 pb-5 open">
    <nav class="navbar bg-light navbar-light">
        <!-- Contenido del encabezado del menú -->
        <a href="Inicio.php" class="navbar-brand mx-4 mb-3">
            <img class="d-flex align-items-center ms-4 mb-1" src="../dist/climed.jpg" width="60%" height="60%" style="border-radius: 70%;">
            <h3 class="text-primary d-flex align-items-center ms-4 mb-1">CLIMED</h3>
        </a>
        
        <div class="navbar-nav w-100">
        <a href="inicio.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <?php
            foreach ($menus as $menu) {
                echo "<div class='nav-item dropdown'>";
                    echo "<a href='#' class='nav-link dropdown-toggle' data-bs-toggle='dropdown'>". $menu['menu_icono'] ." " . $menu['menu_nombre'] . "</a>";
                        echo "<div class='dropdown-menu bg-transparent border-0'>";
                        
                        foreach ($menu['submenus'] as $submenu) {
                            echo "<a href='" . $submenu['submenu_url'] . "' class='dropdown-item'>". $submenu['submenu_icono'] . "  " . $submenu['submenu_nombre'] . "</a>";
                        }
                        
                        echo "</div>";
                echo "</div>";
            }
            ?>

            <a href="../controlador/cerrar_sesion.php" class="nav-item nav-link"><i class="fa fa-right-from-bracket me-2"></i>Cerrar sesión.</a>
        </div>
    </nav>
</div>
