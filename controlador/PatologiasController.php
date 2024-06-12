<?php
require_once '../modelo/Patologias.php';

class PatologiasController {
    private $patologiasModelo;

    public function __construct() {
        $conexion = new Conexion();
        $this->patologiasModelo = new Patologias($conexion->Conectar());
    }
    
    public function crear($nombre, $estatus, $valor, $descripcion) {
        if ($this->patologiasModelo->verificarPatologiasExistente($nombre)) {
            echo "<script>
            swal({
               title: 'Error',
               text: 'La Patologias ya existe.')</',
               icon: 'error',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'PatologiasCrear.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        } else {
            $this->patologiasModelo->crearPatologia($nombre, $estatus, $valor, $descripcion);
            
            echo "<script>
            swal({
               title: 'Completado',
               text: 'Patologia creada correctamente.',
               icon: 'success',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'PatologiasIndex.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        }
    }

    public function eliminar($id) {
        $this->patologiasModelo->eliminarPatologias($id);
        echo "<script>
        swal({
           title: 'Completado',
           text: 'Patologia eliminada correctamente.',
           icon: 'success',
        }).then((willRedirect) => {
           if (willRedirect) {
              window.location.href = 'PatologiasIndex.php'; // Redirige a tu página PHP
           }
        });
     </script>";
        exit;
        // Puedes agregar lógica adicional después de eliminar el Patologias si es necesario
    }
    
    public function modificar($id, $nombre, $estatus, $valor, $descripcion) {
        $this->patologiasModelo->modificarPatologias($id, $nombre, $estatus, $valor, $descripcion);
        echo "<script>
        swal({
           title: 'Completado',
           text: 'Patologia modificada correctamente.',
           icon: 'success',
        }).then((willRedirect) => {
           if (willRedirect) {
              window.location.href = 'PatologiasIndex.php'; // Redirige a tu página PHP
           }
        });
     </script>";
        // Puedes agregar lógica adicional después de modificar el Patologias si es necesario
    }
    
    public function verTodos() {
        return $this->patologiasModelo->verTodosPatologias();
    }
    
    public function verPorId($id) {
        return $this->patologiasModelo->verPatologiasPorId($id);
    }

    public function buscarPorNombre($nombre) {
        return $this->patologiasModelo->buscarPatologiasPorNombre($nombre);
    }

    public function verificarPatologiasExistente($nombre) {
        return $this->patologiasModelo->verificarPatologiasExistente($nombre);
    }
}

