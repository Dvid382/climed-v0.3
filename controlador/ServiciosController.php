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
            echo "<script> alert ('Error: el servicios ya existe.')</script>";
            echo '<script language="javascript">window.location="CrearServicios.php"</script>';
            exit;
        } else {
            $this->serviciosModelo->crearServicio($nombre, $estatus, $valor, $descripcion);
            
            $_SESSION['mensaje'] = "Servicios creado correctamente";
             echo "<script> alert ('Completado: Servicios creado correctamente.')</script>";
            echo '<script language="javascript">window.location="Inicio.php"</script>';
            exit;
        }
    }

    public function eliminar($id) {
        $this->serviciosModelo->eliminarServicios($id);
        echo "<script> alert ('Completado: Servicios Eliminado correctamente.')</script>";
        echo '<script language="javascript">window.location="Inicio.php"</script>';
        exit;
        // Puedes agregar lógica adicional después de eliminar el Servicios si es necesario
    }
    
    public function modificar($id, $nombre, $estatus, $valor, $descripcion) {
        $this->serviciosModelo->modificarServicios($id, $nombre, $estatus, $valor, $descripcion);
        echo "<script> alert ('Completado: Servicios modificado correctamente.')</script>";
        echo '<script language="javascript">window.location="Inicio.php"</script>';
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

