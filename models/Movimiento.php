<?php
require_once './config/database.php';

class Movimiento {

    public static function registrarProductoVendido($producto_id, $cantidad, $precio_venta, $usuario_id) {
        global $conexion;

        $stmt = $conexion->prepare("SELECT precio_compra, nombre FROM productos WHERE id = ?");
        $stmt->execute([$producto_id]);
        $producto = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$producto) return false;

        $costo = (float)$producto['precio_compra'];
        $nombre_producto = $producto['nombre'];
        $cantidad = (int) $cantidad;
        $precio_venta = (float) $precio_venta;
        $monto = $precio_venta * $cantidad;
        $ganancia = ($precio_venta - $costo) * $cantidad;
        $descripcion = "Producto vendido: $nombre_producto";

        $stmt = $conexion->prepare("
            INSERT INTO movimientos 
            (tipo, producto_id, descripcion, cantidad, precio_venta, monto, ganancia, usuario_id, fecha)
            VALUES ('venta', ?, ?, ?, ?, ?, ?, ?, NOW())
        ");
        return $stmt->execute([
            $producto_id,
            $descripcion,
            $cantidad,
            $precio_venta,
            $monto,
            $ganancia,
            $usuario_id
        ]);
    }

    public static function registrar($tipo, $descripcion) {
        global $conexion;
        $usuario_id = $_SESSION['user']['id'] ?? null;

        $stmt = $conexion->prepare("
            INSERT INTO movimientos (tipo, descripcion, usuario_id, fecha)
            VALUES (?, ?, ?, NOW())
        ");
        return $stmt->execute([$tipo, $descripcion, $usuario_id]);
    }

    public static function getAll() {
        global $conexion;

        $stmt = $conexion->query("
            SELECT 
                m.*, 
                p.nombre AS producto, 
                p.precio_compra,
                u.nombre AS usuario
            FROM movimientos m
            LEFT JOIN productos p ON m.producto_id = p.id
            LEFT JOIN usuarios u ON m.usuario_id = u.id
            WHERE m.tipo = 'venta'
            ORDER BY m.id DESC
        ");

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data as &$m) {
            if ($m['precio_compra'] !== null && $m['cantidad'] !== "-" && $m['cantidad'] !== 0) {
                $monto = $m['precio_venta'] * $m['cantidad'];
                $ganancia = ($m['precio_venta'] - $m['precio_compra']) * $m['cantidad'];
                $m['monto'] = $monto;
                $m['ganancia'] = $ganancia;
            }

            foreach ($m as $k => $v) {
                if ($v === null || $v === "") $m[$k] = "-";
            }
        }

        return $data;
    }

    public static function getById($id) {
        global $conexion;

        $stmt = $conexion->prepare("
            SELECT 
                m.*, 
                p.nombre AS producto, 
                p.precio_compra,
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
