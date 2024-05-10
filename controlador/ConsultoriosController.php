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
            echo "<script> alert ('Error: el Consultorios ya existe.')</script>";
            echo '<script language="javascript">window.location="CrearConsultorios.php"</script>';
            exit;
        } else {
            $this->consultoriosModelo->crearConsultorio($nombre, $descripcion, $estatus);
            
            $_SESSION['mensaje'] = "Consultorios creado correctamente";
             echo "<script> alert ('Completado: Consultorios creado correctamente.')</script>";
            echo '<script language="javascript">window.location="ConsultoriosIndex.php"</script>';
            exit;
        }
    }

    public function eliminar($id) {
        $this->consultoriosModelo->eliminarConsultorios($id);
        echo "<script> alert ('Completado: Consultorios Eliminado correctamente.')</script>";
        echo '<script language="javascript">window.location="ConsultoriosIndex.php"</script>';
        exit;
        // Puedes agregar lógica adicional después de eliminar el Consultorios si es necesario
    }
    
    public function modificar($id, $nombre, $descripcion, $estatus) {
        $this->consultoriosModelo->modificarConsultorios($id, $nombre, $descripcion, $estatus);
        echo "<script> alert ('Completado: Consultorios modificado correctamente.')</script>";
        echo '<script language="javascript">window.location="ConsultoriosIndex.php"</script>';
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

