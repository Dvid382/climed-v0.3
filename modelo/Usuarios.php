<?php

//conexion
require_once '../config/Conexion.php';
require_once 'Roles.php';
require_once 'Personas.php';
require_once 'Servicios.php';

class Usuario extends Roles {

    //para la conexion
    private $conexion;

    public function __construct()
    {
        $this->conexion = (new Conexion())->Conectar();
    }

        //para los datos
        private $id;
        private $foto; 
        private $clave;
        private $fk_rol;
        private $fk_persona; 
        private $fk_servicio;
        private $estatus; 

        //setters y getters
        public function getId(){
            return $this->id;
        }
    
        public function setId($id){
            $this->id = $id;
        }
    
        public function getFoto(){
            return $this->foto;
        }
    
        public function setFoto($foto){
            $this->foto = $foto;
        }
    
        public function getClave(){
            return $this->clave;
        }
    
        public function setClave($clave){
            $this->clave = $clave;
        }
    
        public function getFk_rol(){
            return $this->fk_rol;
        }
    
        public function setFk_rol($fk_rol){
            $this->fk_rol = $fk_rol;
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
    
        public function getEstatus(){
            return $this->estatus;
        }
    
        public function setEstatus($estatus){
            $this->estatus = $estatus;
        }
        
        public function crearUsuario($foto, $clave, $fk_rol, $fk_persona, $fk_servicio, $estatus) {
            $clave_encriptada = password_hash($clave, PASSWORD_DEFAULT); // Encriptar la contraseña
            try {
            $query = "INSERT INTO usuarios ( foto, clave, fk_rol, fk_persona, fk_servicio, estatus) 
                      VALUES ( :foto, :clave, :fk_rol, :fk_persona, :fk_servicio, :estatus)";
            $stmt = $this->conexion->prepare($query);
           

            $stmt->bindParam(':foto', $foto);
            $stmt->bindParam(':clave', $clave_encriptada);
            $stmt->bindParam(':fk_rol', $fk_rol);
            $stmt->bindParam(":fk_persona", $fk_persona);
            $stmt->bindParam(':fk_servicio', $fk_servicio);
            $stmt->bindParam(':estatus', $estatus);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al crear el usuario: " . $e->getMessage();
            return false;
        }
        }

        public function getLastInsertId() {
            return $this->conexion->lastInsertId();
        }
        
        public function asignarMenuUsuario($fk_usuario, $fk_menu, $fk_submenu) {
            try {
                $query = "INSERT INTO menu_usuario (fk_usuario, fk_menu, fk_submenu) VALUES (:fk_usuario, :fk_menu, :fk_submenu)";
                $stmt = $this->conexion->prepare($query);
                $stmt->bindParam(':fk_usuario', $fk_usuario);
                $stmt->bindParam(':fk_menu', $fk_menu);
                $stmt->bindParam(':fk_submenu', $fk_submenu);
                return $stmt->execute(); // Retorna true si se ejecuta correctamente
            } catch (PDOException $e) {
                echo "Error al asignar menú y submenú al usuario: " . $e->getMessage();
                return false;
            }
        }

        public function eliminarMenusPorUsuario($fk_usuario) {
            try {
                $query = "DELETE FROM menu_usuario WHERE fk_usuario = :fk_usuario";
                $stmt = $this->conexion->prepare($query);
                $stmt->bindParam(':fk_usuario', $fk_usuario);
                return $stmt->execute(); // Retorna true si se ejecuta correctamente
            } catch (PDOException $e) {
                echo "Error al eliminar menús del usuario: " . $e->getMessage();
                return false;
            }
        }
        
        public function eliminarUsuario($id) {
            $query = "UPDATE usuarios SET estatus = 0 WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }
        
        public function verTodosUsuarios() {
            $query = "SELECT * FROM usuarios order by id asc";
            $stmt = $this->conexion->query($query);
            return $stmt->fetchAll();
        }

        public function verTodosAsignacion() {
            $query = "SELECT usuarios.id AS id_usuario, usuarios.fk_servicio AS servicio, personas.cedula AS cedula, personas.nombre AS nombre_usuario
            FROM usuarios 
            INNER JOIN personas ON usuarios.fk_persona = personas.id
             order by usuarios.id asc";
            $stmt = $this->conexion->query($query);
            return $stmt->fetchAll();
        }
        
        public function verUsuarioPorId($id) {
            $query = "SELECT * FROM usuarios WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
        }

        public function verDatosUsuarioPorId($id) {
            $query = "SELECT  p.id AS personas_id, p.nombre AS nombre, u.id AS usuario_id, u.fk_rol AS rol_usuario, r.nombre AS nombre_rol
                        FROM usuarios AS u
                        JOIN personas AS p ON u.fk_persona = p.id
                        JOIN roles AS r ON u.fk_rol = r.id
                        WHERE u.id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
        }

        public function modificarUsuario($id, $foto, $clave, $fk_rol, $fk_persona, $fk_servicio, $estatus) {
            $clave_encriptada = password_hash($clave, PASSWORD_DEFAULT); // Encriptar la contraseña
            try {
                $query = "UPDATE usuarios 
                SET   foto = :foto, clave = :clave, fk_rol = :fk_rol, fk_persona = :fk_persona, fk_servicio = :fk_servicio, estatus = :estatus 
                WHERE id = :id";
                $stmt = $this->conexion->prepare($query);
                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':foto', $foto);
                $stmt->bindParam(':clave', $clave_encriptada);
                $stmt->bindParam(':fk_rol', $fk_rol);
                $stmt->bindParam(":fk_persona", $fk_persona);
                $stmt->bindParam(':fk_servicio', $fk_servicio);
                $stmt->bindParam(':estatus', $estatus);
                $stmt->execute();
                return true;
                } catch(PDOException $e) {
                    echo "Error al crear el usuario: " . $e->getMessage();
                    return false;
                }
        }
        
        public function buscarNombreRol($fk_rol) {
            $query = "SELECT usuarios.id, roles.nombre AS nombre_rol, roles.valor AS valor_rol
            FROM usuarios
			JOIN roles ON usuarios.fk_rol = roles.id
            WHERE usuarios.fk_rol = :fk_rol";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':fk_rol', $fk_rol);
            $stmt->execute();
            return $stmt->fetch();
        }
        public function buscarDatosPersonas($fk_persona) {
            $query = "SELECT usuarios.*, personas.nombre AS nombre_persona, personas.apellido AS apellido_persona, personas.cedula AS cedula_persona, personas.correo AS correo_persona
            FROM usuarios
            JOIN personas ON usuarios.fk_persona = personas.id
            WHERE usuarios.fk_persona = :fk_persona";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':fk_persona', $fk_persona);
            $stmt->execute();
            return $stmt->fetch();
        }

        public function buscarDatosUsuarios($usuario_id) {
            $query = "SELECT id AS usuario_id, fk_rol AS rol_usuario
            FROM usuarios
            WHERE id = :usuario_id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':usuario_id', $usuario_id);
            $stmt->execute();
            return $stmt->fetch();
        }

