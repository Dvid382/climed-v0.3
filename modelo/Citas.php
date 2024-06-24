<?php
class Citas
{

    //para la conexion
    private $conexion;

    public function __construct()
    {
        $this->conexion = (new Conexion())->Conectar();
    }

    private   $id;
    private   $fk_persona;
    private   $fk_servicio;
    private   $fk_usuario;
    private   $fecha;
    private   $hora;
    private   $estatus;
    private   $fk_usuario_sesion;
    private $fk_consultorio;
   
   public function getId(){
   return $this->id;
   }
   
   public function setId($id){
   $this->id = $id;
   }
   
   public function getFk_persona(){
   return $this->fk_persona;
   }
   
   public function setFk_persona($fk_persona){
   $this->fk_persona = $fk_persona;
   }
   
   public function getFk_servicio(){
   return $this->fk_servicio;
   }
   
   public function setFk_servicio($fk_servicio){
   $this->fk_servicio = $fk_servicio;
   }
   
   public function getFk_usuario(){
   return $this->fk_usuario;
   }
   
   public function setFk_usuario($fk_usuario){
   $this->fk_usuario = $fk_usuario;
   }
   
   public function getFecha(){
   return $this->fecha;
   }
   
   public function setFecha($fecha){
   $this->fecha = $fecha;
   }
   
   public function getHora(){
   return $this->hora;
   }
   
   public function setHora($hora){
   $this->hora = $hora;
   }
   
   public function getEstatus(){
   return $this->estatus;
   }
   
   public function setEstatus($estatus){
   $this->estatus = $estatus;
   }
   
   public function getFk_usuario_sesion(){
   return $this->fk_usuario_sesion;
   }
   
   public function setFk_usuario_sesion($fk_usuario_sesion){
   $this->fk_usuario_sesion = $fk_usuario_sesion;
   }

    public function setFkConsultorio($fk_consultorio) {
    $this->fk_consultorio = $fk_consultorio;
    }

   public function getFkConsultorio() {
    return $this->fk_consultorio;
    }



