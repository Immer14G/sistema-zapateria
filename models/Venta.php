<?php
require_once 'config/database.php';

class Venta {

    public static function crearVentaBase($usuario_id) {
        global $conexion;

        $stmt = $conexion->prepare("INSERT INTO ventas (usuario_id, total, ganancia) VALUES (?,0,0)");
        $stmt->execute([$usuario_id]);

        return $conexion->lastInsertId();
    }

    public static function agregarDetalle($venta_id, $producto_id, $cantidad, $precio) {
        global $conexion;

        $stmt = $conexion->prepare("
            INSERT INTO venta_detalle (venta_id, producto_id, cantidad, precio)
            VALUES (?,?,?,?)
        ");
        $stmt->execute([$venta_id, $producto_id, $cantidad, $precio]);
    }

    public static function actualizarTotales($venta_id, $total, $ganancia) {
        global $conexion;

        $stmt = $conexion->prepare("
            UPDATE ventas SET total = ?, ganancia = ? WHERE id = ?
        ");
        $stmt->execute([$total, $ganancia, $venta_id]);
    }

    public static function getAll() {
        global $conexion;
        $stmt = $conexion->query("
            SELECT v.*, u.nombre AS usuario
            FROM ventas v
            LEFT JOIN usuarios u ON v.usuario_id = u.id
            ORDER BY v.fecha DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
