<?php

class HistoriasMedicas
{
        //para la conexion
        private $conexion;

        public function __construct()
        {
            $this->conexion = (new Conexion())->Conectar();
        }

           //para los datos
        private $id;
        private $diagnistico;
        private $fk_patologia;
        private $fk_laboratorio;
        private $fk_cita_enfermeria;
        
        public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getDiagnistico(){
		return $this->diagnistico;
	}

	public function setDiagnistico($diagnistico){
		$this->diagnistico = $diagnistico;
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

    public function obtenerInformacionTodasHistoriasMedicas() {
        try {
            $query = "SELECT
            citas.id,
			citas.fecha,
            citas.hora,
            citas.estatus,
            citas.fk_usuario_sesion,
            paciente.id AS id_paciente,
            paciente.nombre AS nombre_paciente,
            paciente.apellido AS apellido_paciente,
            medico.nombre AS nombre_medico,
            medico.apellido AS apellido_medico,
            usuarios.nombre AS nombre_usuario,
            usuarios.apellido AS apellido_usuario,
            servicios.nombre AS nombre_servicio,
            consultorios.nombre AS nombre_consultorio
        FROM
            citas
        JOIN personas paciente ON citas.fk_persona = paciente.id
        JOIN usuarios medico_usuario ON citas.fk_usuario = medico_usuario.id
        JOIN personas medico ON medico_usuario.fk_persona = medico.id
        JOIN usuarios llave ON citas.fk_usuario_sesion = llave.id
		JOIN personas usuarios ON llave.fk_persona = usuarios.id
        JOIN servicios ON citas.fk_servicio = servicios.id
        JOIN consultorios ON citas.fk_consultorio = consultorios.id
        WHERE citas.estatus = '6'
		ORDER BY id ASC;";
    
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener la información de las citas: " . $e->getMessage();
            return false;
        }
    }

    public function obtenerInformacionHistoriasMedicasId() {
        try {
            $query = "SELECT
            citas.id,
            paciente.cedula AS cedula_paciente,
            paciente.correo AS correo_paciente,
            paciente.nombre AS nombre_paciente,
            paciente.segundo_nombre AS segundo_nombre_paciente,
            paciente.apellido AS apellido_paciente,
            paciente.segundo_apellido AS segundo_apellido_paciente,
            paciente.f_nacimiento AS fecha_nacimiento,
            paciente.sexo AS sexo,
            post_cita.altura AS altura_paciente,
            post_cita.peso AS peso_paciente,
            post_cita.tension AS tension_paciente,
            historia_cita.fk_cita_enfermeria AS llave_enfermeria,
            historia_cita.diagnostico AS diagnostico_paciente,
            llave_p.nombre AS patologia_paciente,
            llave_l.nombre AS laboratorio_paciente,
            medico.nombre AS nombre_medico,
            medico.apellido AS apellido_medico,
            servicios.nombre AS nombre_servicio,
            citas.fecha,
            citas.hora,
            citas.estatus,
            consultorios.nombre AS nombre_consultorio
        FROM
            citas
            JOIN personas paciente ON citas.fk_persona = paciente.id
            JOIN citas_enfermeria post_cita ON post_cita.fk_cita = citas.id
            JOIN usuarios medico_usuario ON citas.fk_usuario = medico_usuario.id
            JOIN personas medico ON medico_usuario.fk_persona = medico.id
            JOIN servicios ON citas.fk_servicio = servicios.id
            JOIN consultorios ON citas.fk_consultorio = consultorios.id
            JOIN historias_medicas historia_cita ON historia_cita.fk_cita_enfermeria = post_cita.id
            JOIN patologias llave_p ON llave_p.id = historia_cita.fk_patologia
            JOIN laboratorios llave_l ON llave_l.id = historia_cita.fk_laboratorio
        WHERE citas.id = :id";
    
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener la información de las citas: " . $e->getMessage();
            return false;
        }
    }
}