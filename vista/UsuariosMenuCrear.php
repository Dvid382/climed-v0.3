<?php
require_once '../controlador/UsuariosController.php';
$controladorUsuario = new UsuariosController();
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


            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $fk_rol = ucfirst($_POST['fk_usuarios']);
                $fk_menus = $_POST('fk_roles_menu');
                
                        $resultado = $controladorUsuario->crearUsuarioMenu($fk_usuarios, $fk_roles_menu);
            }            
            
        ?>

    <div class="container-fluid pt-4 px-4">

        <!-- Formulario para seleccionar el rol y asignar el menu y submenus -->
        <div class="bg-white rounded h-25 p-4" style="width: 50%; margin:auto;">
            <center><h1>Asignar Usuario, Menu</h1></center>

            <form method="POST">
                <div class="form-floating mb-3">
                    <select class="form-select" aria-label="Default select example" name="fk_rol" id="fk_rol">
                        <option value="">Seleccione un Rol</option>
                        <?php
                            foreach ($rolesMenusSubmenus as $rol) {
                                echo "<option value='" . $rol['id'] . "'>" . $rol['nombre'] . "</option>";
                            }
                        ?>
                    </select>
                    <label class="form-label " for="rol">Rol:</label>
                </div>

                <div class="form-floating mb-3">
                    <div class="form-check">
                        <?php
                        require_once '../controlador/MenusController.php';
                        $MenusController = new MenusController();
                        $menus = $MenusController->verTodos();

                        foreach ($menus as $menu) {
                            echo "<div class='form-check form-check-inline menu-item'>";
                            echo "<input class='form-check-input' type='checkbox' name='fk_menu[]' value='" . $menu['id'] . "' data-menu='" . $menu['id'] . "'>";
                            echo "<label class='form-check-label'>" . $menu['nombre'] . "</label>";
                            echo "</div>";
                        }
                        ?>
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <div class="form-check" id="submenu-container" style="display: none;">
                        <?php
                        require_once '../controlador/SubmenusController.php';
                        $SubmenusController = new SubmenusController();
                        $submenus = $SubmenusController->verSubmenusPorMenus();

                        foreach ($submenus as $submenu) {
                            echo "<div class='form-check form-check-inline submenu-item' data-menu='" . $submenu['fk_menu'] . "' style='display: none;'>";
                            echo "<input class='form-check-input' type='checkbox' name='fk_submenu[]' value='" . $submenu['id_submenus'] . "'>";
                            echo "<label class='form-check-label'>" . $submenu['nombre'] . "</label>";
                            echo "</div>";
                        }
                        ?>
                    </div>
                </div>

                <div class="form-floating mb-3">
                        <button class="btn btn-outline-success" type="submit">Asignar. <i class="fa fa-check"></i></button>
                        <a class="btn btn-outline-info" href="RolesIndex.php">Volver <i class="fa fa-right-to-bracket"></i></a>
                </div>
            </div>




            </form>
        </div>    
    </div>

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
                
                // Ocultar todos los elementos de submenú
                submenuItems.forEach(function(item) {
                    item.style.display = 'none';
                });
                
                // Mostrar solo los elementos de submenú que pertenecen a los menús seleccionados
                submenuItems.forEach(function(item) {
                    var itemMenu = item.getAttribute('data-menu');
                    if (selectedMenus.includes(itemMenu)) {
                        item.style.display = 'inline-block';
                    }
                });
                
                // Mostrar el contenedor de submenús si hay elementos visibles
                var hasVisibleItems = Array.from(submenuItems).some(function(item) {
                    return item.style.display !== 'none';
                });
                
                submenuContainer.style.display = hasVisibleItems ? 'block' : 'none';
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
