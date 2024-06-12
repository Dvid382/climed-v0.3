<?php
require_once '../modelo/Citas.php';

class CitasController {
    private $citasModelo;

    public function __construct() {
        $conexion = new Conexion();
        $this->citasModelo = new Citas($conexion->Conectar());
    }

    public function crearCitas($fk_persona, $fk_servicio, $fk_usuario, $fecha, $hora, $estatus, $fk_usuario_sesion, $fk_consultorio) {
        if ($this->citasModelo->verificarCitasExistentes($fk_persona, $fk_servicio, $fk_usuario, $fecha, $hora)) {
            echo "<script>
            swal({
               title: 'Error',
               text: 'La cita ya existe.',
               icon: 'error',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'CitasCrear.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        } else {
            if ($this->citasModelo->crearCitas($fk_persona, $fk_servicio, $fk_usuario, $fecha, $hora, $estatus, $fk_usuario_sesion, $fk_consultorio)) {
                echo "<script>
                swal({
                   title: 'Completado',
                   text: 'Cita creada correctamente.',
                   icon: 'success',
                }).then((willRedirect) => {
                   if (willRedirect) {
                      window.location.href = 'CitasIndex.php'; // Redirige a tu página PHP
                   }
                });
             </script>";
                exit;
            } else {
                echo "<script>alert('Error al crear la cita.');</script>";
/*                 echo '<script>window.location="CitasCrear.php";</script>'; */
                exit;
            }
        }
    }
    
    

    public function modificar($id, $fk_persona, $fk_servicio, $fk_usuario, $fecha, $hora, $estatus, $fk_usuario_sesion) {
        $this->citasModelo->modificarCitas($id, $fk_persona, $fk_servicio, $fk_usuario, $fecha, $hora, $estatus, $fk_usuario_sesion);
        echo "<script>
        swal({
           title: 'Completado',
           text: 'Cita modificada correctamente.',
           icon: 'success',
        }).then((willRedirect) => {
           if (willRedirect) {
              window.location.href = 'CitasIndex.php'; // Redirige a tu página PHP
           }
        });
     </script>";
        exit;
    }

    public function eliminar($id) {
        $this->citasModelo->eliminarCitas($id);
        echo "<script>
        swal({
           title: 'Completado',
           text: 'Cita eliminada correctamente.',
           icon: 'success',
        }).then((willRedirect) => {
           if (willRedirect) {
              window.location.href = 'CitasIndex.php'; // Redirige a tu página PHP
           }
        });
     </script>";
        exit;
        // Puedes agregar lógica adicional después de eliminar el Asignaciones si es necesario
    }

    public function index() {
        $citas = $this->citasModelo->obtenerInformacionCitas();
        return $citas;
    }

    public function verTodas() {
        return $this->citasModelo->verTodasCitas();
    }

    public function verPorId($id) {
        return $this->citasModelo->verCitasId($id);
    }

    public function verificarCitasExistentes($fk_persona, $fk_servicio, $fk_usuario, $fecha, $hora) {
        return $this->citasModelo->verificarCitasExistentes($fk_persona, $fk_servicio, $fk_usuario, $fecha, $hora);
    }


}