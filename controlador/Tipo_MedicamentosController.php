<?php
require_once '../modelo/Tipo_Medicamentos.php';

class Tipo_MedicamentosController {
    private $tipo_medicamentosModelo;

    public function __construct() {
        $conexion = new Conexion();
        $this->tipo_medicamentosModelo = new Tipo_Medicamentos($conexion->Conectar());
    }
    
    public function crear($nombre, $descripcion) {
        if ($this->tipo_medicamentosModelo->verificarTipo_MedicamentosExistente($nombre)) {
            echo "<script>
            swal({
               title: 'Error',
               text: 'El Tipo_Medicamentos ya existe.',
               icon: 'error',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'Tipo_MedicamentosCrear.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        } else {
            $this->tipo_medicamentosModelo->crearTipo_Medicamentos($nombre, $descripcion);
            /* var_dump($nombre, $estatus, $valor, $descripcion ); */
             echo "<script>
             swal({
                title: 'Completado',
                text: 'Tipo_Medicamentos creado correctamente.',
                icon: 'success',
             }).then((willRedirect) => {
                if (willRedirect) {
                   window.location.href = 'Tipo_MedicamentosIndex.php'; // Redirige a tu página PHP
                }
             });
          </script>";
            exit;
        }
    }

    public function eliminar($id) {
        $this->tipo_medicamentosModelo->eliminarTipo_Medicamentos($id);
        echo "<script>
        swal({
           title: 'Completado',
           text: 'Tipo_Medicamentos eliminado correctamente.',
           icon: 'success',
        }).then((willRedirect) => {
           if (willRedirect) {
              window.location.href = 'Tipo_MedicamentosIndex.php'; // Redirige a tu página PHP
           }
        });
     </script>";
        exit;
        // Puedes agregar lógica adicional después de eliminar el Tipo_Medicamentos si es necesario
    }
    
    public function modificar($id,$nombre, $descripcion) {
        $this->tipo_medicamentosModelo->modificarTipo_Medicamentos($id,$nombre,$descripcion);
        echo "<script>
        swal({
            title: 'Completado',
            text: 'Tipo_Medicamentos modificado correctamente.',
            icon: 'success',
        }).then((willRedirect) => {
            if (willRedirect) {
            window.location.href = 'tipo_medicamentosIndex.php'; // Redirige a tu página PHP
            }
        });
        </script>";
        // Puedes agregar lógica adicional después de modificar el Tipo_Medicamentos si es necesario
    }
    
    public function verTodos() {
        return $this->tipo_medicamentosModelo->verTodosTipo_Medicamentos();
    }
    
    public function verPorId($id) {
        return $this->tipo_medicamentosModelo->verTipo_MedicamentosPorId($id);
    }

    public function buscarPorNombre($nombre) {
        return $this->tipo_medicamentosModelo->buscarTipo_MedicamentosPorNombre($nombre);
    }

    public function verificarTipo_MedicamentosExistente($nombre) {
        return $this->tipo_medicamentosModelo->verificarTipo_MedicamentosExistente($nombre);
    }

    
    
    
}

