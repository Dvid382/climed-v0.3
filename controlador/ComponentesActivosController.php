<?php
require_once '../modelo/ComponentesActivos.php';

class ComponentesActivosController {
    private $componentesactivosModelo;

    public function __construct() {
        $conexion = new Conexion();
        $this->componentesactivosModelo = new ComponentesActivos($conexion->Conectar());
    }
    
    public function crear($nombre, $descripcion) {
        if ($this->componentesactivosModelo->verificarComponenteActivoExistente($nombre)) {
            echo "<script>
            swal({
               title: 'Error',
               text: 'El ComponentesActivo ya existe.',
               icon: 'error',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'ComponentesActivosCrear.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        } else {
            $this->componentesactivosModelo->crearComponenteActivo($nombre, $descripcion);
            /* var_dump($nombre, $estatus, $valor, $descripcion ); */
             echo "<script>
             swal({
                title: 'Completado',
                text: 'ComponentesActivo creado correctamente.',
                icon: 'success',
             }).then((willRedirect) => {
                if (willRedirect) {
                   window.location.href = 'componentesactivosIndex.php'; // Redirige a tu página PHP
                }
             });
          </script>";
            exit;
        }
    }

    public function eliminar($id) {
        $this->componentesactivosModelo->eliminarComponenteActivo($id);
        echo "<script>
        swal({
           title: 'Completado',
           text: 'ComponentesActivo eliminado correctamente.',
           icon: 'success',
        }).then((willRedirect) => {
           if (willRedirect) {
              window.location.href = 'componentesactivosIndex.php'; // Redirige a tu página PHP
           }
        });
     </script>";
        exit;
        // Puedes agregar lógica adicional después de eliminar el ComponentesActivo si es necesario
    }
    
    public function modificar($id,$nombre, $descripcion) {
        $this->componentesactivosModelo->modificarComponenteActivo($id,$nombre,$descripcion);
        echo "<script>
        swal({
            title: 'Completado',
            text: 'ComponentesActivo modificado correctamente.',
            icon: 'success',
        }).then((willRedirect) => {
            if (willRedirect) {
            window.location.href = 'componentesactivosIndex.php'; // Redirige a tu página PHP
            }
        });
        </script>";
        // Puedes agregar lógica adicional después de modificar el ComponentesActivo si es necesario
    }
    
    public function verTodos() {
        return $this->componentesactivosModelo->verTodosComponenteActivo();
    }
    
    public function verPorId($id) {
        return $this->componentesactivosModelo->verComponenteActivoPorId($id);
    }

    public function buscarPorNombre($nombre) {
        return $this->componentesactivosModelo->buscarComponentesActivoPorNombre($nombre);
    }

    public function verificarComponenteActivoExistente($nombre) {
        return $this->componentesactivosModelo->verificarComponenteActivoExistente($nombre);
    }

    
    
    
}

