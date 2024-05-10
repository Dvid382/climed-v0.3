<?php
require_once '../modelo/Roles.php';

class RolesController {
    private $rolesModelo;

    public function __construct() {
        $conexion = new Conexion();
        $this->rolesModelo = new Roles($conexion->Conectar());
    }
    
    public function crear($nombre, $estatus, $valor, $descripcion) {
        if ($this->rolesModelo->verificarRolExistente($nombre)) {
            echo "<script> alert ('Error: el Rol ya existe.')</script>";
            echo '<script language="javascript">window.location="CrearRol.php"</script>';
            exit;
        } else {
            $this->rolesModelo->crearRol($nombre, $estatus, $valor, $descripcion);
            /* var_dump($nombre, $estatus, $valor, $descripcion ); */
            $_SESSION['mensaje'] = "Rol creado correctamente";
             echo "<script> alert ('Completado: Rol creado correctamente.')</script>";
             echo '<script language="javascript">window.location="Inicio.php"</script>' ;
            exit;
        }
    }

    public function eliminar($id) {
        $this->rolesModelo->eliminarRol($id);
        echo "<script> alert ('Completado: Rol Eliminado correctamente.')</script>";
        echo '<script language="javascript">window.location="Inicio.php"</script>';
        exit;
        // Puedes agregar lógica adicional después de eliminar el rol si es necesario
    }
    
    public function modificar($id,$nombre, $estatus, $valor, $descripcion) {
        $this->rolesModelo->modificarRol($id,$nombre, $estatus, $valor, $descripcion);
         
        echo "<script> alert ('Completado: Rol modificado correctamente.')</script>";
 echo '<script language="javascript">window.location="Inicio.php"</script>';
        // Puedes agregar lógica adicional después de modificar el rol si es necesario
    }
    
    public function verTodos() {
        return $this->rolesModelo->verTodosRol();
    }
    
    public function verPorId($id) {
        return $this->rolesModelo->verRolPorId($id);
    }

    public function buscarPorNombre($nombre) {
        return $this->rolesModelo->buscarRolPorNombre($nombre);
    }

    public function verificarRolExistente($nombre) {
        return $this->rolesModelo->verificarRolExistente($nombre);
    }
}

