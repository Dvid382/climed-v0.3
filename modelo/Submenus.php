<?php

//conexion
require_once '../config/Conexion.php';

//clase Submenus
class Submenus
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
    private $fk_menus;
    

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

    public function getFkMenus(){
        return $this->fk_menus;
    }

    public function setFkMenus($fk_menus){
        $this->fk_menus = $fk_menus;
    }
    public function crearSubmenus($nombre, $url, $icono, $orden, $fk_menus) {
        try {
            $query = "INSERT INTO submenus ( nombre, url, icono, orden, fk_menus ) VALUES ( :nombre, :url, :icono, :orden, :fk_menus )";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':url', $url);
            $stmt->bindParam(':icono', $icono);
            $stmt->bindParam(':orden', $orden);
            $stmt->bindParam(':fk_menus', $fk_menus);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al crear los Submenus: " . $e->getMessage();
            return false;
        }
    }
    
    public function eliminarSubmenus($id) {
        try {
            $query = "DELETE FROM submenus WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al eliminar el Menú: " . $e->getMessage();
            return false;
        }
    }
    
    public function modificarSubmenus($id, $nombre, $url, $icono, $orden, $fk_menus) {
        try {
            $query = "UPDATE submenus SET nombre = :nombre, url = :url, icono = :icono, orden = :orden, fk_menus = :fk_menus  WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':url', $url);
            $stmt->bindParam(':icono', $icono);
            $stmt->bindParam(':orden', $orden);
            $stmt->bindParam(':fk_menus', $fk_menus);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al modificar los Submenus: " . $e->getMessage();
            return false;
        }
    }
    
    public function verTodosSubmenus() {
        try {
            $query = "SELECT 
            c.id,
            c.nombre,
            c.url,
			c.icono,
            c.orden,
            s.nombre AS nombre_menu
        FROM 
            submenus c
        JOIN 
            menus s ON c.fk_menus = s.id
        ORDER BY 
            c.id ASC";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            $submenus = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($submenus)) {
                return "No hay Submenus creados en la base de datos. Presione el botón 'Nuevo Submenus'.";
            } else {
                return $submenus;
            }
        } catch(PDOException $e) {
            echo "Error al obtener los Submenus: " . $e->getMessage();
            return false;
        }
    }
    
    public function verSubmenusPorId($id) {
        try {
            $query = "SELECT * FROM submenus WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al obtener los Submenus: " . $e->getMessage();
            return false;
        }
    }
    
    
    
    public function buscarSubmenusPorId($id) {
        try {
            $query = "SELECT * FROM submenus WHERE id LIKE :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindValue(':id', "%$id%");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al buscar los Submenus: " . $e->getMessage();
            return false;
        }
    }
    
    public function buscarSubmenusPorNombre($nombre) {
        try {
            $query = "SELECT * FROM submenus WHERE nombre LIKE :nombre";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindValue(':nombre', "%$nombre%");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al buscar los Submenus: " . $e->getMessage();
            return false;
        }
    }
    
    public function verificarSubmenusExistente($nombre) {
        try {
            $query = "SELECT COUNT(*) FROM submenus WHERE nombre = :nombre";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch(PDOException $e) {
            echo "Error al verificar los Submenus: " . $e->getMessage();
            return false;
        }
    }
    public function verSubmenusPorMenu($menu_id) {
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
    public function verSubmenusPorMenus() {
        try {
            $query = "SELECT 
                        sm.id AS id_submenus,
                        sm.nombre,
                        m.id AS fk_menu
                      FROM submenus sm
                      JOIN menus m ON sm.fk_menus = m.id";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;
        } catch (PDOException $e) {
            echo "Error al obtener submenús por menús: " . $e->getMessage();
            return [];
        }
    }
    
}