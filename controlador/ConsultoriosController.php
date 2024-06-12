<?php
require_once '../modelo/Consultorios.php';

class ConsultoriosController {
    private $consultoriosModelo;

    public function __construct() {
        $conexion = new Conexion();
        $this->consultoriosModelo = new Consultorios($conexion->Conectar());
    }
    
    public function crear($nombre, $descripcion, $estatus) {
        if ($this->consultoriosModelo->verificarConsultoriosExistente($nombre)) {
            echo "<script>
            swal({
               title: 'Error',
               text: 'El Consultorios ya existe.',
               icon: 'error',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'ConsultoriosCrear.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        } else {
            $this->consultoriosModelo->crearConsultorio($nombre, $descripcion, $estatus);

            echo "<script>
            swal({
               title: 'Completado',
               text: 'Consultorios creado correctamente.',
               icon: 'success',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'ConsultoriosIndex.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        }
    }

    public function eliminarConsultorio($id) {
        $this->consultoriosModelo->eliminarConsultorios($id);
        echo "<script>
        swal({
           title: 'Completado',
           text: 'Consultorio eliminado correctamente.',
           icon: 'success',
        }).then((willRedirect) => {
           if (willRedirect) {
              window.location.href = 'ConsultoriosIndex.php'; // Redirige a tu página PHP
           }
        });
     </script>";

        // Puedes agregar lógica adicional después de eliminar el Consultorios si es necesario
    }
    
    public function modificar($id, $nombre, $descripcion, $estatus) {
        $this->consultoriosModelo->modificarConsultorios($id, $nombre, $descripcion, $estatus);
        echo "<script>
        swal({
           title: 'Completado',
           text: 'Consultorios modificado correctamente.',
           icon: 'success',
        }).then((willRedirect) => {
           if (willRedirect) {
              window.location.href = 'ConsultoriosIndex.php'; // Redirige a tu página PHP
           }
        });
     </script>";
        // Puedes agregar lógica adicional después de modificar el Consultorios si es necesario
    }
    
    public function verTodos() {
        return $this->consultoriosModelo->verTodosConsultorios();
    }
    
    public function verPorId($id) {
        return $this->consultoriosModelo->verConsultoriosPorId($id);
    }

    public function buscarPorNombre($nombre) {
        return $this->consultoriosModelo->buscarConsultoriosPorNombre($nombre);
    }

    public function verificarConsultoriosExistente($nombre) {
        return $this->consultoriosModelo->verificarConsultoriosExistente($nombre);
    }
}

