<?php
require_once '../modelo/Asignaciones.php';
require_once '../modelo/Usuarios.php';
require_once 'UsuariosController.php';
require_once 'ServiciosController.php';
$usuarios = new Usuario();
class AsignacionesController {
    private $asignacionesModelo;
    private $usuariosModelo;

    

    public function __construct() {
        $conexion = new Conexion();
        $this->asignacionesModelo = new Asignaciones($conexion->Conectar());
        $this->usuariosModelo = new Usuario();
/*         $this->servicioModelo = new Servicios(); */
        
    }
    
    public function crearAsignacion($nombre, $estatus, $descripcion, $f_inicio, $f_fin, $fk_servicios, $fk_usuario) {
        if ($this->asignacionesModelo->verificarAsignacionesExistente($nombre)) {
            echo "<script> alert ('Error: el Asignaciones ya existe.')</script>";
            echo '<script language="javascript">window.location="AsignacionesCrear.php"</script>';
            exit;
        } else {
            
            $this->asignacionesModelo->crearAsignacion($nombre, $estatus, $descripcion, $f_inicio, $f_fin, $fk_servicios, $fk_usuario);
            
            $_SESSION['mensaje'] = "Asignaciones creado correctamente";
             echo "<script> alert ('Completado: Asignaciones creado correctamente.')</script>";
             echo '<script language="javascript">window.location="Inicio.php"</script>'; 
            exit;
        }
    }

    public function eliminar($id) {
        $this->asignacionesModelo->eliminarAsignaciones($id);
        echo "<script> alert ('Completado: Asignaciones Eliminado correctamente.')</script>";
        echo '<script language="javascript">window.location="Inicio.php"</script>';
        exit;
        // Puedes agregar lógica adicional después de eliminar el Asignaciones si es necesario
    }
    
    public function modificarAsignaciones($id, $nombre, $estatus, $descripcion, $f_inicio, $f_fin, $fk_servicios, $fk_usuario) {
        $this->asignacionesModelo->modificarAsignaciones($id, $nombre, $estatus, $descripcion, $f_inicio, $f_fin, $fk_servicios, $fk_usuario);
        echo "<script> alert ('Completado: Asignaciones modificado correctamente.')</script>";
        echo '<script language="javascript">window.location="Inicio.php"</script>';
        // Puedes agregar lógica adicional después de modificar el Asignaciones si es necesario
    }
    
    public function verTodos() {
        return $this->asignacionesModelo->verTodosAsignaciones();
    }
    
    public function verPorId($id) {
        return $this->asignacionesModelo->verAsignacionesPorId($id);
    }

    public function buscarPorNombre($nombre) {
        return $this->asignacionesModelo->buscarAsignacionesPorNombre($nombre);
    }

    public function obtenerAsignacionesUsuario($fk_usuario) {
        return $this->asignacionesModelo->obtenerAsignacionesUsuario($fk_usuario);
    }

    public function obtenerNombreServicioAsignacion($fk_usuario) {
        return $this->asignacionesModelo->obtenerNombreServicioAsignacion($fk_usuario);
    }


/*     public function buscarUsuarioPorNombre($nombre) {
        return $this->usuarioModelo->buscarUsuarioPorNombre($nombre);
    } */

    public function obtenerNombreApellidoPersonaAsignacion($fk_usuario) {
        return $this->asignacionesModelo->obtenerNombreApellidoPersonaAsignacion($fk_usuario);
    }
    
    

   
}

