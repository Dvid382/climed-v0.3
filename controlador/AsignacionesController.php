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
            echo "<script>
            swal({
               title: 'Error',
               text: 'Asignaciones ya existe.',
               icon: 'error',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'AsignacionesCrear.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        } else {
            
            $this->asignacionesModelo->crearAsignacion($nombre, $estatus, $descripcion, $f_inicio, $f_fin, $fk_servicios, $fk_usuario);
            
            echo "<script>
            swal({
               title: 'Completado',
               text: 'Asignacion creada exitosamente.',
               icon: 'success',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'AsignacionesIndex.php'; // Redirige a tu página PHP
               }
            });
         </script>"; 
            exit;
        }
    }

    public function eliminarAsignacion($id) {
        $this->asignacionesModelo->eliminarAsignaciones($id);
        echo "<script>
        swal({
           title: 'Completado',
           text: 'Asignacion Cancelada correctamente.',
           icon: 'success',
        }).then((willRedirect) => {
           if (willRedirect) {
              window.location.href = 'AsignacionesIndex.php'; // Redirige a tu página PHP
           }
        });
     </script>"; 
        // Puedes agregar lógica adicional después de eliminar el Asignaciones si es necesario
    }
    
    public function modificarAsignaciones($id, $nombre, $estatus, $descripcion, $f_inicio, $f_fin, $fk_servicios, $fk_usuario) {
        $this->asignacionesModelo->modificarAsignaciones($id, $nombre, $estatus, $descripcion, $f_inicio, $f_fin, $fk_servicios, $fk_usuario);
            echo "<script>
            swal({
               title: 'Completado',
               text: 'Asignacion modificada correctamente.',
               icon: 'success',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'AsignacionesIndex.php'; // Redirige a tu página PHP
               }
            });
         </script>"; 
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

