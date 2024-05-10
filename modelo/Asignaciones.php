<?php

//conexion
require_once '../config/Conexion.php';
require_once 'Usuarios.php';
require_once 'Servicios.php';


//clase Asignaciones
class Asignaciones
{

    //para la conexion
    private $conexion;

    public function __construct()
    {
        $this->conexion = (new Conexion())->Conectar();
    }


    //para los datos
    private $id;
    private $nombre;
    private $estatus;
    private $descripcion;
    private $f_inicio;
    private $f_fin;
    private $fk_servicios;
    private $fk_usuario;

     //setters y getters

     public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}

	public function getEstatus(){
		return $this->estatus;
	}

	public function setEstatus($estatus){
		$this->estatus = $estatus;
	}

	public function getDescripcion(){
		return $this->descripcion;
	}

	public function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}

	public function getF_inicio(){
		return $this->f_inicio;
	}

	public function setF_inicio($f_inicio){
		$this->f_inicio = $f_inicio;
	}

	public function getF_fin(){
		return $this->f_fin;
	}

	public function setF_fin($f_fin){
		$this->f_fin = $f_fin;
	}

    public function getfk_servicios(){
		return $this->fk_servicios;
	}

	public function setfk_servicios($fk_usuario){
		$this->fk_servicios = $fk_usuario;
	}

	public function getFk_usuario(){
		return $this->fk_usuario;
	}

	public function setFk_usuario($fk_usuario){
		$this->fk_usuario = $fk_usuario;
	}

    public function crearAsignacion( $nombre, $estatus, $descripcion, $f_inicio, $f_fin, $fk_servicios, $fk_usuario) {
        try { 
            $query = "INSERT INTO asignaciones ( nombre, estatus, descripcion, f_inicio, f_fin, fk_servicios, fk_usuario ) VALUES ( :nombre, :estatus, :descripcion, :f_inicio, :f_fin, :fk_servicios, :fk_usuario )";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':estatus', $estatus);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':f_inicio', $f_inicio);
            $stmt->bindParam(':f_fin', $f_fin);
            $stmt->bindParam(':fk_servicios', $fk_servicios);
            $stmt->bindParam(':fk_usuario', $fk_usuario);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al crear Asignaciones: " . $e->getMessage();
            return false;
        }
    }

    public function eliminarAsignaciones($id) {
        try {
            $query = "UPDATE asignaciones SET estatus = 0 WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al eliminar la Asignacion: " . $e->getMessage();
            return false;
        }
    }

    public function modificarAsignaciones($id, $nombre, $estatus, $descripcion, $f_inicio, $f_fin, $fk_servicios, $fk_usuario) {
        try {
            $query = "UPDATE asignaciones SET nombre = :nombre, estatus = :estatus, descripcion = :descripcion, f_inicio = :f_inicio, f_fin = :f_fin, fk_servicios = :fk_servicios, fk_usuario = :fk_usuario  WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':estatus', $estatus);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':f_inicio', $f_inicio);
            $stmt->bindParam(':f_fin', $f_fin);
            $stmt->bindParam(':fk_servicios', $fk_servicios);
            $stmt->bindParam(':fk_usuario', $fk_usuario);
            
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al modificar la Asignacion: " . $e->getMessage();
            return false;
        }
    }
        public function verTodosAsignaciones() {
            try {
                $query = "SELECT * FROM asignaciones order by id asc";
                $stmt = $this->conexion->prepare($query);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                echo "Error al obtener las Asignaciones: " . $e->getMessage();
                return false;
            }
        }

        public function verAsignacionesPorId($id) {
            try {
                $query = "SELECT * FROM asignaciones WHERE id = :id";
                $stmt = $this->conexion->prepare($query);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                echo "Error al obtener la Asignacion: " . $e->getMessage();
                return false;
            }
        }
    

    public function buscarAsignacionesPorId($id) {
        try {
            $query = "SELECT * FROM asignaciones WHERE id LIKE :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindValue(':id', "%$id%");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al buscar la Asignacion: " . $e->getMessage();
            return false;
        }
    }

    public function buscarAsignacionesPorNombre($nombre) {
        try {
            $query = "SELECT * FROM asignaciones WHERE nombre LIKE :nombre";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindValue(':nombre', "%$nombre%");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al buscar los Asignaciones: " . $e->getMessage();
            return false;
        }
    }
    
    public function verificarAsignacionesExistente($nombre) {
        try {
            $query = "SELECT COUNT(*) FROM asignaciones WHERE nombre = :nombre";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch(PDOException $e) {
            echo "Error al verificar los Asignaciones: " . $e->getMessage();
            return false;
        }
    }

    public function obtenerAsignacionesUsuario() {
        try {
            
            $fk_usuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null;
    
            
            if ($fk_usuario === null) {
                echo "El usuario no está conectado.";
                return false;
            }
    
            $query = "SELECT * FROM asignaciones WHERE fk_usuario = :fk_usuario";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':fk_usuario', $fk_usuario);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            echo "Error al obtener Asignaciones: " . $e->getMessage();
            return false;
        }
    }
    public function obtenerNombreApellidoPersonaAsignacion($fk_usuario) {
                $query = "SELECT personas.nombre, personas.apellido
                        FROM personas
                        INNER JOIN usuarios ON personas.id = usuarios.fk_persona
                        INNER JOIN asignaciones ON usuarios.id = asignaciones.fk_usuario
                        WHERE asignaciones.fk_usuario = :fk_usuario";
                
                $stmt = $this->conexion->prepare($query);
                $stmt->bindParam(':fk_usuario', $fk_usuario);
                $stmt->execute();
                
                return $stmt->fetch();
            }
            public function obtenerNombreServicioAsignacion($fk_usuario) {
                $query = "SELECT servicios.nombre as nombre_servicio
                          FROM servicios
                          INNER JOIN asignaciones ON servicios.id = asignaciones.fk_servicios
                          INNER JOIN usuarios ON asignaciones.fk_usuario = usuarios.id
                          WHERE asignaciones.fk_usuario = :fk_usuario";
            
                $stmt = $this->conexion->prepare($query);
                $stmt->bindParam(':fk_usuario', $fk_usuario);
                $stmt->execute();
            
                return $stmt->fetch();
            }
}