    public function crearCitas($fk_persona, $fk_servicio, $fk_usuario, $fecha, $hora, $estatus, $fk_usuario_sesion, $fk_consultorio) {
        try {
            $query = "INSERT INTO citas (fk_persona, fk_servicio, fk_usuario, fecha, hora, estatus, fk_usuario_sesion, fk_consultorio) 
                    VALUES (:fk_persona, :fk_servicio, :fk_usuario, :fecha, :hora, :estatus, :fk_usuario_sesion, :fk_consultorio)";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':fk_persona', $fk_persona);
            $stmt->bindParam(':fk_servicio', $fk_servicio);
            $stmt->bindParam(':fk_usuario', $fk_usuario);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':hora', $hora);
            $stmt->bindParam(':estatus', $estatus);
            $stmt->bindParam(':fk_usuario_sesion', $fk_usuario_sesion);
            $stmt->bindParam(':fk_consultorio', $fk_consultorio);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al crear la cita: " . $e->getMessage();
            return false;
        }
    }
    

    public function modificarCitas($id, $fk_persona, $fk_servicio, $fk_usuario, $fecha, $hora, $estatus, $fk_usuario_sesion) {
        try {
            $query = "UPDATE citas SET fk_persona = :fk_persona, fk_servicio = :fk_servicio, fk_usuario = :fk_usuario, fecha = :fecha, hora = :hora, estatus = :estatus, fk_usuario_sesion = :fk_usuario_sesion WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':fk_persona', $fk_persona);
            $stmt->bindParam(':fk_servicio', $fk_servicio);
            $stmt->bindParam(':fk_usuario', $fk_usuario);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':hora', $hora);
            $stmt->bindParam(':estatus', $estatus);
            $stmt->bindParam(':fk_usuario_sesion', $fk_usuario_sesion);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al modificar la cita: " . $e->getMessage();
            return false;
        }
    }

    public function eliminarCitas($id) {
        try {
            $query = "UPDATE citas SET estatus = 7 WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al eliminar la Cita: " . $e->getMessage();
            return false;
        }
    }
   
    public function verTodasCitas() {
        try {
            $query = "SELECT * FROM citas ORDER BY id ASC";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al recuperar todas las citas: " . $e->getMessage();
            return false;
        }
    }

    public function verCitasId($id) {
        try {
            $query = "SELECT * FROM citas WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al recuperar la cita con ID $id: " . $e->getMessage();
            return false;
        }
    }

    public function actualizarEstatusCitaCorreo($citaId, $nuevoEstatus)
    {
        try {
            $query = "UPDATE citas SET estatus = :nuevoEstatus WHERE id = :citaId";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nuevoEstatus', $nuevoEstatus);
            $stmt->bindParam(':citaId', $citaId);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error al actualizar el estatus de la cita: " . $e->getMessage();
            return false;
        }
    }

    public function actualizarEstatusConfirmarCorreo($citaId, $nuevoEstatus)
    {
        try {
            $query = "UPDATE citas SET estatus = :nuevoEstatus WHERE id = :citaId";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nuevoEstatus', $nuevoEstatus);
            $stmt->bindParam(':citaId', $citaId);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error al actualizar el estatus de la cita: " . $e->getMessage();
            return false;
        }
    }

    public function verCitasEnfermeriaPorId($id) {
        try {
            $query = "SELECT
            citas.id,
            paciente.cedula AS cedula_paciente,
            paciente.nombre AS nombre_paciente,
            paciente.apellido AS apellido_paciente,
            medico.nombre AS nombre_medico,
            medico.apellido AS apellido_medico,
            usuarios.nombre AS nombre_usuario,
            usuarios.apellido AS apellido_usuario,
            servicios.nombre AS nombre_servicio,
            citas.fecha,
            citas.hora,
            citas.estatus,
            citas.fk_usuario_sesion,
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
        WHERE citas.id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al recuperar la cita con ID $id: " . $e->getMessage();
            return false;
        }
    }
    
    public function InformacionPacientes() {
        try {
            $query = "SELECT
            citas.id,
            paciente.cedula AS cedula_paciente,
            paciente.nombre AS nombre_paciente,
            paciente.segundo_nombre AS segundo_nombre_paciente,
            paciente.apellido AS apellido_paciente,
            paciente.segundo_apellido AS segundo_apellido_paciente,
            paciente.sexo AS sexo_paciente,
            servicios.nombre AS nombre_servicio
        FROM citas
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

    public function obtenerInformacionCitas() {
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
        WHERE citas.fecha = CURRENT_DATE
		ORDER BY id ASC;";
    
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener la información de las citas: " . $e->getMessage();
            return false;
        }
    }
    

    public function obtenerInformacionCitasMedico($usuario_id) {
        try {
            $query = "SELECT
                citas.id,
                citas.fk_usuario AS usuario,
                paciente.nombre AS nombre_paciente,
                paciente.apellido AS apellido_paciente,
                medico.nombre AS nombre_medico,
                medico.apellido AS apellido_medico,
                usuarios.nombre AS nombre_usuario,
                usuarios.apellido AS apellido_usuario,
                servicios.nombre AS nombre_servicio,
                citas.fecha,
                citas.hora,
                citas.estatus,
                citas.fk_usuario_sesion,
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
            WHERE citas.fk_usuario = :usuario_id AND citas.estatus = '5' AND citas.fecha = CURRENT_DATE
            ORDER BY citas.id ASC";
    
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':usuario_id', $usuario_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener la información de las citas: " . $e->getMessage();
            return false;
        }
    }
    

    public function obtenerInformacionCitasEnfermeria() {
        try {
            $query = "SELECT
            citas.id,
            paciente.nombre AS nombre_paciente,
            paciente.apellido AS apellido_paciente,
            medico.nombre AS nombre_medico,
            medico.apellido AS apellido_medico,
            usuarios.nombre AS nombre_usuario,
            usuarios.apellido AS apellido_usuario,
            servicios.nombre AS nombre_servicio,
            citas.fecha,
            citas.hora,
            citas.estatus,
            citas.fk_usuario_sesion,
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
        WHERE citas.estatus = '3' AND citas.fecha = CURRENT_DATE
        ORDER BY id ASC;";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener la información de las citas: " . $e->getMessage();
            return false;
        }
    }

    public function obtenerInformacionCitasPorId($id) {
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
            medico.nombre AS nombre_medico,
            medico.apellido AS apellido_medico,
            usuarios.nombre AS nombre_usuario,
            usuarios.apellido AS apellido_usuario,
            servicios.nombre AS nombre_servicio,
            citas.fecha,
            citas.hora,
            citas.estatus,
            citas.fk_usuario_sesion,
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
    

   public function verificarCitasExistentes($fk_persona, $fk_servicio, $fk_usuario, $fecha, $hora) {
        try {
            $query = "SELECT * FROM citas WHERE fk_persona = :fk_persona AND fk_servicio = :fk_servicio AND
            fk_usuario = :fk_usuario AND fecha = :fecha AND hora = :hora";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':fk_persona', $fk_persona);
            $stmt->bindParam(':fk_servicio', $fk_servicio);
            $stmt->bindParam(':fk_usuario', $fk_usuario);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':hora', $hora);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch(PDOException $e) {
            echo "Error al verificar la Cita: " . $e->getMessage();
            return false;
        }
    }
   
}