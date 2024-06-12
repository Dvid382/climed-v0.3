<?php
require_once '../modelo/Servicios.php';

class ServiciosController {
    private $serviciosModelo;

    public function __construct() {
        $conexion = new Conexion();
        $this->serviciosModelo = new Servicios($conexion->Conectar());
    }
    
    public function crear($nombre, $estatus, $valor, $descripcion) {
        if ($this->serviciosModelo->verificarServiciosExistente($nombre)) {
            echo "<script>
            swal({
               title: 'Error',
               text: 'El servicios ya existe.',
               icon: 'error',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'ServiciosCrear.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        } else {
            $this->serviciosModelo->crearServicio($nombre, $estatus, $valor, $descripcion);
            
            echo "<script>
            swal({
               title: 'Completado',
               text: 'Servicio creado correctamente.',
               icon: 'success',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'ServiciosIndex.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        }
    }

    public function eliminar($id) {
        $this->serviciosModelo->eliminarServicios($id);
        echo "<script>
        swal({
           title: 'Completado',
           text: 'Servicio eliminado correctamente.',
           icon: 'success',
        }).then((willRedirect) => {
           if (willRedirect) {
              window.location.href = 'ServiciosIndex.php'; // Redirige a tu página PHP
           }
        });
     </script>";
        exit;
        // Puedes agregar lógica adicional después de eliminar el Servicios si es necesario
    }
    
    public function modificar($id, $nombre, $estatus, $valor, $descripcion) {
        $this->serviciosModelo->modificarServicios($id, $nombre, $estatus, $valor, $descripcion);
        echo "<script>
        swal({
           title: 'Completado',
           text: 'Servicio modificado correctamente.',
           icon: 'success',
        }).then((willRedirect) => {
           if (willRedirect) {
              window.location.href = 'ServiciosIndex.php'; // Redirige a tu página PHP
           }
        });
     </script>";
        
        // Puedes agregar lógica adicional después de modificar el Servicios si es necesario
    }
    
    public function verTodos() {
        return $this->serviciosModelo->verTodosServicios();
    }
    
    public function verPorId($id) {
        return $this->serviciosModelo->verServiciosPorId($id);
    }

    public function buscarPorNombre($nombre) {
        return $this->serviciosModelo->buscarServiciosPorNombre($nombre);
    }

    public function verificarServiciosExistente($nombre) {
        return $this->serviciosModelo->verificarServiciosExistente($nombre);
    }
}

