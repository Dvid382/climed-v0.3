<?php
require_once '../modelo/HistoriasMedicas.php';

class HistoriasMedicasController {
    private $historiasmedicasModelo;

    public function __construct() {
        $conexion = new Conexion();
        $this->historiasmedicasModelo = new HistoriasMedicas($conexion->Conectar());
    }

    public function indexTodasHistoriasMedicas() {
        $citas = $this->historiasmedicasModelo->obtenerInformacionTodasHistoriasMedicas();
        return $citas;
    }
}