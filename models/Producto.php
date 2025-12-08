<?php
require_once 'config/database.php';
class Producto {
    public static function getAll() {
        global $conexion;
        $stmt = $conexion->query("SELECT p.*, c.nombre as categoria, pr.nombre as proveedor
            FROM productos p
            LEFT JOIN categorias c ON p.categoria_id = c.id
            LEFT JOIN proveedores pr ON p.proveedor_id = pr.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        global $conexion;
        $stmt = $conexion->prepare('INSERT INTO productos (nombre, categoria_id, proveedor_id, precio_compra, precio_venta, stock) VALUES (?,?,?,?,?,?)');
        $stmt->execute([
            $data['nombre'],
            $data['categoria_id'],
            $data['proveedor_id'],
            $data['precio_compra'],
            $data['precio_venta'],
            $data['stock']
        ]);
    }

    public static function find($id) {
        global $conexion;
        $stmt = $conexion->prepare('SELECT * FROM productos WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($id, $data) {
        global $conexion;
        $stmt = $conexion->prepare('UPDATE productos SET nombre=?, categoria_id=?, proveedor_id=?, precio_compra=?, precio_venta=?, stock=? WHERE id=?');
        $stmt->execute([
            $data['nombre'],
            $data['categoria_id'],
            $data['proveedor_id'],
            $data['precio_compra'],
            $data['precio_venta'],
            $data['stock'],
            $id
        ]);
    }

    public static function delete($id) {
        global $conexion;
        $stmt = $conexion->prepare('DELETE FROM productos WHERE id=?');
        $stmt->execute([$id]);
    }

    public static function decreaseStock($id, $qty) {
        global $conexion;
        $stmt = $conexion->prepare('UPDATE productos SET stock = stock - ? WHERE id = ?');
        $stmt->execute([$qty, $id]);
    }

    public static function getCategorias() {
        global $conexion;
        $stmt = $conexion->query('SELECT * FROM categorias');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getProveedores() {
        global $conexion;
        $stmt = $conexion->query('SELECT * FROM proveedores');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>