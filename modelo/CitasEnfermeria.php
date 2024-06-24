<?php
class CitasEnfermeria
{
    //para la conexion
    private $conexion;

    public function __construct()
    {
        $this->conexion = (new Conexion())->Conectar();
    }
    private   $id;
    private   $altura;
    private   $peso;
    private   $tension;
    private   $fk_cita;

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getAltura(){
		return $this->altura;
	}

	public function setAltura($altura){
		$this->altura = $altura;
	}

	public function getPeso(){
		return $this->peso;
	}

	public function setPeso($peso){
		$this->peso = $peso;
	}

	public function getTension(){
		return $this->tension;
	}

	public function setTension($tension){
		$this->tension = $tension;
	}

	public function getFk_cita(){
		return $this->fk_cita;
	}

	public function setFk_cita($fk_cita){
		$this->fk_cita = $fk_cita;
	}

    public function crearCitaEnfermeria($altura, $peso, $tension, $fk_cita)
    {
        try {
            $this->conexion->beginTransaction();
    
            // Insertar la cita de enfermería
            $query = "INSERT INTO citas_enfermeria (altura, peso, tension, fk_cita) 
                    VALUES (:altura, :peso, :tension, :fk_cita)";
    
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':altura', $altura);
            $stmt->bindParam(':peso', $peso);
            $stmt->bindParam(':tension', $tension);
            $stmt->bindParam(':fk_cita', $fk_cita);
            $stmt->execute();
    
            // Actualizar el estatus de la cita en la tabla citas
            $query = "UPDATE citas SET estatus = 5 WHERE id = :fk_cita";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':fk_cita', $fk_cita);
            $stmt->execute();
    
            $this->conexion->commit();
            return true;
        } catch (PDOException $e) {
            $this->conexion->rollBack();
            echo "Error al crear la cita de enfermería: " . $e->getMessage();
            return false;
        }
    }
    

    public function verCitaEnfermeria ()
    {
        try {
            $query = "SELECT * FROM citas_enfermeria ORDER BY id ASC";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al recuperar todas las citas: " . $e->getMessage();
            return false;
        }
    }

    public function verificarCitaEnfermeriaExistentes($fk_cita) {
        try {
            $query = "SELECT * FROM citas_enfermeria WHERE fk_cita = :fk_cita";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':fk_cita', $fk_cita);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch(PDOException $e) {
            echo "Error al verificar la Cita: " . $e->getMessage();
            return false;
        }
    }
}