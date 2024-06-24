<?php

//conexion
require_once '../config/Conexion.php';
require_once 'Cargos.php';

//clase UnidadPeso
class UnidadPesos
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
   /*  private $estatus;
    private $valor; */
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

	/* public function getValor(){
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
	}*/

    public function getdescripcion(){
		return $this->descripcion;
	}

	public function setdescripcion($descripcion){
		$this->valor = $descripcion;
	}

   


    public function crearUnidadPeso( $nombre, $descripcion) {
        try {
            $query = "INSERT INTO unidadpeso ( nombre, descripcion) VALUES ( :nombre, :descripcion)";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
       /*      $stmt->bindParam(':estatus', $estatus);
            $stmt->bindParam(':valor', $valor); */
            $stmt->bindParam(':descripcion', $descripcion);
            
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al crear los UnidadPeso: " . $e->getMessage();
            return false;
        }
        
    }
    
    public function eliminarUnidadPeso($id) {
        try {
            $query = "DELETE FROM unidadpeso WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al eliminar los UnidadPeso: " . $e->getMessage();
            return false;
        }
    }
    
    public function modificarUnidadPeso($id, $nombre, $descripcion) {
        try {
            $query = "UPDATE unidadpeso SET nombre = :nombre, descripcion = :descripcion  WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre', $nombre);
            /* $stmt->bindParam(':estatus', $estatus);
            $stmt->bindParam(':valor', $valor); */
            $stmt->bindParam(':descripcion', $descripcion);
           
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al modificar los UnidadPeso: " . $e->getMessage();
            return false;
        }
    }
    
    
    public function verTodosUnidadPeso() {
        try {
            $query = "SELECT * FROM unidadpeso order by id asc";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al obtener los servicios: " . $e->getMessage();
            return false;
        }
    }
    
    public function verUnidadPesoPorId($id) {
        try {
            $query = "SELECT * FROM unidadpeso WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al obtener los UnidadPeso: " . $e->getMessage();
            return false;
        }
    }
    
    public function buscarUnidadPesoPorId($id) {
        try {
            $query = "SELECT * FROM unidadpeso WHERE id LIKE :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindValue(':id', "%$id%");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al buscar los UnidadPeso: " . $e->getMessage();
            return false;
        }
    }
    
    public function buscarUnidadPesoPorNombre($nombre) {
        try {
            $query = "SELECT * FROM unidadpeso WHERE nombre LIKE :nombre";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindValue(':nombre', "%$nombre%");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al buscar los UnidadPeso: " . $e->getMessage();
            return false;
        }
    }
    
    public function verificarUnidadPesoExistente($nombre) {
        try {
            $query = "SELECT COUNT(*) FROM unidadpeso WHERE nombre = :nombre";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch(PDOException $e) {
            echo "Error al verificar los UnidadPeso: " . $e->getMessage();
            return false;
        }
    }

   
    
    
    
    

   
}