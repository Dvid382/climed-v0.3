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
            echo "<script> alert ('Error: el Laboratorios ya existe.')</script>";
            echo '<script language="javascript">window.location="CrearLaboratorios.php"</script>';
            exit;
        } else {
            $this->laboratoriosModelo->crearLaboratorio($nombre, $estatus, $valor, $descripcion);
            
            $_SESSION['mensaje'] = "Laboratorios creado correctamente";
             echo "<script> alert ('Completado: Laboratorios creado correctamente.')</script>";
            echo '<script language="javascript">window.location="Inicio.php"</script>';
            exit;
        }
    }

    public function eliminar($id) {
        $this->laboratoriosModelo->eliminarLaboratorios($id);
        echo "<script> alert ('Completado: Laboratorios Eliminado correctamente.')</script>";
        echo '<script language="javascript">window.location="Inicio.php"</script>';
        exit;
        // Puedes agregar lógica adicional después de eliminar el Laboratorios si es necesario
    }
    
    public function modificar($id, $nombre, $estatus, $valor, $descripcion) {
        $this->laboratoriosModelo->modificarLaboratorios($id, $nombre, $estatus, $valor, $descripcion);
        echo "<script> alert ('Completado: Laboratorios modificado correctamente.')</script>";
        echo '<script language="javascript">window.location="Inicio.php"</script>';
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

