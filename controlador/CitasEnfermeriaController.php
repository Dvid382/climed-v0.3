<?php
require_once '../modelo/CitasEnfermeria.php';

class CitasEnfermeriaController {
    private $citasEnfermeriaModelo;

    public function __construct() {
        $conexion = new Conexion();
        $this->citasEnfermeriaModelo = new CitasEnfermeria($conexion->Conectar());
    }

    public function crearCitaEnfermeria($altura, $peso, $tension, $fk_cita) {
        if ($this->citasEnfermeriaModelo->verificarCitaEnfermeriaExistentes($fk_cita)) {
            echo "<script>
            swal({
               title: 'Error',
               text: 'La cita ya existe.',
               icon: 'error',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'CitasEnfermeriaCrear.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        } else {
            if ($this->citasEnfermeriaModelo->crearCitaEnfermeria($altura, $peso, $tension, $fk_cita)) {
                echo "<script>
                swal({
                   title: 'Completado',
                   text: 'Cita creada correctamente.',
                   icon: 'success',
                }).then((willRedirect) => {
                   if (willRedirect) {
                      window.location.href = 'CitasEnfermeriaIndex.php'; // Redirige a tu página PHP
                   }
                });
             </script>";
                exit;
            } else {
                echo "<script>alert('Error al crear la cita.');</script>";
                exit;
            }
        }
    }

    public function VerCitasEnfermeria() {
        return $this->citasEnfermeriaModelo->verCitaEnfermeria();
    }
}