<?php

//conexion
require_once '../config/Conexion.php';
require_once 'Cargos.php';

//clase Roles
class Roles
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
    private $estatus;
    private $valor;
    private $descripcion;
    private $fk_cargo;
    

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

	public function getValor(){
		return $this->valor;
	}

	public function setValor($valor){
		$this->valor = $valor;
	}

    public function getestado(){
		return $this->estatus;
	}

	public function setestado($estatus){
		$this->valor = $estatus;
	}

    public function getdescripcion(){
		return $this->descripcion;
	}

	public function setdescripcion($descripcion){
		$this->valor = $descripcion;
	}

    public function getfk_cargo(){
		return $this->fk_cargo;
	}

	public function setfk_cargo($fk_cargo){
		$this->valor = $fk_cargo;
	}


    public function crearRol( $nombre, $estatus = 1, $valor, $descripcion, $fk_cargo) {
        try {
            $query = "INSERT INTO roles ( nombre, estatus, valor, descripcion, fk_cargo ) VALUES ( :nombre, :estatus, :valor, :descripcion, :fk_cargo)";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':estatus', $estatus);
            $stmt->bindParam(':valor', $valor);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':fk_cargo', $fk_cargo);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al crear los roles: " . $e->getMessage();
            return false;
        }
        
    }
    
    public function eliminarRol($id) {
        try {
            $query = "UPDATE roles SET estatus = 0 WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al eliminar los roles: " . $e->getMessage();
            return false;
        }
    }
    
    public function modificarRol($id, $nombre, $estatus, $valor, $descripcion, $fk_cargo) {
        try {
            $query = "UPDATE roles SET nombre = :nombre, estatus = :estatus, valor = :valor, descripcion = :descripcion, fk_cargo  = :fk_cargo  WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':estatus', $estatus);
            $stmt->bindParam(':valor', $valor);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':fk_cargo', $fk_cargo);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al modificar los roles: " . $e->getMessage();
            return false;
        }
    }
    
    
    public function verTodosRol() {
        try {
            $query = "SELECT 
            r.id,
            r.nombre,
            r.estatus,
            r.valor,
            r.descripcion,
            c.nombre AS nombre_cargo
        FROM 
            roles r
        JOIN 
            cargos c ON r. fk_cargo = c.id
        ORDER BY 
            r.id ASC;";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al obtener los roles: " . $e->getMessage();
            return false;
        }
    }
    
    public function verRolPorId($id) {
        try {
            $query = "SELECT * FROM roles WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al obtener los roles: " . $e->getMessage();
            return false;
        }
    }
    
    public function buscarRolPorId($id) {
        try {
            $query = "SELECT * FROM roles WHERE id LIKE :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindValue(':id', "%$id%");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al buscar los roles: " . $e->getMessage();
            return false;
        }
    }
    
    public function buscarRolPorNombre($nombre) {
        try {
            $query = "SELECT * FROM roles WHERE nombre LIKE :nombre";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindValue(':nombre', "%$nombre%");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al buscar los roles: " . $e->getMessage();
            return false;
        }
    }
    
    public function verificarRolExistente($nombre) {
        try {
            $query = "SELECT COUNT(*) FROM roles WHERE nombre = :nombre";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch(PDOException $e) {
            echo "Error al verificar los roles: " . $e->getMessage();
            return false;
        }
    }

    public function obtenerRolesMenusSubmenus() {
        try {
            $query = "SELECT 
            r.valor,
            r.nombre AS nombre_rol,
            m.nombre AS menu_nombre, 
            sm.nombre AS submenu_nombre
        FROM roles r
        LEFT JOIN roles_menu mr ON r.id = mr.fk_rol
        LEFT JOIN menus m ON mr.fk_menu = m.id
        LEFT JOIN submenus sm ON m.id = sm.fk_menus
        ORDER BY r.valor, r.nombre, m.nombre, sm.nombre";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;
        } catch (PDOException $e) {
            echo "Error al obtener roles, menus y submenús: " . $e->getMessage();
            return [];
        }
    }
    
    public function crearRolMenu($fk_rol, $fk_menu, $fk_submenu) {
        try {
            $query = "INSERT INTO roles_menu (fk_rol, fk_menu, fk_submenu) VALUES (:fk_rol, :fk_menu, :fk_submenu)";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':fk_rol', $fk_rol);
            $stmt->bindParam(':fk_menu', $fk_menu);
            $stmt->bindParam(':fk_submenu', $fk_submenu);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error al crear la asignación de rol, menú y submenu: " . $e->getMessage();
            return false;
        }
    }

    public function actualizarMenusSubMenusPorRol($rol_id, $fk_menus, $fk_submenus, $fk_usuario) {
        try {
            // Iniciar una transacción para garantizar la integridad de los datos
            $this->conexion->beginTransaction();
    
            // Eliminar los datos existentes en la tabla menu_usuario
            $query_eliminar = "DELETE FROM menu_usuario WHERE fk_usuario = :fk_usuario";
            $stmt_eliminar = $this->conexion->prepare($query_eliminar);
            $stmt_eliminar->bindParam(':fk_usuario', $fk_usuario);
            $stmt_eliminar->execute();
    
            // Insertar las nuevas asignaciones
            $query = "INSERT INTO roles_menu (fk_rol, fk_menu, fk_submenu) VALUES (:fk_rol, :fk_menu, :fk_submenu)";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':fk_rol', $rol_id);
    
            foreach ($fk_menus as $menu_id) {
                foreach ($fk_submenus as $submenu_id) {
                    $stmt->bindValue(':fk_menu', $menu_id);
                    $stmt->bindValue(':fk_submenu', $submenu_id);
                    $stmt->execute();
                    $last_insert_id = $this->conexion->lastInsertId();
    
                    // Insertar en la tabla usuario_menu
                    $query_usuario_menu = "INSERT INTO menu_usuario (fk_rol_menu, fk_usuario) VALUES (:fk_rol_menu, :fk_usuario)";
                    $stmt_usuario_menu = $this->conexion->prepare($query_usuario_menu);
                    $stmt_usuario_menu->bindParam(':fk_rol_menu', $last_insert_id);
                    $stmt_usuario_menu->bindParam(':fk_usuario', $fk_usuario);
                    $stmt_usuario_menu->execute();
                }
            }
    
            // Confirmar la transacción si todo se ejecutó correctamente
            $this->conexion->commit();
            return true;
        } catch (PDOException $e) {
            // Revertir la transacción en caso de error
            $this->conexion->rollBack();
            echo "Error al actualizar los menús y submenús por rol: " . $e->getMessage();
            return false;
        }
    }
    
    
    
    
    

