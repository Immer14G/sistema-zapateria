<?php
require_once './config/database.php';

class Movimiento {

    // Registrar encabezado de factura
    public static function registrarFactura($factura_id, $total, $usuario_id) {
        global $conexion;

        $descripcion = "Factura #$factura_id registrada por $$total";

        $stmt = $conexion->prepare("
            INSERT INTO movimientos (tipo, descripcion, factura_id, usuario_id, fecha)
            VALUES ('factura', ?, ?, ?, NOW())
        ");
        $stmt->execute([$descripcion, $factura_id, $usuario_id]);
    }

    // Registrar movimiento por producto vendido
    public static function registrarProductoVendido($factura_id, $producto_id, $nombre_producto, $cantidad, $precio_venta, $ganancia, $usuario_id) {
        global $conexion;

        $descripcion = "Producto vendido: $nombre_producto";

        $stmt = $conexion->prepare("
            INSERT INTO movimientos 
            (tipo, factura_id, producto_id, descripcion, cantidad, precio_venta, ganancia, usuario_id, fecha)
            VALUES 
            ('venta', ?, ?, ?, ?, ?, ?, ?, NOW())
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

    // Obtener movimientos agrupados por factura
    public static function getAll() {
        global $conexion;

        $stmt = $conexion->query("
            SELECT m.*, p.nombre AS producto, u.nombre AS usuario
            FROM movimientos m
            LEFT JOIN productos p ON m.producto_id = p.id
            LEFT JOIN usuarios u ON m.usuario_id = u.id
            ORDER BY factura_id DESC, fecha ASC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
