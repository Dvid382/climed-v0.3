<?php

//conexion
require_once '../config/Conexion.php';

//clase Consultorios
class Consultorios
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
    private $descripcion;
    private $estatus;
    
    
    

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

	public function getDescripcion(){
		return $this->descripcion;
	}

	public function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}

	public function getEstatus(){
		return $this->estatus;
	}

	public function setEstatus($estatus){
		$this->estatus = $estatus;
	}


    public function crearConsultorio($nombre, $descripcion, $estatus) {
        try {
            $query = "INSERT INTO consultorios ( nombre, descripcion, estatus) VALUES ( :nombre, :descripcion, :estatus)";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':estatus', $estatus);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al crear los Consultorios: " . $e->getMessage();
            return false;
        }
    }
    
    public function eliminarConsultorios($id) {
        try {
            $query = "UPDATE consultorios SET estatus = 0 WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al eliminar los Consultorios: " . $e->getMessage();
            return false;
        }
    }
    
    public function modificarConsultorios($id, $nombre, $descripcion, $estatus) {
        try {
            $query = "UPDATE consultorios SET nombre = :nombre, descripcion = :descripcion, estatus = :estatus  WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':estatus', $estatus);
            
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al modificar los Consultorios: " . $e->getMessage();
            return false;
        }
    }
    
    public function verTodosConsultorios() {
        try {
            $query = "SELECT * FROM consultorios order by id asc";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al obtener los Consultorios: " . $e->getMessage();
            return false;
        }
    }
    
    public function verConsultoriosPorId($id) {
        try {
            $query = "SELECT * FROM consultorios WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al obtener los Consultorios: " . $e->getMessage();
            return false;
        }
    }
    
    public function buscarConsultoriosPorId($id) {
        try {
            $query = "SELECT * FROM consultorios WHERE id LIKE :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindValue(':id', "%$id%");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al buscar los Consultorios: " . $e->getMessage();
            return false;
        }
    }
    
    public function buscarConsultoriosPorNombre($nombre) {
        try {
            $query = "SELECT * FROM consultorios WHERE nombre LIKE :nombre";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindValue(':nombre', "%$nombre%");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al buscar los Consultorios: " . $e->getMessage();
            return false;
        }
    }
    
    public function verificarConsultoriosExistente($nombre) {
        try {
            $query = "SELECT COUNT(*) FROM consultorios WHERE nombre = :nombre";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch(PDOException $e) {
            echo "Error al verificar los Consultorios: " . $e->getMessage();
            return false;
        }
    }
    
}