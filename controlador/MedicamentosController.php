<?php
require_once '../modelo/Medicamentos.php';

class MedicamentosController {
    private $medicamentosModelo;

    public function __construct() {
        $conexion = new Conexion();
        $this->medicamentosModelo = new Medicamentos($conexion->Conectar());
    }
    
    public function crear($nombre_comercial, $descripcion, $cantidad, $fk_componentesactivos, $fk_tipo_medicamento, $fk_unidadmedida, $fk_unidadpeso) {
        if ($this->medicamentosModelo->verificarMedicamentosExistente($nombre_comercial)) {
            echo "<script>
            swal({
               title: 'Error',
               text: 'El Medicamentos ya existe.',
               icon: 'error',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'MedicamentosCrear.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        } else {
         $this->medicamentosModelo->crearMedicamentos($nombre_comercial, $descripcion, $cantidad, $fk_componentesactivos, $fk_tipo_medicamento, $fk_unidadmedida, $fk_unidadpeso);
            
            echo "<script>
            swal({
               title: 'Completado',
               text: 'Medicamentos creado correctamente',
               icon: 'success',
            }).then((willRedirect) => {
               if (willRedirect) {
                   window.location.href = 'MedicamentosIndex.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        }
    }

    public function eliminarMedicamentos($id) {
      $this->medicamentosModelo->eliminarMedicamentos($id);
      echo "<script>
      swal({
         title: 'Completado',
         text: 'medicamento eliminado correctamente.',
         icon: 'success',
      }).then((willRedirect) => {
         if (willRedirect) {
            window.location.href = 'MedicamentosIndex.php'; // Redirige a tu página PHP
         }
      });
   </script>"; 
      // Puedes agregar lógica adicional después de eliminar el Asignaciones si es necesario
  }
    
    public function modificar($id, $nombre_comercial, $descripcion, $cantidad, $fk_componentesactivos, $fk_tipo_medicamento, $fk_unidadmedida, $fk_unidadpeso) {
        $this->medicamentosModelo->modificarMedicamentos($id, $nombre_comercial, $descripcion, $cantidad, $fk_componentesactivos, $fk_tipo_medicamento, $fk_unidadmedida, $fk_unidadpeso);
        echo "<script>
        swal({
           title: 'Completado',
           text: 'Medicamentos modificado correctamente.',
           icon: 'success',
        }).then((willRedirect) => {
           if (willRedirect) {
              window.location.href = 'MedicamentosIndex.php'; // Redirige a tu página PHP
           }
        });
     </script>";
        // Puedes agregar lógica adicional después de modificar el Medicamentos si es necesario
    }
    
    public function verTodos() {
        return $this->medicamentosModelo->verTodosMedicamentos();
    }
    
    public function verPorId($id) {
        return $this->medicamentosModelo->verMedicamentosPorId($id);
    }

    public function buscarPorNombre($nombre) {
        return $this->medicamentosModelo->buscarMedicamentosPorNombre($nombre);
    }

    public function verificarMedicamentosExistente($nombre) {
        return $this->medicamentosModelo->verificarMedicamentosExistente($nombre);
    }
}

