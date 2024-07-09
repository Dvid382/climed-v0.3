<?php
require_once '../modelo/CitasMedico.php';

class CitasMedicoController {
    private $citasmedicoModelo;

    public function __construct() {
        $conexion = new Conexion();
        $this->citasmedicoModelo = new CitasMedico($conexion->Conectar());
    }

    public function CrearHistoriaMedica( $diagnostico, $fk_patologia, $fk_laboratorio, $fk_cita_enfermeria, $receta, $f_inicio, $f_fin, $fk_medicamento, $descripcion, $f_inicio_evolucion, $f_fin_evolucion, $citaId) {
        if ($this->citasmedicoModelo->CrearHistoriaMedica($diagnostico, $fk_patologia, $fk_laboratorio,  $fk_cita_enfermeria, $receta, $f_inicio, $f_fin, $fk_medicamento, $descripcion, $f_inicio_evolucion, $f_fin_evolucion, $citaId)) {

                echo "<script>
                swal({
                   title: 'Completado',
                   text: 'Historia Medica creada correctamente.',
                   icon: 'success',
                }).then((willRedirect) => {
                   if (willRedirect) {
                      window.location.href = 'CitasMedicoIndex.php'; // Redirige a tu página PHP
                   }
                });
             </script>";
                exit;
            } else {
                echo "<script>alert('Error al crear la Historia Medica.');</script>";
                exit;
            }
        }

    public function verHistoriaMedica() {
        return $this->citasmedicoModelo->verHistoriaMedica();
    }
}