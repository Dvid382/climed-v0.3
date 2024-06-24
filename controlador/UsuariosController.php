<?php
require_once '../config/Conexion.php';
require_once '../modelo/Usuarios.php';
require_once 'RolesController.php';
require_once 'PersonasController.php';
require_once 'ServiciosController.php';
/*session_start();*/
class UsuariosController extends RolesController {
    private $usuariosModelo;

    public function __construct() {
        $conexion = new Conexion();
        $this->usuariosModelo = new Usuario($conexion->conectar());
    }

    public function crearUsuario( $foto, $clave, $fk_persona, $fk_rol, $fk_servicio, $estatus) {
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
    
        $this->usuariosModelo->setId('id');
        $this->usuariosModelo->setFoto('foto');
        $this->usuariosModelo->setClave('clave');
        $this->usuariosModelo->setFK_Persona('fk_persona');
        $this->usuariosModelo->setFk_rol('fk_rol');
        $this->usuariosModelo->setFK_servicio('fk_servicio');
        $this->usuariosModelo->setEstatus('estatus');
    
        // Ruta de la carpeta de destino
        $carpetaDestino = '../vista/UsuariosFoto/';
    
        // Verificar si la carpeta de destino no existe, crearla
        if (!file_exists($carpetaDestino)) {
            mkdir($carpetaDestino, 0777, true);
        }
    
        // Mover la foto a la carpeta de destino
        $rutaFotoDestino = $carpetaDestino . $foto['name'];
        move_uploaded_file($foto['tmp_name'], $rutaFotoDestino);
    
        // Asignar la nueva ruta de la foto
        $this->usuariosModelo->setFoto($rutaFotoDestino);
    
        if ($this->usuariosModelo->crearUsuario( $rutaFotoDestino, $clave, $fk_persona, $fk_rol, $fk_servicio, $estatus)) {
           

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
    
    public function modificarUsuario($id, $foto, $clave, $fk_persona, $fk_rol, $fk_servicio, $estatus) {
    
        $this->usuariosModelo->setId('id');
        $this->usuariosModelo->setFoto('foto');
        $this->usuariosModelo->setClave('clave');
        $this->usuariosModelo->setFK_Persona('fk_persona');
        $this->usuariosModelo->setFk_rol('fk_rol');
        $this->usuariosModelo->setFK_servicio('fk_servicio');
        $this->usuariosModelo->setEstado('estatus');
    
        // Ruta de la carpeta de destino
        $carpetaDestino = '../vista/UsuariosFoto/';
    
        // Verificar si la carpeta de destino no existe, crearla
        if (!file_exists($carpetaDestino)) {
            mkdir($carpetaDestino, 0777, true);
        }
    
        // Mover la foto a la carpeta de destino
        $rutaFotoDestino = $carpetaDestino . $foto['name'];
        move_uploaded_file($foto['tmp_name'], $rutaFotoDestino);

        if ($this->usuariosModelo->modificarUsuario($id, $rutaFotoDestino, $clave, $fk_persona, $fk_rol, $fk_servicio, $estatus)) {

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
        var_dump($id, $rutaFotoDestino, $clave, $fk_rol, $fk_servicio, $estatus);
    }
    
    public function iniciarSesion($cedula, $clave) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cedula = ucfirst($_POST['cedula']);
            $clave = ucfirst($_POST['clave']);
    
            $usuario = $this->usuariosModelo->iniciarSesion($cedula, $clave);
            
            if ($usuario) {
                // Verificar el estado del usuario
                if ($usuario['estatus'] == '0') {
                    echo "<script> alert ('Error: Su usuario se encuentra inactivo.')</script>";
                    echo '<script language="javascript">window.location="../Index.php"</script>';
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
                 echo "<script> alert ('Error: Usuario o Contraseña incorrecta.')</script>";
                echo '<script language="javascript">window.location="../Index.php"</script>';
            }
        }
    }

    
    public function controlarAcceso($archivo) {

    
            // Obtenemos el valor del rol del usuario actual
            $valor_rol = $_SESSION['valor_rol'];

            // Definimos los archivos a los que puede acceder cada rol
            $permisos = [
                1 => ['AsignacionesCrear', 'AsignacionesEditar', 'AsignacionesEliminar', 'AsignacionesIndex', 'CitasCrear', 'CitasEditar', 'CitasEliminar', 'CitasIndex', 'CitasVer', 'CitasEnfermeriaIndex',  'CitasEnfermeriaCrear',  'CitasEnfermeriaVer', 'CitasMedicoIndex', 'CitasMedicoVer', 'ConsultoriosCartel', 'ConsultoriosCrear', 'ConsultoriosEditar', 'ConsultoriosEliminar', 'ConsultoriosIndentificadores', 'ConsultoriosIndex', 'Error404', 'funcionPersona', 'Home', 'Inicio', 'menu', 'LaboratoriosCrear', 'LaboratoriosEditar', 'LaboratoriosEliminar', 'LaboratoriosIndex', 'PatologiasCrear', 'PatologiasEditar', 'PatologiasEliminar', 'PatologiasIndex', 'PersonasCrear', 'PersonasEditar', 'PersonasEliminar', 'PersonasIndex', 'PersonasVer', 'RolesCrear', 'RolesEditar', 'RolesEliminar', 'RolesIndex', 'RolesMenuCrear', 'RolesMenuEditar', 'ServiciosCrear', 'ServiciosEditar', 'ServiciosEliminar', 'ServiciosIndex', 'UsuariosCrear', 'UsuariosEditar', 'UsuariosEliminar', 'UsuariosIndex', 'UsuariosVer', 'UsuariosMenuCrear', 'CargosIndex', 'CargosCrear', 'CargosEditar', 'CargosEliminar', 'MenusIndex', 'MenusCrear', 'MenusEditar', 'MenusEliminar', 'SubmenusIndex', 'SubmenusEliminar', 'SubmenusCrear', 'SubmenusEditar', 'PacientesIndex', 'Tipo_medicamentosIndex', 'Tipo_medicamentosCrear', 'Tipo_MedicamentosEditar', 'Tipo_MedicamentosEliminar', 'UnidadMedidasIndex', 'UnidadMedidasCrear', 'UnidadMedidasEditar', 'UnidadMedidasEliminar', 'UnidadPesosIndex', 'UnidadPesosCrear', 'UnidadPesosEditar', 'UnidadPesosEliminar', 'ComponentesActivosIndex', 'ComponentesActivosCrear', 'ComponentesActivosEditar', 'ComponentesActivosEliminar'],
                2 => ['AsignacionesCrear', 'AsignacionesEditar', 'AsignacionesEliminar', 'AsignacionesIndex', 'Error404', 'funcionPersona', 'Home', 'Inicio', 'menu', 'RolesCrear', 'RolesEditar', 'RolesEliminar', 'RolesIndex', 'RolesMenuCrear', 'RolesMenuEditar', 'ServiciosCrear', 'ServiciosEditar', 'ServiciosEliminar', 'ServiciosIndex', 'UsuariosCrear', 'UsuariosEditar', 'UsuariosEliminar', 'UsuariosIndex', 'UsuariosVer', 'CargosIndex', 'CargosCrear', 'CargosEditar', 'CargosEliminar'],
                3 => ['CitasCrear', 'CitasEditar', 'CitasEliminar', 'CitasIndex', 'PacientesIndex', 'ConsultoriosCartel', 'ConsultoriosCrear', 'ConsultoriosEditar', 'ConsultoriosEliminar', 'ConsultoriosIndentificadores', 'ConsultoriosIndex', 'Error404', 'funcionPersona', 'Home', 'Inicio', 'menu', 'LaboratoriosCrear', 'LaboratoriosEditar', 'LaboratoriosEliminar', 'LaboratoriosIndex', 'PatologiasCrear', 'PatologiasEditar', 'PatologiasEliminar', 'PatologiasIndex', 'PersonasCrear', 'PersonasEditar', 'PersonasEliminar', 'PersonasIndex', 'PersonasVer'],
                4 => ['Error404', 'funcionPersona', 'Home', 'Inicio', 'menu', 'LaboratoriosIndex', 'PatologiasIndex', 'MedicamentosIndex', 'HistoriasMedicasIdex',  'CitasMedicoIndex', 'CitasMedicoVer',  'CitasMedicoVer', 'PacientesIndex'],
                5 => ['Error404', 'funcionPersona', 'Home', 'Inicio', 'menu', 'CitasEnfermeriaIndex', 'CitasEnfermeriaCrear', 'CitasEnfermeriaVer', 'PacientesIndex'],
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
            echo "<script>alert('Usted debe iniciar sesión para acceder a esta página.'); window.location.href = '../Index.php';</script>";
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
            echo "<script>alert('Usted no tiene permiso para acceder a esta página.'); window.location.href = 'Home.php';</script>";
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

    public function verificarUsuarioExistente($nombre) {
        return $this->usuariosModelo->verificarUsuarioExistente($nombre);
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
    
/*     public function crearUsuarioMenu($fk_usuarios, $fk_roles_menu) {
        // Insertar en la tabla Usuarios_menu
        $resultado = $this->usuariosModelo->crearUsuarioMenu($fk_usuarios, $fk_roles_menu);
    
        if ($resultado) {
            echo "<script>
                swal({
                    title: 'Completado',
                    text: 'Asignación de Usuario, Menu realizada correctamente.',
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
                    text: 'Hubo un error al asignar el Usuario, Menu.',
                    icon: 'error',
                }).then((willRedirect) => {
                    if (willRedirect) {
                        window.location.href = 'RolesIndex.php';
                    }
                });
            </script>";
            return false;
        }
    } */

}
