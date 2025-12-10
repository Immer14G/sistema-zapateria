<?php
require_once './config/database.php';

class Movimiento {

    // Registrar movimiento general
    public static function registrar($tipo, $descripcion) {
        global $conexion;

        $usuario_id = $_SESSION['user']['id'] ?? null;

        $stmt = $conexion->prepare("
            INSERT INTO movimientos (tipo, descripcion, usuario_id, fecha)
            VALUES (?, ?, ?, NOW())
        ");
        $stmt->execute([$tipo, $descripcion, $usuario_id]);
    }

    // Registrar factura completa
    public static function registrarFactura($factura_id, $total, $usuario_id) {
        global $conexion;

        $descripcion = "Factura #$factura_id generada. Total: $$total";

        $stmt = $conexion->prepare("
            INSERT INTO movimientos (tipo, descripcion, factura_id, usuario_id, fecha)
            VALUES ('factura', ?, ?, ?, NOW())
        ");
        $stmt->execute([$descripcion, $factura_id, $usuario_id]);
    }

    // Registrar producto vendido con ganancia correcta
    public static function registrarProductoVendido(
        $factura_id,
        $producto_id,
        $nombre_producto,
        $cantidad,
        $precio_venta,
        $costo_unitario,
        $usuario_id
    ) {
        global $conexion;

        // GANANCIA = (precio venta - costo) * cantidad
        $ganancia = ($precio_venta - $costo_unitario) * $cantidad;

        $descripcion = "Producto vendido: $nombre_producto";

        $stmt = $conexion->prepare("
            INSERT INTO movimientos 
            (tipo, factura_id, producto_id, descripcion, cantidad, precio_venta, ganancia, usuario_id, fecha)
            VALUES ('venta', ?, ?, ?, ?, ?, ?, ?, NOW())
        ");

        $stmt->execute([
            $factura_id,
            $producto_id,
            $descripcion,
            $cantidad,
            $precio_venta,
            $ganancia,
            $usuario_id
        ]);
    }

    // Obtener movimientos
    public static function getAll() {
        global $conexion;

        $stmt = $conexion->query("
            SELECT 
                m.*, 
                p.nombre AS producto, 
                u.nombre AS usuario
            FROM movimientos m
            LEFT JOIN productos p ON m.producto_id = p.id
            LEFT JOIN usuarios u ON m.usuario_id = u.id
            ORDER BY m.id DESC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un movimiento por ID (para ticket individual)
    public static function getById($id) {
        global $conexion;

        $stmt = $conexion->prepare("
            SELECT 
                m.*, 
                p.nombre AS producto, 
                u.nombre AS usuario
            FROM movimientos m
            LEFT JOIN productos p ON m.producto_id = p.id
            LEFT JOIN usuarios u ON m.usuario_id = u.id
            WHERE m.id = ?
        ");

        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
