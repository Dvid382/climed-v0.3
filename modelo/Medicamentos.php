<?php

//conexion
require_once '../config/Conexion.php';
require_once 'ComponentesActivos.php';
require_once 'Tipo_Medicamentos.php';
require_once 'UnidadMedidas.php';
require_once 'UnidadPesos.php';
//clase Medicamentos
class Medicamentos
{

    //para la conexion
    private $conexion;

    public function __construct()
    {
        $this->conexion = (new Conexion())->Conectar();
    }


    //para los datos
    private $id;
    private $nombre_comercial;
    private $descripcion;
    private $cantidad;
    private $fk_componentesactivos;
    private $fk_tipo_medicamento;
    private $fk_unidadmedida;
    private $fk_unidadpeso;
    
   
    

    //setters y getters
    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getNombre_comercial(){
		return $this->nombre_comercial;
	}

	public function setNombre_comercial($nombre_comercial){
		$this->nombre_comercial = $nombre_comercial;
	}

	public function getDescripcion(){
		return $this->descripcion;
	}

	public function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}

	public function getCantidad(){
		return $this->cantidad;
	}

	public function setCantidad($cantidad){
		$this->cantidad = $cantidad;
	}

	public function getFk_componentesactivos(){
		return $this->fk_componentesactivos;
	}

	public function setFk_componentesactivos($fk_componentesactivos){
		$this->fk_componentesactivos = $fk_componentesactivos;
	}

	public function getFk_tipo_medicamento(){
		return $this->fk_tipo_medicamento;
	}

	public function setFk_tipo_medicamento($fk_tipo_medicamento){
		$this->fk_tipo_medicamento = $fk_tipo_medicamento;
	}

	public function getFk_unidadmedida(){
		return $this->fk_unidadmedida;
	}

	public function setFk_unidadmedida($fk_unidadmedida){
		$this->fk_unidadmedida = $fk_unidadmedida;
	}

	public function getFk_unidadpeso(){
		return $this->fk_unidadpeso;
	}

	public function setFk_unidadpeso($fk_unidadpeso){
		$this->fk_unidadpeso = $fk_unidadpeso;
	}

   


    public function crearMedicamentos($nombre_comercial, $descripcion, $cantidad, $fk_componentesactivos, $fk_tipo_medicamento, $fk_unidadmedida, $fk_unidadpeso) {
        try {
            $query = "INSERT INTO medicamentos (nombre_comercial, descripcion, cantidad, fk_componentesactivos, fk_tipo_medicamento, fk_unidadmedida, fk_unidadpeso) VALUES (:nombre_comercial, :descripcion, :cantidad, :fk_componentesactivos, :fk_tipo_medicamento, :fk_unidadmedida, :fk_unidadpeso)";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre_comercial', $nombre_comercial);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':cantidad', $cantidad);
            $stmt->bindParam(':fk_componentesactivos', $fk_componentesactivos);
            $stmt->bindParam(':fk_tipo_medicamento', $fk_tipo_medicamento);
            $stmt->bindParam(':fk_unidadmedida', $fk_unidadmedida);
            $stmt->bindParam(':fk_unidadpeso', $fk_unidadpeso);

            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al crear los Medicamentos: " . $e->getMessage();
            return false;
        }
    }
    
    public function eliminarMedicamentos($id) {
        try {
            $query = "DELETE FROM medicamentos  WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al eliminar los Medicamentos: " . $e->getMessage();
            return false;
        }
    }
    
    public function modificarMedicamentos($id, $nombre_comercial, $descripcion, $cantidad, $fk_componentesactivos, $fk_tipo_medicamento, $fk_unidadmedida, $fk_unidadpeso) {
        try {
            $query = "UPDATE medicamentos SET id = :id, nombre_comercial = :nombre_comercial, descripcion = :descripcion, cantidad = :cantidad, fk_componentesactivos = :fk_componentesactivos, fk_tipo_medicamento = :fk_tipo_medicamento, fk_unidadmedida = :fk_unidadmedida, fk_unidadpeso = :fk_unidadpeso WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre_comercial', $nombre_comercial);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':cantidad', $cantidad);
            $stmt->bindParam(':fk_componentesactivos', $fk_componentesactivos);
            $stmt->bindParam(':fk_tipo_medicamento', $fk_tipo_medicamento);
            $stmt->bindParam(':fk_unidadmedida', $fk_unidadmedida);
            $stmt->bindParam(':fk_unidadpeso', $fk_unidadpeso);

            
            
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al modificar los Medicamentos: " . $e->getMessage();
            return false;
        }
    }
    
    public function verTodosMedicamentos() {
        try {
            $query = "SELECT 
                m.id,
                m.nombre_comercial,
                m.descripcion,
                m.cantidad,
                ca.nombre AS nombre_componente_activo,
                tm.nombre AS nombre_tipo_medicamento,
                up.nombre AS nombre_unidad_peso,
                um.nombre AS nombre_unidad_medida
            FROM 
                medicamentos m
            LEFT JOIN 
                componentesactivos ca ON m.fk_componentesactivos = ca.id
            LEFT JOIN
                tipo_medicamentos tm ON m.fk_tipo_medicamento = tm.id
            LEFT JOIN
                unidadpeso up ON m.fk_unidadpeso = up.id
            LEFT JOIN
                unidadmedida um ON m.fk_unidadmedida = um.id
            ORDER BY 
                m.id ASC";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            $medicamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if (empty($medicamentos)) {
                return "No hay medicamentos creados en la base de datos.";
            } else {
                return $medicamentos;
            }
        } catch(PDOException $e) {
            echo "Error al obtener los Medicamentos: " . $e->getMessage();
            return false;
        }
    }


    
    public function verMedicamentosPorId($id) {
        try {
            $query = "SELECT * FROM medicamentos WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al obtener los Medicamentos: " . $e->getMessage();
            return false;
        }
    }
    
    public function buscarMedicamentosPorId($id) {
        try {
            $query = "SELECT * FROM medicamentos WHERE id LIKE :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindValue(':id', "%$id%");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al buscar los medicamentos: " . $e->getMessage();
            return false;
        }
    }
    
    public function buscarMedicamentosPorNombre($nombre) {
        try {
            $query = "SELECT * FROM medicamentos WHERE nombre LIKE :nombre";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindValue(':nombre', "%$nombre%");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al buscar los Medicamentos: " . $e->getMessage();
            return false;
        }
    }
    
    public function verificarMedicamentosExistente($nombre_comercial) {
        try {
            $query = "SELECT COUNT(*) FROM medicamentos WHERE nombre_comercial = :nombre_comercial";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre_comercial', $nombre_comercial);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch(PDOException $e) {
            echo "Error al verificar los Medicamentos: " . $e->getMessage();
            return false;
        }
    }
    
}