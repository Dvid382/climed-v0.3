<?php

class HistoriasMedicas
{
        //para la conexion
        private $conexion;

        public function __construct()
        {
            $this->conexion = (new Conexion())->Conectar();
        }

    public function obtenerInformacionTodasHistoriasMedicas() {
        try {
            $query = "SELECT
            citas.id,
			citas.fecha,
            citas.hora,
            citas.estatus,
            citas.fk_usuario_sesion,
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
}