<?php

//conexion
require_once '../config/Conexion.php';

//clase Servicios
class Servicios
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
    private $valor;
    private $descripcion;
    

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

	public function getValor(){
		return $this->valor;
	}

	public function setValor($valor){
		$this->valor = $valor;
	}

    public function getestado(){
		return $this->estatus;
	}

	public function setestado($estatus){
		$this->valor = $estatus;
	}

    public function getdescripcion(){
		return $this->descripcion;
	}

	public function setdescripcion($descripcion){
		$this->valor = $descripcion;
	}


    public function crearServicio( $nombre, $estatus, $valor, $descripcion) {
        try {
            $query = "INSERT INTO servicios ( nombre, estatus, valor, descripcion ) VALUES ( :nombre, :estatus, :valor, :descripcion )";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':estatus', $estatus);
            $stmt->bindParam(':valor', $valor);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al crear los Servicios: " . $e->getMessage();
            return false;
        }
    }
    
    public function eliminarServicios($id) {
        try {
            $query = "UPDATE servicios SET estatus = 0 WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al eliminar los servicios: " . $e->getMessage();
            return false;
        }
    }
    
    public function modificarServicios($id, $nombre, $estatus, $valor, $descripcion) {
        try {
            $query = "UPDATE servicios SET nombre = :nombre, estatus = :estatus, valor = :valor, descripcion = :descripcion  WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':estatus', $estatus);
            $stmt->bindParam(':valor', $valor);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al modificar los servicios: " . $e->getMessage();
            return false;
        }
    }
    
    public function verTodosServicios() {
        try {
            $query = "SELECT * FROM servicios order by id asc";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al obtener los servicios: " . $e->getMessage();
            return false;
        }
    }
    
    public function verServiciosPorId($id) {
        try {
            $query = "SELECT * FROM servicios WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al obtener los servicios: " . $e->getMessage();
            return false;
        }
    }
    
    public function buscarServiciosPorId($id) {
        try {
            $query = "SELECT * FROM servicios WHERE id LIKE :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindValue(':id', "%$id%");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al buscar los servicios: " . $e->getMessage();
            return false;
        }
    }
    
    public function buscarServiciosPorNombre($nombre) {
        try {
            $query = "SELECT * FROM servicios WHERE nombre LIKE :nombre";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindValue(':nombre', "%$nombre%");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al buscar los servicios: " . $e->getMessage();
            return false;
        }
    }
    
    public function verificarServiciosExistente($nombre) {
        try {
            $query = "SELECT COUNT(*) FROM servicios WHERE nombre = :nombre";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch(PDOException $e) {
            echo "Error al verificar los servicios: " . $e->getMessage();
            return false;
        }
    }
    
}