                public function buscarServiciosPersonas($fk_persona) {
            $query = "SELECT usuarios.*, servicios.nombre AS nombre_servicio
            FROM usuarios
			JOIN personas ON usuarios.fk_persona = personas.id
            JOIN servicios ON usuarios.fk_servicio = servicios.id
            WHERE usuarios.fk_persona = :fk_persona";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':fk_persona', $fk_persona);
            $stmt->execute();
            return $stmt->fetch();
        }

        public function buscarUsuarioPorId($id) {
            $query = "SELECT * FROM usuarios WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
        }
        
        public function buscarUsuarioPorNombre($nombre) {
            $query = "SELECT * FROM usuarios WHERE nombre = :nombre";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        
        
        public function verificarUsuarioExistente($fk_persona) {
            $query = "SELECT COUNT(*) as count FROM usuarios WHERE fk_persona = :fk_persona";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':fk_persona', $fk_persona);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result['count'] > 0;
        }

        public function iniciarSesion($cedula, $clave) {
            $query = "SELECT personas.nombre AS nombre, personas.apellido AS apellido, usuarios.foto AS foto_usuario,usuarios.id AS id_usuario, personas.cedula AS cedula, Usuarios.fk_rol, Roles.id AS rol_id, Roles.nombre AS nombre_rol, roles.valor AS valor_rol, usuarios.clave, usuarios.estatus
            FROM Usuarios
            JOIN Roles ON Usuarios.fk_rol = Roles.id
			JOIN Personas ON Usuarios.fk_persona = Personas.id
            WHERE Personas.cedula = :cedula";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':cedula', $cedula);
            $stmt->execute();
            $usuario = $stmt->fetch();
            if ($usuario && password_verify($clave, $usuario['clave'])) {
                return $usuario; // Las contraseñas coinciden, iniciar sesión
            } else {
                return false; // Las contraseñas no coinciden, error de inicio de inicio de sesión
        }
    }
    
    public function verificarEstatus($estatus) {
        $query = "SELECT estatus FROM usuario";
        $stmt = $this->conexion->query($query);
        return $stmt->fetchAll();
    }

    public function obtenerNombreApellidoPersonaAsignacion($id) {
        // Consulta SQL para obtener el nombre y apellido de la persona asociada a la asignación
        $query = "SELECT personas.nombre AS nombre_usuario, personas.apellido AS apellido_usuario
                    FROM personas
                    INNER JOIN usuarios ON personas.id = usuarios.fk_persona
                    WHERE personas.id = :id ";
    
        // Preparar y ejecutar la consulta
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    
        // Obtener el resultado
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Devolver el resultado
        return $resultado;
    }

