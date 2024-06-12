<?php
require_once '../modelo/Roles.php';

class RolesController {
    private $rolesModelo;

    public function __construct() {
        $conexion = new Conexion();
        $this->rolesModelo = new Roles($conexion->Conectar());
    }
    
    public function crear($nombre, $valor, $descripcion, $fk_cargo) {
        if ($this->rolesModelo->verificarRolExistente($nombre)) {
            echo "<script>
            swal({
               title: 'Error',
               text: 'El Rol ya existe.',
               icon: 'error',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'RolesCrear.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        } else {
            $this->rolesModelo->crearRol($nombre, '1', $valor, $descripcion, $fk_cargo);
            /* var_dump($nombre, $estatus, $valor, $descripcion ); */
             echo "<script>
             swal({
                title: 'Completado',
                text: 'Rol creado correctamente.',
                icon: 'success',
             }).then((willRedirect) => {
                if (willRedirect) {
                   window.location.href = 'RolesIndex.php'; // Redirige a tu página PHP
                }
             });
          </script>";
            exit;
        }
    }

    public function eliminar($id) {
        $this->rolesModelo->eliminarRol($id);
        echo "<script>
        swal({
           title: 'Completado',
           text: 'Rol eliminado correctamente.',
           icon: 'success',
        }).then((willRedirect) => {
           if (willRedirect) {
              window.location.href = 'RolesIndex.php'; // Redirige a tu página PHP
           }
        });
     </script>";
        exit;
        // Puedes agregar lógica adicional después de eliminar el rol si es necesario
    }
    
    public function modificar($id,$nombre, $estatus, $valor, $descripcion, $fk_cargo) {
        $this->rolesModelo->modificarRol($id,$nombre, $estatus, $valor, $descripcion, $fk_cargo);
        echo "<script>
        swal({
            title: 'Completado',
            text: 'Rol modificado correctamente.',
            icon: 'success',
        }).then((willRedirect) => {
            if (willRedirect) {
            window.location.href = 'RolesIndex.php'; // Redirige a tu página PHP
            }
        });
        </script>";
        // Puedes agregar lógica adicional después de modificar el rol si es necesario
    }
    
    public function verTodos() {
        return $this->rolesModelo->verTodosRol();
    }
    
    public function verPorId($id) {
        return $this->rolesModelo->verRolPorId($id);
    }

    public function buscarPorNombre($nombre) {
        return $this->rolesModelo->buscarRolPorNombre($nombre);
    }

    public function verificarRolExistente($nombre) {
        return $this->rolesModelo->verificarRolExistente($nombre);
    }

    public function obtenerRolesMenusSubmenus() {
        $rolesMenusSubmenus = $this->rolesModelo->obtenerRolesMenusSubmenus();
        return $rolesMenusSubmenus;
    }

        public function obtenerMenusSubMenusPorRol($rol_id) {
        $rolesMenusSubmenus = $this->rolesModelo->obtenerMenusSubMenusPorRol($rol_id);
        return $rolesMenusSubmenus;
    }
    public function crearRolMenu($fk_rol, $fk_menu, $fk_submenu) {
        // Insertar en la tabla roles_menu
        $resultado = $this->rolesModelo->crearRolMenu($fk_rol, $fk_menu, $fk_submenu);
    
        if ($resultado) {
            echo "<script>
                swal({
                    title: 'Completado',
                    text: 'Asignación de rol, menú y submenu realizada correctamente.',
                    icon: 'success',
                }).then((willRedirect) => {
                    if (willRedirect) {
                        window.location.href = 'RolesIndex.php';
                    }
                });
            </script>";
            return true;
        } else {
            echo "<script>
                swal({
                    title: 'Error',
                    text: 'Hubo un error al asignar el rol, menú y submenu.',
                    icon: 'error',
                }).then((willRedirect) => {
                    if (willRedirect) {
                        window.location.href = 'RolesIndex.php';
                    }
                });
            </script>";
            return false;
        }
    }

    public function actualizarMenusSubMenusPorRol($rol_id, $fk_menus, $fk_submenus) {
        $resultado = $this->rolesModelo->actualizarMenusSubMenusPorRol($rol_id, $fk_menus, $fk_submenus);
            // Llamar al modelo para actualizar los menús y submenús
            if ($resultado) {
                echo "<script>
                    swal({
                        title: 'Completado',
                        text: 'Asignación de rol, menú y submenu realizada correctamente.',
                        icon: 'success',
                    }).then((willRedirect) => {
                        if (willRedirect) {
                            window.location.href = 'RolesIndex.php';
                        }
                    });
                </script>";
                return true;
            } else {
                echo "<script>
                    swal({
                        title: 'Error',
                        text: 'Hubo un error al asignar el rol, menú y submenu.',
                        icon: 'error',
                    }).then((willRedirect) => {
                        if (willRedirect) {
                            window.location.href = 'RolesIndex.php';
                        }
                    });
                </script>";
                return false;
            }
    }
    

    
    public function obtenerMenusSubMenusUsuario($rol_id) {
        $menus_submenus = $this->rolesModelo->obtenerMenusSubMenusPorRol($rol_id);
        return $menus_submenus;
    }
    
    
    
}

