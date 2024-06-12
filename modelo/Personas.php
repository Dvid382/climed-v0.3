<?php

//conexion
require_once '../config/Conexion.php';


class Persona  {

    //para la conexion
    private $conexion;

    public function __construct()
    {
        $this->conexion = (new Conexion())->Conectar();
    }

        //para los datos
        private $id;
        private $nombre;
        private $apellido; 
        private $cedula; 
        private $telefono;
        private $correo;
        private $sexo;
        private $direccion;
        private $f_nacimiento;
        private $estatus;
        private $segundo_nombre;
        private $segundo_apellido;

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
    
        public function getApellido(){
            return $this->apellido;
        }
    
        public function setApellido($apellido){
            $this->apellido = $apellido;
        }
    
        public function getCedula(){
            return $this->cedula;
        }
    
        public function setCedula($cedula){
            $this->cedula = $cedula;
        }
    
        public function getTelefono(){
            return $this->telefono;
        }
    
        public function setTelefono($telefono){
            $this->telefono = $telefono;
        }
    
        public function getCorreo(){
            return $this->correo;
        }
    
        public function setCorreo($correo){
            $this->correo = $correo;
        }
    
        public function getSexo(){
            return $this->sexo;
        }
    
        public function setSexo($sexo){
            $this->sexo = $sexo;
        }
    
        public function getDireccion(){
            return $this->direccion;
        }
    
        public function setDireccion($direccion){
            $this->direccion = $direccion;
        }
    
        public function getF_nacimiento(){
            return $this->f_nacimiento;
        }
    
        public function setF_nacimiento($f_nacimiento){
            $this->f_nacimiento = $f_nacimiento;
        }
    
        public function getEstatus(){
            return $this->estatus;
        }
    
        public function setEstatus($estatus){
            $this->estatus = $estatus;
        }
    
        public function getSegundo_nombre(){
            return $this->segundo_nombre;
        }
    
        public function setSegundo_nombre($segundo_nombre){
            $this->segundo_nombre = $segundo_nombre;
        }
    
        public function getSegundo_apellido(){
            return $this->segundo_apellido;
        }
    
        public function setSegundo_apellido($segundo_apellido){
            $this->segundo_apellido = $segundo_apellido;
        }
   
        public function crearPersona($nombre, $apellido, $cedula, $telefono, $correo, $sexo, $direccion, $f_nacimiento , $estatus, $segundo_nombre, $segundo_apellido) {
           
            try {
            $query = "INSERT INTO personas (nombre, apellido, cedula, telefono, correo, sexo, direccion, f_nacimiento, estatus, segundo_nombre, segundo_apellido) 
                      VALUES (:nombre, :apellido, :cedula, :telefono, :correo, :sexo, :direccion, :f_nacimiento, :estatus, :segundo_nombre, :segundo_apellido)";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':cedula', $cedula);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':sexo', $sexo);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':f_nacimiento', $f_nacimiento);
            $stmt->bindParam(':estatus', $estatus);
            $stmt->bindParam(':segundo_nombre', $segundo_nombre);
            $stmt->bindParam(':segundo_apellido', $segundo_apellido);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al crear el Persona: " . $e->getMessage();
            return false;
        }
        }
        
        
        public function eliminarPersona($id) {
            $query = "UPDATE personas SET estatus = 0 WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }
        
        public function verTodosPersonas() {
            $query = "SELECT * FROM personas order by id asc";
            $stmt = $this->conexion->query($query);
            return $stmt->fetchAll();
        }
        
        public function verPersonaPorId($id) {
            $query = "SELECT * FROM personas WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
        }

        public function verPersonaPorCedula($cedula) {
            $query = "SELECT * FROM personas WHERE cedula = :cedula";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':cedula', $cedula);
            $stmt->execute();
            return $stmt->fetch();
        }
        public function modificarPersona($id, $nombre, $apellido, $cedula, $telefono, $correo, $sexo, $direccion, $f_nacimiento , $estatus, $segundo_nombre, $segundo_apellido) {
            
            try {
                $query = "UPDATE personas 
                SET nombre = :nombre, apellido = :apellido, cedula = :cedula, telefono = :telefono, correo = :correo, sexo = :sexo, direccion = :direccion, f_nacimiento = :f_nacimiento, estatus = :estatus, segundo_nombre = :segundo_nombre, segundo_apellido = :segundo_apellido
                WHERE id = :id";
                $stmt = $this->conexion->prepare($query);
                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':nombre', $nombre);
                $stmt->bindParam(':apellido', $apellido);
                $stmt->bindParam(':cedula', $cedula);
                $stmt->bindParam(':telefono', $telefono);
                $stmt->bindParam(':correo', $correo);
                $stmt->bindParam(':sexo', $sexo);
                $stmt->bindParam(':direccion', $direccion);
                $stmt->bindParam(':f_nacimiento', $f_nacimiento);
                $stmt->bindParam(':estatus', $estatus);
                $stmt->bindParam(':segundo_nombre', $segundo_nombre);
                $stmt->bindParam(':segundo_apellido', $segundo_apellido);
                $stmt->execute();
                
                return true;
                } catch(PDOException $e) {
                    echo "Error al editar la Persona: " . $e->getMessage();
                    return false;
                }
        }
        
       

        public function buscarPersonaPorId($id) {
            $query = "SELECT * FROM personas WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
        }
        
        public function buscarPersonaPorNombre($nombre) {
            $query = "SELECT * FROM personas WHERE nombre = :nombre";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        
        
        public function verificarPersonaExistente($cedula) {
            $query = "SELECT COUNT(*) as count FROM personas WHERE cedula = :cedula";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':cedula', $cedula);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result['count'] > 0;
        }
        
          
    public function verificarEstatus($estatus) {
        $query = "SELECT estatus FROM personas";
        $stmt = $this->conexion->query($query);
        return $stmt->fetchAll();
    }
    

}