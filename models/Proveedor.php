<?php
require_once 'config/database.php';
class Proveedor {
    public static function getAll() {
        global $conexion;
        $stmt = $conexion->query('SELECT * FROM proveedores');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function create($data) {
        global $conexion;
        $stmt = $conexion->prepare('INSERT INTO proveedores (nombre, telefono, email, direccion) VALUES (?,?,?,?)');
        $stmt->execute([$data['nombre'],$data['telefono'],$data['email'],$data['direccion']]);
    }
    public static function delete($id) {
        global $conexion;
        $stmt = $conexion->prepare('DELETE FROM proveedores WHERE id=?');
        $stmt->execute([$id]);
    }
}
?>