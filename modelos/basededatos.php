<?php
class BasedeDatos {
    const servidor = "localhost";
    const usuariobd = "root";
    const clave = "";
    const nombrebd = "mvc_ogfic_db"; // Aquí el nombre de la base de datos

    public static function Conectar() {
        try {
            $conexion = new PDO
            ("mysql:host=" . self::servidor . ";dbname=" . self::nombrebd, self::usuariobd, self::clave);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
        } catch (PDOException $e) {
            return("Error de conexión: " . $e->getMessage()); // Detener ejecución si hay error
        }
    }
}
?>
