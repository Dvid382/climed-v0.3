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
            echo "<script> alert ('Error: el Patologias ya existe.')</script>";
            echo '<script language="javascript">window.location="CrearPatologias.php"</script>';
            exit;
        } else {
            $this->patologiasModelo->crearPatologia($nombre, $estatus, $valor, $descripcion);
            
            $_SESSION['mensaje'] = "Patologias creado correctamente";
             echo "<script> alert ('Completado: Patologias creado correctamente.')</script>";
            echo '<script language="javascript">window.location="Inicio.php"</script>';
            exit;
        }
    }

    public function eliminar($id) {
        $this->patologiasModelo->eliminarPatologias($id);
        echo "<script> alert ('Completado: Patologias Eliminado correctamente.')</script>";
        echo '<script language="javascript">window.location="Inicio.php"</script>';
        exit;
        // Puedes agregar lógica adicional después de eliminar el Patologias si es necesario
    }
    
    public function modificar($id, $nombre, $estatus, $valor, $descripcion) {
        $this->patologiasModelo->modificarPatologias($id, $nombre, $estatus, $valor, $descripcion);
        echo "<script> alert ('Completado: Patologias modificado correctamente.')</script>";
        echo '<script language="javascript">window.location="Inicio.php"</script>';
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

