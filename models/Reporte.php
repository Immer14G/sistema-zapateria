<?php
require_once './config/database.php';

class Reporte {

    // Obtiene las facturas agrupadas correctamente
    public static function getFacturasDetalladasAgrupadas() {
        global $conexion;

        $sql = "SELECT
                    v.id AS factura_id,
                    v.fecha,
                    u.nombre AS vendedor,
                    p.nombre AS producto,
                    d.cantidad,
                    d.precio,
                    (d.cantidad * d.precio) AS subtotal
                FROM ventas v
                INNER JOIN usuarios u ON u.id = v.usuario_id
                INNER JOIN venta_detalle d ON d.venta_id = v.id
                INNER JOIN productos p ON p.id = d.producto_id
                ORDER BY v.id DESC";

        $stmt = $conexion->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $facturas = [];

        foreach ($rows as $r) {
            $id = $r['factura_id'];

            // Crear encabezado si no existe
            if (!isset($facturas[$id])) {
                $facturas[$id] = [
                    "factura_id" => $id,
                    "fecha" => $r['fecha'],
                    "vendedor" => $r['vendedor'],
                    "productos" => [],
                    "total" => 0
                ];
            }

            // Agregar productos a la factura
            $facturas[$id]["productos"][] = [
                "producto" => $r["producto"],
                "cantidad" => $r["cantidad"],
                "precio" => $r["precio"],
                "subtotal" => $r["subtotal"],
            ];

            // Total de la factura
            $facturas[$id]["total"] += $r["subtotal"];
        }

        return $facturas;
    }

    // Obtener una sola factura para el PDF
    public static function getFacturaById($id) {
        $facturas = self::getFacturasDetalladasAgrupadas();
        return $facturas[$id] ?? null;
    }
}
?>