<?php
require_once '../modelo/Cargos.php';

class CargosController {
    private $cargosModelo;

    public function __construct() {
        $conexion = new Conexion();
        $this->cargosModelo = new Cargos($conexion->Conectar());
    }
    
    public function crear($nombre, $descripcion, $fk_servicio) {
        if ($this->cargosModelo->verificarCargosExistente($nombre)) {
            echo "<script>
            swal({
               title: 'Error',
               text: 'El Cargos ya existe.',
               icon: 'error',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'CargosCrear.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        } else {
         $this->cargosModelo->crearCargos($nombre, $descripcion, '1', $fk_servicio);
            
            echo "<script>
            swal({
               title: 'Completado',
               text: 'Cargos creado correctamente',
               icon: 'success',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'CargosIndex.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        }
    }

    public function eliminarCargo($id) {
      $this->cargosModelo->eliminarCargos($id);
      echo "<script>
      swal({
         title: 'Completado',
         text: 'Cargo eliminado correctamente.',
         icon: 'success',
      }).then((willRedirect) => {
         if (willRedirect) {
            window.location.href = 'CargosIndex.php'; // Redirige a tu página PHP
         }
      });
   </script>"; 
      // Puedes agregar lógica adicional después de eliminar el Asignaciones si es necesario
  }
    
    public function modificar($id, $nombre, $descripcion, $estatus, $fk_servicio) {
        $this->cargosModelo->modificarCargos($id, $nombre, $descripcion, $estatus, $fk_servicio);
        echo "<script>
        swal({
           title: 'Completado',
           text: 'Cargos modificado correctamente.',
           icon: 'success',
        }).then((willRedirect) => {
           if (willRedirect) {
              window.location.href = 'CargosIndex.php'; // Redirige a tu página PHP
           }
        });
     </script>";
        // Puedes agregar lógica adicional después de modificar el Cargos si es necesario
    }
    
    public function verTodos() {
        return $this->cargosModelo->verTodosCargos();
    }
    
    public function verPorId($id) {
        return $this->cargosModelo->verCargosPorId($id);
    }

    public function buscarPorNombre($nombre) {
        return $this->cargosModelo->buscarCargosPorNombre($nombre);
    }

    public function verificarCargosExistente($nombre) {
        return $this->cargosModelo->verificarCargosExistente($nombre);
    }
}

