<?php
require_once '../modelo/Laboratorios.php';

class LaboratoriosController {
    private $laboratoriosModelo;

    public function __construct() {
        $conexion = new Conexion();
        $this->laboratoriosModelo = new Laboratorios($conexion->Conectar());
    }
    
    public function crear($nombre, $estatus, $valor, $descripcion) {
        if ($this->laboratoriosModelo->verificarLaboratoriosExistente($nombre)) {
            echo "<script>
            swal({
               title: 'Error',
               text: 'El Laboratorios ya existe.',
               icon: 'error',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'LaboratoriosCrear.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        } else {
            $this->laboratoriosModelo->crearLaboratorio($nombre, $estatus, $valor, $descripcion);
            
            echo "<script>
            swal({
               title: 'Completado',
               text: 'Laboratorios creado correctamente',
               icon: 'success',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'LaboratoriosIndex.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        }
    }

    public function eliminar($id) {
        $this->laboratoriosModelo->eliminarLaboratorios($id);
        echo "<script>
        swal({
           title: 'Completado',
           text: 'Laboratorio eliminado correctamente',
           icon: 'success',
        }).then((willRedirect) => {
           if (willRedirect) {
              window.location.href = 'LaboratoriosIndex.php'; // Redirige a tu página PHP
           }
        });
     </script>";
        exit;
        // Puedes agregar lógica adicional después de eliminar el Laboratorios si es necesario
    }
    
    public function modificar($id, $nombre, $estatus, $valor, $descripcion) {
        $this->laboratoriosModelo->modificarLaboratorios($id, $nombre, $estatus, $valor, $descripcion);
        echo "<script>
        swal({
           title: 'Completado',
           text: 'Laboratorios modificado correctamente.',
           icon: 'success',
        }).then((willRedirect) => {
           if (willRedirect) {
              window.location.href = 'LaboratoriosIndex.php'; // Redirige a tu página PHP
           }
        });
     </script>";
        // Puedes agregar lógica adicional después de modificar el Laboratorios si es necesario
    }
    
    public function verTodos() {
        return $this->laboratoriosModelo->verTodosLaboratorios();
    }
    
    public function verPorId($id) {
        return $this->laboratoriosModelo->verLaboratoriosPorId($id);
    }

    public function buscarPorNombre($nombre) {
        return $this->laboratoriosModelo->buscarLaboratoriosPorNombre($nombre);
    }

    public function verificarLaboratoriosExistente($nombre) {
        return $this->laboratoriosModelo->verificarLaboratoriosExistente($nombre);
    }
}

