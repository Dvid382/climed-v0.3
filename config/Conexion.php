<?php
class Conexion
{

    private $host = "localhost";  // Reemplazar con la dirección del servidor PostgreSQL
    private $dbname = "climed";
    private $user = "postgres";      // Reemplazar con el usuario de PostgreSQL
    private $pass = "123456";          // Reemplazar con la contraseña de PostgreSQL

    public function Conectar()
    {

        try {
            // Cambiamos el DSN (Data Source Name) para PostgreSQL
            $conexion = new PDO("pgsql:host={$this->host};dbname={$this->dbname}", $this->user, $this->pass);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;

        } catch (PDOException $e) {
            echo "Error de conexion: " . $e->getMessage();
        }

    }

}