public function eliminarMenusSubMenusPorRol($rol_id) {
    try {
        $query = "DELETE FROM roles_menu WHERE fk_rol = :fk_rol";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':fk_rol', $rol_id);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error al eliminar los menús y submenús por rol: " . $e->getMessage();
    }
}
public function eliminarRolesMenuUsuario($last_insert_id) {
    try {
        $query = "DELETE FROM menu_usuario WHERE fk_rol_menu = :fk_rol_menu";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':fk_rol_menu', $last_insert_id);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error al eliminar los menús y submenús por rol: " . $e->getMessage();
    }
}

    
    public function obtenerMenusSubMenusPorRol($rol_id) {
        try {
            $query = "SELECT 
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
                      FROM roles_menu rm
                      JOIN menus m ON rm.fk_menu = m.id  
                      JOIN submenus sm ON rm.fk_submenu = sm.id
                      WHERE rm.fk_rol = :rol_id
                      ORDER BY m.orden, sm.orden";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':rol_id', $rol_id);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;
        } catch (PDOException $e) {
            echo "Error al obtener menús y submenús por rol: " . $e->getMessage();
            return [];
        }
    }
    public function obtenerMenusSubMenusPorUsuario($fk_usuario) {
        try {
            $query = "SELECT
						u.id AS id_usuario,
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
					  JOIN usuarios u ON mu.fk_usuario = u.id
					  JOIN roles_menu rm ON mu.fk_rol_menu = rm.id
                      JOIN menus m ON rm.fk_menu = m.id  
                      JOIN submenus sm ON rm.fk_submenu = sm.id 
                      WHERE mu.fk_usuario = :fk_usuario
                      ORDER BY m.orden, sm.orden";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':fk_usuario', $fk_usuario);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;
        } catch (PDOException $e) {
            echo "Error al obtener menús y submenús por rol: " . $e->getMessage();
            return [];
        }
    }
    
    
}