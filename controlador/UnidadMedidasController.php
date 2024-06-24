<?php
require_once '../modelo/UnidadMedidas.php';

class UnidadMedidasController {
    private $unidadmedidasModelo;

    public function __construct() {
        $conexion = new Conexion();
        $this->unidadmedidasModelo = new UnidadMedidas($conexion->Conectar());
    }
    
    public function crear($nombre, $descripcion) {
        if ($this->unidadmedidasModelo->verificarUnidadMedidaExistente($nombre)) {
            echo "<script>
            swal({
               title: 'Error',
               text: 'El UnidadMedida ya existe.',
               icon: 'error',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'UnidadMedidasCrear.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        } else {
            $this->unidadmedidasModelo->crearUnidadMedida($nombre, $descripcion);
            /* var_dump($nombre, $estatus, $valor, $descripcion ); */
             echo "<script>
             swal({
                title: 'Completado',
                text: 'UnidadMedida creado correctamente.',
                icon: 'success',
             }).then((willRedirect) => {
                if (willRedirect) {
                   window.location.href = 'UnidadMedidasIndex.php'; // Redirige a tu página PHP
                }
             });
          </script>";
            exit;
        }
    }

    public function eliminar($id) {
        $this->unidadmedidasModelo->eliminarUnidadMedida($id);
        echo "<script>
        swal({
           title: 'Completado',
           text: 'UnidadMedida eliminado correctamente.',
           icon: 'success',
        }).then((willRedirect) => {
           if (willRedirect) {
              window.location.href = 'UnidadMedidasIndex.php'; // Redirige a tu página PHP
           }
        });
     </script>";
        exit;
        // Puedes agregar lógica adicional después de eliminar el UnidadMedida si es necesario
    }
    
    public function modificar($id,$nombre, $descripcion) {
        $this->unidadmedidasModelo->modificarUnidadMedida($id,$nombre,$descripcion);
        echo "<script>
        swal({
            title: 'Completado',
            text: 'UnidadMedida modificado correctamente.',
            icon: 'success',
        }).then((willRedirect) => {
            if (willRedirect) {
            window.location.href = 'UnidadMedidasIndex.php'; // Redirige a tu página PHP
            }
        });
        </script>";
        // Puedes agregar lógica adicional después de modificar el UnidadMedida si es necesario
    }
    
    public function verTodos() {
        return $this->unidadmedidasModelo->verTodosUnidadMedida();
    }
    
    public function verPorId($id) {
        return $this->unidadmedidasModelo->verUnidadMedidaPorId($id);
    }

    public function buscarPorNombre($nombre) {
        return $this->unidadmedidasModelo->buscarUnidadMedidaPorNombre($nombre);
    }

    public function verificarUnidadMedidaExistente($nombre) {
        return $this->unidadmedidasModelo->verificarUnidadMedidaExistente($nombre);
    }

    
    
    
}

