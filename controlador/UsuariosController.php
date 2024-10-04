<?php
require_once '../config/Conexion.php';
require_once '../modelo/Usuarios.php';
require_once 'RolesController.php';
require_once 'PersonasController.php';
require_once 'ServiciosController.php';
/*session_start();*/
class UsuariosController extends RolesController {
    private $usuariosModelo;
    private $rolesModelo;

    public function __construct() {
        $conexion = new Conexion();
        $this->usuariosModelo = new Usuario($conexion->conectar());
    }

    public function crearUsuario($foto, $clave, $fk_rol, $fk_persona, $fk_servicio, $estatus) {
        if ($this->verificarUsuarioExistente($fk_persona)) {
            echo "<script>
            swal({
               title: 'Error',
               text: 'El Usuario ya existe.',
               icon: 'error',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'UsuariosCrear.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        }
    
        // Asignar valores al modelo
        $this->usuariosModelo->setId('id');
        $this->usuariosModelo->setFoto('foto');
        $this->usuariosModelo->setClave('clave');
        $this->usuariosModelo->setFk_rol('fk_rol');
        $this->usuariosModelo->setFK_Persona('fk_persona');
        $this->usuariosModelo->setFK_servicio('fk_servicio');
        $this->usuariosModelo->setEstatus('estatus');
    
        // Ruta de la carpeta de destino
        $carpetaDestino = '../vista/UsuariosFoto/';
    
        // Verificar si la carpeta de destino no existe, crearla
        if (!file_exists($carpetaDestino)) {
            mkdir($carpetaDestino, 0777, true);
        }
    
        // Mover la foto a la carpeta de destino
        $rutaFotoDestino = $carpetaDestino . basename($foto['name']);
        move_uploaded_file($foto['tmp_name'], $rutaFotoDestino);
    
        // Asignar la nueva ruta de la foto
        $this->usuariosModelo->setFoto($rutaFotoDestino);
    
        // Crear el usuario y obtener su ID
        if ($this->usuariosModelo->crearUsuario($rutaFotoDestino, $clave, $fk_rol, $fk_persona, $fk_servicio, $estatus)) {
            // Obtener el ID del usuario recién creado
            $usuario_id = $this->usuariosModelo->getLastInsertId();
    
            // Guardar los menús y submenús seleccionados
            if (isset($_POST['fk_menu']) && isset($_POST['fk_submenu'])) {
                foreach ($_POST['fk_menu'] as $menu_id) {
                    // Solo guardar los submenús que pertenecen al menú actual
                    foreach ($_POST['fk_submenu'] as $submenu_id) {
                        // Verificar si el submenú pertenece al menú actual antes de insertar
                        if ($this->usuariosModelo->verificarSubmenuPorMenu($menu_id, $submenu_id)) { 
                            if (!$this->usuariosModelo->asignarMenuUsuario($usuario_id, $menu_id, $submenu_id)) { 
                                // Manejar error si es necesario
                                echo "Error al asignar menú ID: {$menu_id} y submenú ID: {$submenu_id} al usuario ID: {$usuario_id}";
                            }
                        }
                    }
                }
            }
    
            echo "<script>
                swal({
                   title: 'Completado',
                   text: 'Usuario creado correctamente.',
                   icon: 'success',
                }).then((willRedirect) => {
                   if (willRedirect) {
                      window.location.href = 'UsuariosIndex.php'; // Redirige a tu página PHP
                   }
                });
             </script>";
             exit;
        } else {
            echo "<script>
                swal({
                   title: 'Error',
                   text: 'Error al crear el usuario.',
                   icon: 'error',
                }).then((willRedirect) => {
                   if (willRedirect) {
                      window.location.href = 'UsuariosCrear.php'; // Redirige a tu página PHP
                   }
                });
             </script>";
             exit;
         }
    }
    public function eliminarUsuario($id) {
        $this->usuariosModelo->eliminarUsuario($id);
        echo "<script>
        swal({
           title: 'Completado',
           text: 'Usuario eliminado correctamente.',
           icon: 'success',
        }).then((willRedirect) => {
           if (willRedirect) {
              window.location.href = 'UsuariosIndex.php'; // Redirige a tu página PHP
           }
        });
     </script>";
        // Puedes agregar lógica adicional después de eliminar el Asignaciones si es necesario
    }
    
    public function modificarUsuario($id, $foto, $clave, $fk_rol, $fk_persona, $fk_servicio, $estatus, $fk_menus, $fk_submenus) {
        // Paso 1: Eliminar los menús y submenús actuales del usuario
        $this->usuariosModelo->eliminarMenusPorUsuario($id);
    
        // Paso 2: Asignar valores al modelo
        $this->usuariosModelo->setId($id);
        $this->usuariosModelo->setFoto($foto['name']); // Solo guardamos el nombre del archivo
        $this->usuariosModelo->setClave($clave);
        $this->usuariosModelo->setFK_Persona($fk_persona);
        $this->usuariosModelo->setFk_rol($fk_rol);
        $this->usuariosModelo->setFK_servicio($fk_servicio);
        $this->usuariosModelo->setEstado($estatus);
    
        // Ruta de la carpeta de destino
        $carpetaDestino = '../vista/UsuariosFoto/';
    
        // Verificar si la carpeta de destino no existe, crearla
        if (!file_exists($carpetaDestino)) {
            mkdir($carpetaDestino, 0777, true);
        }
    
        // Mover la foto a la carpeta de destino
        $rutaFotoDestino = $carpetaDestino . basename($foto['name']);
        move_uploaded_file($foto['tmp_name'], $rutaFotoDestino);
    
        // Actualizar la información del usuario en la base de datos
        if ($this->usuariosModelo->modificarUsuario($id, $rutaFotoDestino, $clave, $fk_rol, $fk_persona, $fk_servicio, $estatus)) {
            // Paso 3: Insertar los nuevos menús y submenús
            foreach ($fk_menus as $menu_id) {
                foreach ($fk_submenus as $submenu_id) {
                    // Verificar si el submenú pertenece al menú actual antes de insertar
                    if ($this->usuariosModelo->verificarSubmenuPorMenu($menu_id, $submenu_id)) {
                        if (!$this->usuariosModelo->asignarMenuUsuario($id, $menu_id, $submenu_id)) { 
                            echo "Error al asignar menú ID: {$menu_id} y submenú ID: {$submenu_id} al usuario ID: {$id}";
                        }
                    }
                }
            }
    
            echo "<script>
                swal({
                   title: 'Completado',
                   text: 'Usuario modificado correctamente.',
                   icon: 'success',
                }).then((willRedirect) => {
                   if (willRedirect) {
                      window.location.href = 'UsuariosIndex.php'; // Redirige a tu página PHP
                   }
                });
             </script>";
            exit;
        } else {
            echo "<script>
                swal({
                   title: 'Error',
                   text: 'No se pudo modificar el usuario.',
                   icon: 'error',
                }).then((willRedirect) => {
                   if (willRedirect) {
                      window.location.href = 'UsuariosCrear.php'; // Redirige a tu página PHP
                   }
                });
             </script>";
            exit;
        }
    }
    public function iniciarSesion($cedula, $clave) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cedula = ucfirst($_POST['cedula']);
            $clave = ucfirst($_POST['clave']);
    
            $usuario = $this->usuariosModelo->iniciarSesion($cedula, $clave);
            
            if ($usuario) {
                // Verificar el estado del usuario
                if ($usuario['estatus'] == '0') {
                    echo "<script>
                    swal({
                       title: 'Error',
                       text: 'Su Usuario se encuentra Inactivo, Comuniquese con un Administrador.',
                       icon: 'error',
                    }).then((willRedirect) => {
                       if (willRedirect) {
                          window.location.href = '../Index.php'; // Redirige a tu página PHP
                       }
                    });
                 </script>";
                } else {
                    // Guardar el nombre del usuario y su rol en las variables de sesión
                    $_SESSION['id_usuario'] = $usuario['id_usuario'];
                    $_SESSION['nombre'] = $usuario['nombre'];
                    $_SESSION['apellido'] = $usuario['apellido'];
                    $_SESSION['rol'] = $usuario['nombre_rol'];
                    $_SESSION['rol_id'] = $usuario['rol_id'];
                    $_SESSION['valor_rol'] = $usuario['valor_rol'];
                    $_SESSION['foto'] = $usuario['foto_usuario']; // Guardar la ruta completa de la imagen
    
                    // Redirigir al usuario a la página correspondiente
                    if ($usuario['valor_rol'] == true) {
                        header("Location: ../vista/Inicio.php");
                    }
                }
            } else {
                echo "<script>
                swal({
                   title: 'Error',
                   text: 'Usuario o Contraseña Incorrecta.',
                   icon: 'error',
                }).then((willRedirect) => {
                   if (willRedirect) {
                      window.location.href = '../Index.php'; // Redirige a tu página PHP
                   }
                });
             </script>";
            }
        }
    }

    
    public function controlarAcceso($archivo) {

    
            // Obtenemos el valor del rol del usuario actual
            $valor_rol = $_SESSION['valor_rol'];

            // Definimos los archivos a los que puede acceder cada rol
            $permisos = [
                1 => ['AsignacionesCrear', 'AsignacionesEditar', 'AsignacionesEliminar', 'AsignacionesIndex', 'CitasCrear', 'CitasEditar', 'CitasEliminar', 'CitasIndex', 'CitasVer', 'CitasEnfermeriaIndex',  'CitasEnfermeriaCrear',  'CitasEnfermeriaVer', 'CitasMedicoIndex', 'CitasMedicoVer', 'ConsultoriosCartel', 'ConsultoriosCrear', 'ConsultoriosEditar', 'ConsultoriosEliminar', 'ConsultoriosIndentificadores', 'ConsultoriosIndex', 'Error404', 'funcionPersona', 'Home', 'Inicio', 'menu', 'LaboratoriosCrear', 'LaboratoriosEditar', 'LaboratoriosEliminar', 'LaboratoriosIndex', 'PatologiasCrear', 'PatologiasEditar', 'PatologiasEliminar', 'PatologiasIndex', 'PersonasCrear', 'PersonasEditar', 'PersonasEliminar', 'PersonasIndex', 'PersonasVer', 'RolesCrear', 'RolesEditar', 'RolesEliminar', 'RolesIndex', 'RolesMenuCrear', 'RolesMenuEditar', 'ServiciosCrear', 'ServiciosEditar', 'ServiciosEliminar', 'ServiciosIndex', 'UsuariosCrear', 'UsuariosEditar', 'UsuariosEliminar', 'UsuariosIndex', 'UsuariosVer', 'UsuariosMenuCrear', 'CargosIndex', 'CargosCrear', 'CargosEditar', 'CargosEliminar', 'MenusIndex', 'MenusCrear', 'MenusEditar', 'MenusEliminar', 'SubmenusIndex', 'SubmenusEliminar', 'SubmenusCrear', 'SubmenusEditar', 'PacientesIndex', 'PacientesVer', 'Tipo_medicamentosIndex', 'Tipo_medicamentosCrear', 'Tipo_MedicamentosEditar', 'Tipo_MedicamentosEliminar', 'UnidadMedidasIndex', 'UnidadMedidasCrear', 'UnidadMedidasEditar', 'UnidadMedidasEliminar', 'UnidadPesosIndex', 'UnidadPesosCrear', 'UnidadPesosEditar', 'UnidadPesosEliminar', 'ComponentesActivosIndex', 'ComponentesActivosCrear', 'ComponentesActivosEditar', 'ComponentesActivosEliminar', 'MedicamentosIndex', 'MedicamentosCrear', 'MedicamentosEditar', 'MedicamentosEliminar','HistoriasMedicasIndex', 'HistoriasMedicasCrear', 'HistoriasMedicasVer', 'InsertarPersonaCitas', 'InsertarPersonaUsuario'],
                2 => ['AsignacionesCrear', 'AsignacionesEditar', 'AsignacionesEliminar', 'AsignacionesIndex', 'Error404', 'funcionPersona', 'Home', 'Inicio', 'menu', 'RolesCrear', 'RolesEditar', 'RolesEliminar', 'RolesIndex', 'RolesMenuCrear', 'RolesMenuEditar', 'ServiciosCrear', 'ServiciosEditar', 'ServiciosEliminar', 'ServiciosIndex', 'UsuariosCrear', 'UsuariosEditar', 'UsuariosEliminar', 'UsuariosIndex', 'UsuariosVer', 'CargosIndex', 'CargosCrear', 'CargosEditar', 'CargosEliminar', 'InsertarPersonaCitas', 'InsertarPersonaUsuario'],
                3 => ['CitasCrear', 'CitasEditar', 'CitasEliminar', 'CitasIndex', 'PacientesIndex', 'PacientesVer', 'ConsultoriosCartel', 'ConsultoriosCrear', 'ConsultoriosEditar', 'ConsultoriosEliminar', 'ConsultoriosIndentificadores', 'ConsultoriosIndex', 'Error404', 'funcionPersona', 'Home', 'Inicio', 'menu', 'LaboratoriosCrear', 'LaboratoriosEditar', 'LaboratoriosEliminar', 'LaboratoriosIndex', 'PatologiasCrear', 'PatologiasEditar', 'PatologiasEliminar', 'PatologiasIndex', 'PersonasCrear', 'PersonasEditar', 'PersonasEliminar', 'PersonasIndex', 'PersonasVer' , 'InsertarPersonaCitas', 'InsertarPersonaUsuario'],
                4 => ['Error404', 'funcionPersona', 'Home', 'Inicio', 'menu', 'LaboratoriosIndex', 'PatologiasIndex', 'MedicamentosIndex', 'MedicamentosCrear', 'MedicamentosEditar', 'MedicamentosEliminar',  'CitasMedicoIndex', 'CitasMedicoVer',  'CitasMedicoVer', 'PacientesIndex', 'PacientesVer','HistoriasMedicasIndex', 'HistoriasMedicasCrear', 'HistoriasMedicasVer'],
                5 => ['Error404', 'funcionPersona', 'Home', 'Inicio', 'menu', 'CitasEnfermeriaIndex', 'CitasEnfermeriaCrear', 'CitasEnfermeriaVer', 'PacientesIndex', 'Pacientes'],
            ];

        // Obtenemos el nombre del archivo actual sin la extensión
        $archivo_sin_ext = pathinfo($archivo, PATHINFO_FILENAME);

        // Verificamos si el usuario tiene permiso para acceder al archivo solicitado
        if (!in_array($archivo_sin_ext, $permisos[$valor_rol])) {
            // Si no tiene permiso, lo redirigimos al archivo error404
            header("Location: ../vista/Error.php");
            exit;
        }
    }

    public function Menu(){
        $menu = '';
    
        switch ($_SESSION['valor_rol']) {
            case '1':
                $menu = '../vista/menus/Administrador.php';
                break;
            case '2':
                $menu = '../vista/menus/Director.php';
                break;
            case '3':
                $menu = '../vista/menus/Analista.php';
                break;
            case '4':
                $menu = '../vista/menus/Medico.php';
                break;
            case '5':
                $menu = '../vista/menus/Asistencial.php';
                break;
            default:
                echo "<script>
                swal({
                   title: 'Error',
                   text: 'Rol de usuario no válido.',
                   icon: 'warning',
                }).then((willRedirect) => {
                   if (willRedirect) {
                      window.location.href = '../vista/Mantenimiento.php'; // Redirige a tu página PHP
                   }
                });
             </script>";
                exit;
        }
        
        include($menu);
    }

    //maneja el acceso a las vistas
    public function Vistas(){
        if (!isset($_SESSION['rol'])) {
            echo "<script>
            swal({
               title: 'Error',
               text: 'Usted debe iniciar sesión para acceder a esta página.',
               icon: 'warning',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = '../Index.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        }
        
        if ( $_SESSION['valor_rol']==false) {
            echo "<script>
            swal({
               title: 'Error',
               text: 'Usted no tiene permiso para acceder a esta página.',
               icon: 'warning',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'Home.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        
        }
    }

    public function cerrarSesion() {
        // Destruir todas las variables de sesión
        $_SESSION = array();
        
        // Finalmente, destruir la sesión
        session_destroy();
        
        // Redirigir a la página de inicio de sesión
        header("Location: ../Index.php");
    }

    public function verTodosUsuarios() {
        return $this->usuariosModelo->verTodosUsuarios();
    }

    public function verUsuarioPorId($id) {
        return $this->usuariosModelo->verUsuarioPorId($id);
    }
    
    public function buscarNombreRol($fk_rol) {
        return $this->usuariosModelo->buscarNombreRol($fk_rol);
    }
    
    public function buscarDatosPersonas($fk_persona) {
        return $this->usuariosModelo->buscarDatosPersonas($fk_persona);
    }
    
        public function buscarServiciosPersonas($fk_persona) {
        return $this->usuariosModelo->buscarServiciosPersonas($fk_persona);
    }

    public function buscarUsuarioPorNombre($nombre) {
        return $this->usuariosModelo->buscarUsuarioPorNombre($nombre);
    }

    public function verificarUsuarioExistente($fk_persona) {
        return $this->usuariosModelo->verificarUsuarioExistente($fk_persona);
    }

    public function buscarDatosUsuarios($usuario_id) {
        return $this->usuariosModelo->buscarDatosUsuarios($usuario_id);
    }
/*  

    public function buscarServiciosUsuarios($fk_usuario) {
        return $this->usuariosModelo->buscarServiciosUsuarios($fk_usuario);
    }

    public function obtenerUsuariosPorServicio($fk_usuario) {
        return $this->usuariosModelo->obtenerUsuariosPorServicio($fk_usuario);
    } */

        public function verTodosAsignacion() {
        return $this->usuariosModelo->verTodosAsignacion();
    }
        public function verDatosUsuarioPorId($id) {
        return $this->usuariosModelo->verDatosUsuarioPorId($id);
    }
    public function obtenerDatosPorServicio($idServicio)
    {
        $usuarios = $this->usuariosModelo->obtenerDatosPorServicio($idServicio);
        header('Content-Type: application/json');
        echo json_encode($usuarios);
        exit;
    }

    public function obtenerMenuDinamico() {
        $fk_usuario = $_SESSION['id_usuario'];
        $menus_submenus  = $this->usuariosModelo->obtenerMenusSubMenusPorUsuario($fk_usuario);
        return $menus_submenus;
    }

    public function actualizarMenusPorUsuario($fk_usuario, $fk_menus, $fk_submenus) {
        // Paso 1: Obtener los menús y submenús actuales del usuario
        $menus_submenus_actuales = $this->usuariosModelo->obtenerMenusSubMenusPorUsuario($fk_usuario);
    
        // Crear arrays para facilitar la comparación
        $menus_actuales = [];
        $submenus_actuales = [];
    
        foreach ($menus_submenus_actuales as $item) {
            $menus_actuales[$item['menu_id']] = true; // Marcamos el menú como existente
            $submenus_actuales[$item['submenu_id']] = true; // Marcamos el submenú como existente
        }
    
        // Paso 2: Insertar o actualizar menús y submenús
        foreach ($fk_menus as $menu_id) {
            // Si el menú no existe, insertarlo
            if (!isset($menus_actuales[$menu_id])) {
                foreach ($fk_submenus as $submenu_id) {
                    // Verificar si el submenú pertenece al menú actual antes de insertar
                    if ($this->usuariosModelo->verificarSubmenuPorMenu($menu_id, $submenu_id)) {
                        if (!$this->usuariosModelo->asignarMenuUsuario($fk_usuario, $menu_id, $submenu_id)) { 
                            echo "Error al asignar menú ID: {$menu_id} y submenú ID: {$submenu_id} al usuario ID: {$fk_usuario}";
                        }
                    }
                }
            } else {
                // Si el menú ya existe, solo debemos verificar los submenús
                foreach ($fk_submenus as $submenu_id) {
                    if (!isset($submenus_actuales[$submenu_id])) {
                        // Si el submenú no existe, insertarlo
                        if ($this->usuariosModelo->verificarSubmenuPorMenu($menu_id, $submenu_id)) {
                            if (!$this->usuariosModelo->asignarMenuUsuario($fk_usuario, $menu_id, $submenu_id)) { 
                                echo "Error al asignar menú ID: {$menu_id} y submenú ID: {$submenu_id} al usuario ID: {$fk_usuario}";
                            }
                        }
                    }
                }
            }
        }
    
        // Paso 3: Eliminar menús y submenús que ya no están en la vista
        foreach ($menus_submenus_actuales as $item) {
            // Si el menú no está en la nueva lista de menús
            if (!in_array($item['menu_id'], $fk_menus)) {
                // Eliminar todos los submenús asociados a este menú
                foreach ($submenus_actuales as $submenu_id => $_) {
                    // Aquí debes agregar la lógica para eliminar la relación en menu_usuario
                    if (!$this->usuariosModelo->eliminarMenuUsuario($fk_usuario, $item['menu_id'], $submenu_id)) {
                        echo "Error al eliminar menú ID: {$item['menu_id']} y submenú ID: {$submenu_id} del usuario ID: {$fk_usuario}";
                    }
                }
            } else {
                // Si el menú está presente, verificar si hay submenús que deben ser eliminados
                foreach ($submenus_actuales as $submenu_id => $_) {
                    if (!in_array($submenu_id, $fk_submenus)) {
                        // Eliminar solo el submenú que no está en la nueva lista de submenús
                        if (!$this->usuariosModelo->eliminarMenuUsuario($fk_usuario, $item['menu_id'], $submenu_id)) {
                            echo "Error al eliminar solo el submenú ID: {$submenu_id} del menú ID: {$item['menu_id']} del usuario ID: {$fk_usuario}";
                        }
                    }
                }
            }
        }
    
        echo "<script>
            swal({
               title: 'Completado',
               text: 'Menús actualizados correctamente.',
               icon: 'success',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'UsuariosIndex.php'; // Redirige a tu página PHP
               }
            });
         </script>";
    }
}
include('../dist/Plantilla.php');