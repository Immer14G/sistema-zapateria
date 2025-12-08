<?php
require_once 'config/database.php';
class Categoria {
    public static function getAll() {
        global $conexion;
        $stmt = $conexion->query('SELECT * FROM categorias');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function create($nombre) {
        global $conexion;
        $stmt = $conexion->prepare('INSERT INTO categorias (nombre) VALUES (?)');
        $stmt->execute([$nombre]);
    }
    public static function delete($id) {
        global $conexion;
        $stmt = $conexion->prepare('DELETE FROM categorias WHERE id=?');
        $stmt->execute([$id]);
    }
}
