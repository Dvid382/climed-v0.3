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
            echo "<script> alert ('Error: el Usuario ya existe.')</script>";
            echo '<script language="javascript">window.location="UsuarioCrear.php"</script>';
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
           
            echo "<script> alert ('Completado: Usuario creado correctamente.')</script>";
            echo '<script language="javascript">window.location="Inicio.php"</script>';
            exit;
        } else {
            echo "<script> alert ('Error: Error al crear el usuario.')</script>";
            echo '<script language="javascript">window.location="UsuarioCrear.php"</script>';
            exit;
        }
    }
    
    
    public function eliminarUsuario($id) {
        if ($this->usuariosModelo->eliminarUsuario($id)) {
            echo "<script> alert ('Completado: Usuario eliminado correctamente.')</script>";
            echo '<script language="javascript">window.location="Inicio.php"</script>';
            exit;
        } else {
             echo "<script> alert ('Completado: Usuario eliminado correctamente.')</script>";
             echo '<script language="javascript">window.location="Inicio.php"</script>';
            exit;
        }
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
            echo "<script> alert ('Completado: Usuario modificado.')</script>";
            echo '<script language="javascript">window.location="Inicio.php"</script>';
            exit;
        } else {
            echo "<script> alert ('Error: No se pudo modificar el usuario.')</script>";
            echo '<script language="javascript">window.location="EditarUsuario.php?id=" . $id"</script>';
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
                    echo '<script language="javascript">window.location="../Inicio.php"</script>';
                } else {
                    // Guardar el nombre del usuario y su rol en las variables de sesión
                    $_SESSION['id_usuario'] = $usuario['id_usuario'];
                    $_SESSION['nombre'] = $usuario['nombre'];
                    $_SESSION['apellido'] = $usuario['apellido'];
                    $_SESSION['rol'] = $usuario['nombre_rol'];
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
                1 => ['AsignacionesCrear', 'AsignacionesEditar', 'AsignacionesEliminar', 'AsignacionesIndex', 'CitasCrear', 'CitasEditar', 'CitasEliminar', 'CitasIndex', 'ConsultoriosCartel', 'ConsultoriosCrear', 'ConsultoriosEditar', 'ConsultoriosEliminar', 'ConsultoriosIndentificadores', 'ConsultoriosIndex', 'Error404', 'funcionPersona', 'Home', 'Inicio', 'menu', 'LaboratoriosCrear', 'LaboratoriosEditar', 'LaboratoriosEliminar', 'LaboratoriosIndex', 'PatologiasCrear', 'PatologiasEditar', 'PatologiasEliminar', 'PatologiasIndex', 'PersonasCrear', 'PersonasEditar', 'PersonasEliminar', 'PersonasIndex', 'RolesCrear', 'RolesEditar', 'RolesEliminar', 'RolesIndex', 'ServiciosCrear', 'ServiciosEditar', 'ServiciosEliminar', 'ServiciosIndex', 'UsuariosCrear', 'UsuariosEditar', 'UsuariosEliminar', 'UsuariosIndex'],
                2 => ['AsignacionesCrear', 'AsignacionesEditar', 'AsignacionesEliminar', 'AsignacionesIndex', 'Error404', 'funcionPersona', 'Home', 'Inicio', 'menu', 'RolesCrear', 'RolesEditar', 'RolesEliminar', 'RolesIndex', 'ServiciosCrear', 'ServiciosEditar', 'ServiciosEliminar', 'ServiciosIndex', 'UsuariosCrear', 'UsuariosEditar', 'UsuariosEliminar', 'UsuariosIndex'],
                3 => ['CitasCrear', 'CitasEditar', 'CitasEliminar', 'CitasIndex',  'ConsultoriosCartel', 'ConsultoriosCrear', 'ConsultoriosEditar', 'ConsultoriosEliminar', 'ConsultoriosIndentificadores', 'ConsultoriosIndex', 'Error404', 'funcionPersona', 'Home', 'Inicio', 'menu', 'LaboratoriosCrear', 'LaboratoriosEditar', 'LaboratoriosEliminar', 'LaboratoriosIndex', 'PatologiasCrear', 'PatologiasEditar', 'PatologiasEliminar', 'PatologiasIndex', 'PersonasCrear', 'PersonasEditar', 'PersonasEliminar', 'PersonasIndex'],
                4 => ['Error404', 'funcionPersona', 'Home', 'Inicio', 'menu', 'LaboratoriosIndex', 'PatologiasIndex', 'MedicamentosIndex', 'HistoriasMedicasIdex'],
                5 => ['Error404', 'funcionPersona', 'Home', 'Inicio', 'menu', 'CitasEnfermeriaIndex'],
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
                echo "<script>alert('Rol de usuario no válido.'); window.location.href = '../vista/Mantenimiento.php';</script>";
                exit;
        }
        
        include($menu);
    }

    //maneja el acceso a las vistas
    public function Vistas(){
        if (!isset($_SESSION['rol'])) {
            echo "<script>alert('Usted debe iniciar sesión para acceder a esta página.'); window.location.href = '../Index.php';</script>";
            exit;
        }
        
        if ( $_SESSION['valor_rol']==false) {
            echo "<script>alert('Usted no tiene permiso para acceder a esta página.'); window.location.href = 'Home.php';</script>";
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

/*     public function buscarDatosUsuarios($fk_usuario) {
        return $this->usuariosModelo->buscarDatosUsuarios($fk_usuario);
    }

    public function buscarServiciosUsuarios($fk_usuario) {
        return $this->usuariosModelo->buscarServiciosUsuarios($fk_usuario);
    }

    public function obtenerUsuariosPorServicio($fk_usuario) {
        return $this->usuariosModelo->obtenerUsuariosPorServicio($fk_usuario);
    } */

        public function verTodosAsignacion() {
        return $this->usuariosModelo->verTodosAsignacion();
    }

    public function obtenerDatosPorServicio($idServicio)
    {
        $usuarios = $this->usuariosModelo->obtenerDatosPorServicio($idServicio);
        header('Content-Type: application/json');
        echo json_encode($usuarios);
        exit;
    }
}
