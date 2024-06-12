<?php

//conexion
require_once '../config/Conexion.php';

//clase Menus
class Menus
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
    private $url;
    private $icono;
    private $orden;
    

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

	public function getUrl(){
		return $this->url;
	}

	public function setUrl($url){
		$this->url = $url;
	}

	public function getIcono(){
		return $this->icono;
	}

	public function setIcono($icono){
		$this->icono = $icono;
	}

	public function getOrden(){
		return $this->orden;
	}

	public function setOrden($orden){
		$this->orden = $orden;
	}
    public function crearMenus($nombre, $url, $icono, $orden) {
        try {
            $query = "INSERT INTO menus ( nombre, url, icono, orden ) VALUES ( :nombre, :url, :icono, :orden )";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':url', $url);
            $stmt->bindParam(':icono', $icono);
            $stmt->bindParam(':orden', $orden);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al crear los Menus: " . $e->getMessage();
            return false;
        }
    }
    
    public function eliminarMenus($id) {
        try {
            $query = "DELETE FROM menus WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al eliminar el Menú: " . $e->getMessage();
            return false;
        }
    }
    
    public function modificarMenus($id, $nombre, $url, $icono, $orden) {
        try {
            $query = "UPDATE menus SET nombre = :nombre, url = :url, icono = :icono, orden = :orden  WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':url', $url);
            $stmt->bindParam(':icono', $icono);
            $stmt->bindParam(':orden', $orden);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al modificar los Menus: " . $e->getMessage();
            return false;
        }
    }
    
    public function verTodosMenus() {
        try {
            $query = "SELECT * FROM menus order by id asc";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($menus)) {
                return "No hay Menus creados en la base de datos. Presione el botón 'Nuevo Menus'.";
            } else {
                return $menus;
            }
        } catch(PDOException $e) {
            echo "Error al obtener los Menus: " . $e->getMessage();
            return false;
        }
    }
    
    public function verMenusPorId($id) {
        try {
            $query = "SELECT * FROM menus WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al obtener los Menus: " . $e->getMessage();
            return false;
        }
    }
    
    public function buscarMenusPorId($id) {
        try {
            $query = "SELECT * FROM menus WHERE id LIKE :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindValue(':id', "%$id%");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al buscar los Menus: " . $e->getMessage();
            return false;
        }
    }
    
    public function buscarMenusPorNombre($nombre) {
        try {
            $query = "SELECT * FROM menus WHERE nombre LIKE :nombre";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindValue(':nombre', "%$nombre%");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al buscar los Menus: " . $e->getMessage();
            return false;
        }
    }
    
    public function verificarMenusExistente($nombre) {
        try {
            $query = "SELECT COUNT(*) FROM menus WHERE nombre = :nombre";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch(PDOException $e) {
            echo "Error al verificar los Menus: " . $e->getMessage();
            return false;
        }
    }
    
}