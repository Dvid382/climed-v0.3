<?php
require_once '../config/Conexion.php';
require_once '../modelo/Personas.php';

session_start();
class PersonasController  {
    private $personasModelo;

    public function __construct() {
        $conexion = new Conexion();
        $this->personasModelo = new Persona($conexion->conectar());
    }

    public function crearPersona($nombre, $apellido, $cedula, $telefono, $correo, $sexo, $direccion, $f_nacimiento, $estatus) {
        if ($this->verificarPersonaExistente($cedula)) {
            echo "<script> alert ('Error: el personas ya existe.')</script>";
            echo '<script language="javascript">window.location="personasCrear.php"</script>';
            exit;
        }
    
        $this->personasModelo->setId('id');
        $this->personasModelo->setNombre('nombre');
        $this->personasModelo->setApellido('apellido');
        $this->personasModelo->setCedula('cedula');
        $this->personasModelo->setTelefono('telefono');
        $this->personasModelo->setCorreo('correo');
        $this->personasModelo->setSexo('sexo');
        $this->personasModelo->setDireccion('direccion');
        $this->personasModelo->setF_nacimiento('f_nacimiento');
        $this->personasModelo->setEstatus('estatus');
        
    
        /* // Ruta de la carpeta de destino
        $carpetaDestino = '../vista/PersonasFoto/';
    
        // Verificar si la carpeta de destino no existe, crearla
        if (!file_exists($carpetaDestino)) {
            mkdir($carpetaDestino, 0777, true);
        }
    
        // Mover la foto a la carpeta de destino
        $rutaFotoDestino = $carpetaDestino . $foto['name'];
        move_uploaded_file($foto['tmp_name'], $rutaFotoDestino);
    
        // Asignar la nueva ruta de la foto
        $this->personasModelo->setFoto($rutaFotoDestino); */
    
        if ($this->personasModelo->crearPersona($nombre, $apellido, $cedula, $telefono, $correo, $sexo, $direccion, $f_nacimiento, $estatus)) {
            echo "<script> alert ('Completado: Persona creado correctamente.')</script>";
            echo '<script language="javascript">window.location="Inicio.php"</script>';
            exit;
        } else {
            echo "<script> alert ('Error: Error al crear el Persona.')</script>";
            echo '<script language="javascript">window.location="PersonaCrear.php"</script>';
            exit;
        }
    }
    
    
    public function eliminarPersona($id) {
        $this->personasModelo->eliminarPersona($id);
        echo "<script> alert ('Completado: Persona Eliminada correctamente.')</script>";
        echo '<script language="javascript">window.location="Inicio.php"</script>';
        exit;
        // Puedes agregar lógica adicional después de eliminar el rol si es necesario
    }
    
    public function modificarPersona($id, $nombre, $apellido, $cedula, $telefono, $correo, $sexo, $direccion, $f_nacimiento , $estatus) {
    
        $this->personasModelo->setId('id');
        $this->personasModelo->setNombre('nombre');
        $this->personasModelo->setApellido('apellido');
        $this->personasModelo->setCedula('cedula');
        $this->personasModelo->setTelefono('telefono');
        $this->personasModelo->setCorreo('correo');
        $this->personasModelo->setSexo('sexo');
        $this->personasModelo->setDireccion('direccion');
        $this->personasModelo->setF_nacimiento('f_nacimiento');
        $this->personasModelo->setEstatus('estatus');

        /* // Ruta de la carpeta de destino
        $carpetaDestino = '../vista/PersonasFoto/';
    
        // Verificar si la carpeta de destino no existe, crearla
        if (!file_exists($carpetaDestino)) {
            mkdir($carpetaDestino, 0777, true);
        }
    
        // Mover la foto a la carpeta de destino
        $rutaFotoDestino = $carpetaDestino . $foto['name'];
        move_uploaded_file($foto['tmp_name'], $rutaFotoDestino); */

        if ($this->personasModelo->modificarPersona($id, $nombre, $apellido, $cedula, $telefono, $correo, $sexo, $direccion, $f_nacimiento, $estatus)) {
            echo "<script> alert ('Completado: Persona modificado.')</script>";
             echo '<script language="javascript">window.location="Inicio.php"</script>'; 
            
            exit;

        } else {
            echo "<script> alert ('Error: No se pudo modificar el Persona.')</script>";
             echo '<script language="javascript">window.location="EditarPersona.php?id=" . $id"</script>'; 
            
            exit;
        }
    }
    
    

    //maneja el acceso a las vistas
    public function Vistas(){
        if (!isset($_SESSION['rol'])) {
            echo "<script>alert('Usted debe iniciar sesión para acceder a esta página.'); window.location.href = '../Index.php';</script>";
            exit;
        }
        
        if ( $_SESSION['valor_rol']==false) {
            echo "<script>alert('Usted no tiene permiso para acceder a esta página.'); window.location.href = 'Home.php';</script>";
            exit;
        
        }
    }

    public function cerrarSesion() {
        // Destruir todas las variables de sesión
        $_SESSION = array();
        
        // Finalmente, destruir la sesión
        session_destroy();
        
        // Redirigir a la página de inicio de sesión
        header("Location: ../Index.php");
    }

    public function verTodosPersonas() {
        return $this->personasModelo->verTodosPersonas();
    }

    public function verPersonaPorId($id) {
        return $this->personasModelo->verPersonaPorId($id);
    }

    public function verPersonaPorCedula($cedula) {
        return $this->personasModelo->verPersonaPorCedula($cedula);
    }
    
    public function buscarPersonaPorNombre($nombre) {
        return $this->personasModelo->buscarPersonaPorNombre($nombre);
    }

    public function verificarPersonaExistente($nombre) {
        return $this->personasModelo->verificarPersonaExistente($nombre);
    }
}
