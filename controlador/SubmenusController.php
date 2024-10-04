<?php
require_once '../modelo/Submenus.php';

class SubmenusController {
    private $submenusModelo;

    public function __construct() {
        $conexion = new Conexion();
        $this->submenusModelo = new Submenus($conexion->Conectar());
    }
    
    public function crear($nombre, $url, $icono, $orden, $fk_menus) {
      $urlFormato = ''."$url".'Index.php'; // Formato del icono
      $iconoFormato = '<i class= "fa-solid fa-'."$icono".' ms-4 me-4"></i>'; // Formato del icono
        if ($this->submenusModelo->verificarSubmenusExistente($nombre)) {
            echo "<script>
            swal({
               title: 'Error',
               text: 'El Submenus ya existe.',
               icon: 'error',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'SubmenusCrear.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        } else {
            $this->submenusModelo->crearSubmenus($nombre, $urlFormato, $iconoFormato, $orden, $fk_menus);
            
            echo "<script>
            swal({
               title: 'Completado',
               text: 'Submenus creado correctamente.',
               icon: 'success',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'SubmenusIndex.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        }
    }

    public function eliminar($id) {
      
        $this->submenusModelo->eliminarSubmenus($id);
        echo "<script>
        swal({
           title: 'Completado',
           text: 'Submenu eliminado correctamente.',
           icon: 'success',
        }).then((willRedirect) => {
           if (willRedirect) {
              window.location.href = 'SubmenusIndex.php'; // Redirige a tu página PHP
           }
        });
     </script>";
        exit;
        // Puedes agregar lógica adicional después de eliminar el Submenus si es necesario
    }
    
    public function modificar($id, $nombre, $url, $icono, $orden, $fk_menus) {
      $urlFormato = ''."$url".'Index.php'; // Formato del icono
      $iconoFormato = '<i class= "fa-solid fa-'."$icono".' ms-4 me-4"></i>'; // Formato del icono
        $this->submenusModelo->modificarSubmenus($id, $nombre, $urlFormato, $iconoFormato, $orden, $fk_menus);
        echo "<script>
        swal({
           title: 'Completado',
           text: 'Submenus modificado correctamente.',
           icon: 'success',
        }).then((willRedirect) => {
           if (willRedirect) {
              window.location.href = 'SubmenusIndex.php'; // Redirige a tu página PHP
           }
        });
     </script>";
        
        // Puedes agregar lógica adicional después de modificar el Submenus si es necesario
    }
    
    public function verTodos() {
        return $this->submenusModelo->verTodosSubmenus();
    }
    
    public function verPorId($id) {
        return $this->submenusModelo->verSubmenusPorId($id);
    }

    public function verSubmenusPorMenu($menu_id) {
      return $this->submenusModelo->verSubmenusPorMenu($menu_id);
   }

   public function verSubmenusPorMenus() {
      return $this->submenusModelo->verSubmenusPorMenus();
   }

    public function buscarPorNombre($nombre) {
        return $this->submenusModelo->buscarSubmenusPorNombre($nombre);
    }

    public function verificarSubmenusExistente($nombre) {
        return $this->submenusModelo->verificarSubmenusExistente($nombre);
    }
}

