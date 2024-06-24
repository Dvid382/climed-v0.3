<?php

//conexion
require_once '../config/Conexion.php';
require_once 'Cargos.php';

//clase tipo_medicamentos
class Tipo_Medicamentos
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

   


    public function crearTipo_Medicamentos( $nombre, $descripcion) {
        try {
            $query = "INSERT INTO tipo_medicamentos ( nombre, descripcion) VALUES ( :nombre, :descripcion)";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
       /*      $stmt->bindParam(':estatus', $estatus);
            $stmt->bindParam(':valor', $valor); */
            $stmt->bindParam(':descripcion', $descripcion);
            
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al crear los tipo_medicamentos: " . $e->getMessage();
            return false;
        }
        
    }
    
    public function eliminarTipo_Medicamentos($id) {
        try {
            $query = "DELETE FROM tipo_medicamentos WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al eliminar los tipo_medicamentos: " . $e->getMessage();
            return false;
        }
    }
    
    public function modificarTipo_Medicamentos($id, $nombre, $descripcion) {
        try {
            $query = "UPDATE tipo_medicamentos SET nombre = :nombre, descripcion = :descripcion  WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre', $nombre);
            /* $stmt->bindParam(':estatus', $estatus);
            $stmt->bindParam(':valor', $valor); */
            $stmt->bindParam(':descripcion', $descripcion);
           
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al modificar los tipo_medicamentos: " . $e->getMessage();
            return false;
        }
    }
    
    
    public function verTodosTipo_Medicamentos() {
        try {
            $query = "SELECT * FROM tipo_medicamentos order by id asc";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al obtener los servicios: " . $e->getMessage();
            return false;
        }
    }
    
    public function verTipo_MedicamentosPorId($id) {
        try {
            $query = "SELECT * FROM tipo_medicamentos WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al obtener los tipo_medicamentos: " . $e->getMessage();
            return false;
        }
    }
    
    public function buscarTipo_MedicamentosPorId($id) {
        try {
            $query = "SELECT * FROM tipo_medicamentos WHERE id LIKE :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindValue(':id', "%$id%");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al buscar los tipo_medicamentos: " . $e->getMessage();
            return false;
        }
    }
    
    public function buscarTipo_MedicamentosPorNombre($nombre) {
        try {
            $query = "SELECT * FROM tipo_medicamentos WHERE nombre LIKE :nombre";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindValue(':nombre', "%$nombre%");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al buscar los tipo_medicamentos: " . $e->getMessage();
            return false;
        }
    }
    
    public function verificarTipo_MedicamentosExistente($nombre) {
        try {
            $query = "SELECT COUNT(*) FROM tipo_medicamentos WHERE nombre = :nombre";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch(PDOException $e) {
            echo "Error al verificar los tipo_medicamentos: " . $e->getMessage();
            return false;
        }
    }

   
    
    
    
    

   
}