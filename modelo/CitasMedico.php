<?php
class CitasMedico
{
    //para la conexion
    private $conexion;

    public function __construct()
    {
        $this->conexion = (new Conexion())->Conectar();
    }
    private   $id;
    private   $diagnostico;
    private   $fk_patologia;
    private   $fk_laboratorio;
    private   $fk_cita_enfermeria;

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getDiagnostico(){
		return $this->diagnostico;
	}

	public function setDiagnostico($diagnostico){
		$this->diagnostico = $diagnostico;
	}

	public function getFk_patologia(){
		return $this->fk_patologia;
	}

	public function setFk_patologia($fk_patologia){
		$this->fk_patologia = $fk_patologia;
	}

	public function getFk_laboratorio(){
		return $this->fk_laboratorio;
	}

	public function setFk_laboratorio($fk_laboratorio){
		$this->fk_laboratorio = $fk_laboratorio;
	}

	public function getFk_cita_enfermeria(){
		return $this->fk_cita_enfermeria;
	}

	public function setFk_cita_enfermeria($fk_cita_enfermeria){
		$this->fk_cita_enfermeria = $fk_cita_enfermeria;
	}

    public function CrearHistoriaMedica($diagnostico, $fk_patologia, $fk_laboratorio, $fk_cita_enfermeria, $receta, $f_inicio, $f_fin, $fk_medicamento, $descripcion, $f_inicio_evolucion, $f_fin_evolucion, $citaId)
    {
        try {
            // Iniciar una transacción para garantizar la integridad de los datos
            $this->conexion->beginTransaction();
    
            // Insertar en la tabla historias_medicas
            $sql = "INSERT INTO historias_medicas (diagnostico, fk_patologia, fk_laboratorio, fk_cita_enfermeria) 
                    VALUES (:diagnostico, :fk_patologia, :fk_laboratorio, :fk_cita_enfermeria)";
                $stmt = $this->conexion->prepare($sql);
                $stmt->bindParam(':diagnostico', $diagnostico);
                $stmt->bindParam(':fk_patologia', $fk_patologia);
                $stmt->bindParam(':fk_laboratorio', $fk_laboratorio);
                $stmt->bindParam(':fk_cita_enfermeria', $fk_cita_enfermeria);
                $stmt->execute();

            $last_insert_id = $this->conexion->lastInsertId();
    
            // Insertar en la tabla recipes
            $sql_recipes = "INSERT INTO recipes (receta, f_inicio, f_fin, fk_medicamento, fk_historia_medica) 
                    VALUES (:receta, :f_inicio, :f_fin, :fk_medicamento, :fk_historia_medica)";
            $stmt_recipes = $this->conexion->prepare($sql_recipes);
            $stmt_recipes->bindParam(':receta', $receta);
            $stmt_recipes->bindParam(':f_inicio', $f_inicio);
            $stmt_recipes->bindParam(':f_fin', $f_fin);
            $stmt_recipes->bindParam(':fk_medicamento', $fk_medicamento);
            $stmt_recipes->bindParam(':fk_historia_medica', $last_insert_id);
            $stmt->execute();

            // Insertar en la tabla reposo
            $sql_reposo = "INSERT INTO reposo (descripcion, f_inicio, f_fin, fk_historia_medica) 
                    VALUES (:descripcion, :f_inicio, :f_fin, :fk_historia_medica)";
            $stmt_reposo = $this->conexion->prepare($sql_reposo);
            $stmt_reposo->bindParam(':descripcion', $descripcion);
            $stmt_reposo->bindParam(':f_inicio', $f_inicio_evolucion);
            $stmt_reposo->bindParam(':fk_historia_medica', $last_insert_id);
            $stmt_reposo->bindParam(':f_fin', $f_fin_evolucion);
            $stmt_reposo->execute();
    
            $query = "UPDATE citas SET estatus = '6' WHERE id = :citaId";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':citaId', $citaId);
            $stmt->execute();
            // Confirmar la transacción si todo se ejecutó correctamente
            $this->conexion->commit();
            return true;
        } catch (PDOException $e) {
            // Revertir la transacción en caso de error
            $this->conexion->rollBack();
            echo "Error al crear las historias médicas: " . $e->getMessage();
            return false;
        }
    }

        public function verHistoriaMedica ()
        {
            try {
                $query = "SELECT * FROM historias_medicas ORDER BY id ASC";
                $stmt = $this->conexion->prepare($query);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                echo "Error al recuperar todas las citas: " . $e->getMessage();
                return false;
            }
        }
    
        public function verificarHistoriaMedicaExistentes($id) {
            try {
                $query = "SELECT * FROM historias_medicas WHERE id = :id";
                $stmt = $this->conexion->prepare($query);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return $stmt->fetchColumn() > 0;
            } catch(PDOException $e) {
                echo "Error al verificar la Cita: " . $e->getMessage();
                return false;
            }
        }       
}