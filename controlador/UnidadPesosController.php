<?php
require_once '../modelo/UnidadPesos.php';

class UnidadPesosController {
    private $unidadpesosModelo;

    public function __construct() {
        $conexion = new Conexion();
        $this->unidadpesosModelo = new UnidadPesos($conexion->Conectar());
    }
    
    public function crear($nombre, $descripcion) {
        if ($this->unidadpesosModelo->verificarUnidadPesoExistente($nombre)) {
            echo "<script>
            swal({
               title: 'Error',
               text: 'El UnidadPeso ya existe.',
               icon: 'error',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'UnidadPesosCrear.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        } else {
            $this->unidadpesosModelo->crearUnidadPeso($nombre, $descripcion);
            /* var_dump($nombre, $estatus, $valor, $descripcion ); */
             echo "<script>
             swal({
                title: 'Completado',
                text: 'UnidadPeso creado correctamente.',
                icon: 'success',
             }).then((willRedirect) => {
                if (willRedirect) {
                   window.location.href = 'UnidadPesosIndex.php'; // Redirige a tu página PHP
                }
             });
          </script>";
            exit;
        }
    }

    public function eliminar($id) {
        $this->unidadpesosModelo->eliminarUnidadPeso($id);
        echo "<script>
        swal({
           title: 'Completado',
           text: 'UnidadPeso eliminado correctamente.',
           icon: 'success',
        }).then((willRedirect) => {
           if (willRedirect) {
              window.location.href = 'UnidadPesosIndex.php'; // Redirige a tu página PHP
           }
        });
     </script>";
        exit;
        // Puedes agregar lógica adicional después de eliminar el UnidadPeso si es necesario
    }
    
    public function modificar($id,$nombre, $descripcion) {
        $this->unidadpesosModelo->modificarUnidadPeso($id,$nombre,$descripcion);
        echo "<script>
        swal({
            title: 'Completado',
            text: 'UnidadPeso modificado correctamente.',
            icon: 'success',
        }).then((willRedirect) => {
            if (willRedirect) {
            window.location.href = 'UnidadPesosIndex.php'; // Redirige a tu página PHP
            }
        });
        </script>";
        // Puedes agregar lógica adicional después de modificar el UnidadPeso si es necesario
    }
    
    public function verTodos() {
        return $this->unidadpesosModelo->verTodosUnidadPeso();
    }
    
    public function verPorId($id) {
        return $this->unidadpesosModelo->verUnidadPesoPorId($id);
    }

    public function buscarPorNombre($nombre) {
        return $this->unidadpesosModelo->buscarUnidadPesoPorNombre($nombre);
    }

    public function verificarUnidadPesoExistente($nombre) {
        return $this->unidadpesosModelo->verificarUnidadPesoExistente($nombre);
    }

    
    
    
}

