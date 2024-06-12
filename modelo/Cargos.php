<?php

//conexion
require_once '../config/Conexion.php';
require_once 'Servicios.php';

//clase Cargos
class Cargos
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
    private $fk_servicio;
    
   
    

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

    public function getdescripcion(){
		return $this->descripcion;
	}

	public function setdescripcion($descripcion){
		$this->valor = $descripcion;
	}	

    public function getestado(){
		return $this->estatus;
	}

	public function setestado($estatus){
		$this->valor = $estatus;
	}

    public function getfk_servicio(){
		return $this->fk_servicio;
	}

	public function setcargo($fk_servicio){
		$this->valor = $fk_servicio;
	}

   


    public function crearCargos($nombre, $descripcion, $estatus = 1, $fk_servicio) {
        try {
            $query = "INSERT INTO cargos (nombre, descripcion, estatus, fk_servicio) VALUES (:nombre, :descripcion, :estatus, :fk_servicio)";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':estatus', $estatus);
            $stmt->bindParam(':fk_servicio', $fk_servicio);

            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al crear los Cargos: " . $e->getMessage();
            return false;
        }
    }
    
    public function eliminarCargos($id) {
        try {
            $query = "UPDATE cargos SET estatus = 0 WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al eliminar los Cargos: " . $e->getMessage();
            return false;
        }
    }
    
    public function modificarCargos($id, $nombre, $descripcion, $estatus, $fk_servicio) {
        try {
            $query = "UPDATE cargos SET nombre = :nombre, descripcion = :descripcion, estatus = :estatus, fk_servicio = :fk_servicio WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':estatus', $estatus);
            $stmt->bindParam(':fk_servicio', $fk_servicio);
            
            
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al modificar los cargos: " . $e->getMessage();
            return false;
        }
    }
    
    public function verTodosCargos() {
        try {
            $query = "SELECT 
            c.id,
            c.nombre,
            c.descripcion,
            c.estatus,
            s.nombre AS nombre_servicio
        FROM 
            cargos c
        JOIN 
            servicios s ON c.fk_servicio = s.id
        ORDER BY 
            c.id ASC";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            $cargos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            
            if (empty($cargos)) {
                return "No hay cargos creados en la base de datos. Presione el botón 'Nuevo cargo'.";
            } else {
                return $cargos;
            }
        } catch(PDOException $e) {
            echo "Error al obtener los Cargos: " . $e->getMessage();
            return false;
        }
    }


    
    public function verCargosPorId($id) {
        try {
            $query = "SELECT * FROM cargos WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al obtener los Cargos: " . $e->getMessage();
            return false;
        }
    }
    
    public function buscarCargosPorId($id) {
        try {
            $query = "SELECT * FROM cargos WHERE id LIKE :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindValue(':id', "%$id%");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al buscar los Cargos: " . $e->getMessage();
            return false;
        }
    }
    
    public function buscarCargosPorNombre($nombre) {
        try {
            $query = "SELECT * FROM cargos WHERE nombre LIKE :nombre";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindValue(':nombre', "%$nombre%");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al buscar los Cargos: " . $e->getMessage();
            return false;
        }
    }
    
    public function verificarCargosExistente($nombre) {
        try {
            $query = "SELECT COUNT(*) FROM cargos WHERE nombre = :nombre";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch(PDOException $e) {
            echo "Error al verificar los Cargos: " . $e->getMessage();
            return false;
        }
    }
    
}