    public function obtenerDatosPorServicio($idServicios)
    {
        $query = "SELECT personas.nombre, personas.apellido
        FROM personas
        INNER JOIN usuarios ON personas.id = usuarios.fk_persona
        INNER JOIN servicios ON usuarios.fk_servicio = servicios.id
        WHERE servicios.id = :idServicios";
    
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':idServicios', $idServicios);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
/*     public function crearUsuarioMenu($fk_usuarios, $fk_roles_menu) {
        try {
            $query = "INSERT INTO roles_menu (fk_usuarios, fk_roles_menu)";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':fk_usuarios', $fk_usuarios);
            $stmt->bindParam(':fk_roles_menu', $fk_roles_menu);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error al crear la asignación de Usuario, Menu: " . $e->getMessage();
            return false;
        }
    } */

    public function obtenerMenusSubMenusPorUsuario($fk_usuario) {
        try {
            $query = "SELECT
                        mu.id AS id_menu_usuario,
                        mu.fk_usuario AS usuario_menu,
                        m.id AS menu_id, 
                        m.nombre AS menu_nombre, 
                        m.icono AS menu_icono, 
                        m.orden AS menu_orden,
                        sm.id AS submenu_id,
                        sm.nombre AS submenu_nombre, 
                        sm.icono AS submenu_icono, 
                        sm.url AS submenu_url,
                        sm.fk_menus AS submenu_menu,
                        sm.orden AS submenu_orden
                      FROM menu_usuario mu
                      JOIN menus m ON mu.fk_menu = m.id  
                      LEFT JOIN submenus sm ON mu.fk_submenu = sm.id
                      WHERE mu.fk_usuario = :fk_usuario
                      ORDER BY m.orden, sm.orden";
            
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':fk_usuario', $fk_usuario);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;
        } catch (PDOException $e) {
            echo "Error al obtener menús y submenús por usuario: " . $e->getMessage();
            return [];
        }
    }

    public function obtenerMenusPorRol($fk_rol) {
        try {
            $query = "SELECT
                        m.id AS id_menu,
                        rm.id AS id_roles_menu
                        FROM roles_menu rm 
                        JOIN menus m ON rm.fk_menu = m.id 
                        WHERE rm.fk_rol = :fk_rol";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':fk_rol', $fk_rol);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener menús por rol: " . $e->getMessage();
            return [];
        }
    }

    public function obtenerSubmenusPorMenu($menu_id) {
        try {
            $query = "SELECT id AS submenu_id, nombre, icono, url, fk_menus AS fk_menu
                      FROM submenus 
                      WHERE fk_menus = :menu_id
                      ORDER BY orden"; // Puedes ajustar el orden según tus necesidades
            
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':menu_id', $menu_id);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna todos los submenús asociados al menú
        } catch (PDOException $e) {
            echo "Error al obtener submenús por menú: " . $e->getMessage();
            return [];
        }
    }

    public function verificarMenuSubmenuExistente($fk_usuario, $fk_menu, $fk_submenu) {
        try {
            $query = "SELECT COUNT(*) FROM menu_usuario 
                      WHERE fk_usuario = :fk_usuario 
                      AND fk_menu = :fk_menu 
                      AND fk_submenu = :fk_submenu";
            
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':fk_usuario', $fk_usuario);
            $stmt->bindParam(':fk_menu', $fk_menu);
            $stmt->bindParam(':fk_submenu', $fk_submenu);
            $stmt->execute();
            
            return ($stmt->fetchColumn() > 0); // Retorna true si existe al menos una fila
        } catch (PDOException $e) {
            echo "Error al verificar existencia de menú y submenú: " . $e->getMessage();
            return false;
        }
    }

    public function verificarSubmenuPorMenu($menu_id, $submenu_id) {
        try {
            $query = "SELECT COUNT(*) FROM submenus WHERE fk_menus = :menu_id AND id = :submenu_id";
            
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':menu_id', $menu_id);
            $stmt->bindParam(':submenu_id', $submenu_id);
            $stmt->execute();
            
            return ($stmt->fetchColumn() > 0); // Retorna true si existe al menos una fila que coincida
        } catch (PDOException $e) {
            echo "Error al verificar existencia del submenú por menú: " . $e->getMessage();
            return false;
        }
    }

    public function eliminarMenuUsuario($fk_usuario, $fk_menu, $fk_submenu) {
        try {
            $query = "DELETE FROM menu_usuario WHERE fk_usuario = :fk_usuario AND fk_menu = :fk_menu AND fk_submenu = :fk_submenu";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':fk_usuario', $fk_usuario);
            $stmt->bindParam(':fk_menu', $fk_menu);
            $stmt->bindParam(':fk_submenu', $fk_submenu);
            return $stmt->execute(); // Retorna true si se ejecuta correctamente
        } catch (PDOException $e) {
            echo "Error al eliminar menú y submenú del usuario: " . $e->getMessage();
            return false;
        }
    }
}