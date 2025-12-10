<?php
require_once './models/Venta.php';
require_once './models/Producto.php';
require_once './models/Movimiento.php';

class VentaController {

    public function index() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['rol'] !== 'admin') {
            die("<h3 style='color:red;text-align:center'>Acceso denegado (solo Administradores)</h3>");
        }

        $ventas = Venta::getAll();
        require 'views/ventas/index.php';
    }

    public function create() {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?c=auth&a=login");
            exit;
        }

        $productos = Producto::getAll();
        require './views/ventas/form.php';
    }

    public function store() {

        if (!isset($_SESSION['user'])) {
            header("Location: index.php?c=auth&a=login");
            exit;
        }

        $usuario_id = $_SESSION['user']['id'];

        $productos  = $_POST['producto_id'];
        $cantidades = $_POST['cantidad'];

        $ventaId = Venta::crearVentaBase($usuario_id);

        $totalVenta   = 0;
        $gananciaVenta = 0;

        foreach ($productos as $i => $producto_id) {

            if (!$producto_id) continue;

            $cantidad = (int)$cantidades[$i];
            $producto = Producto::find($producto_id);

            if (!$producto) continue;

            // 🔹 VALIDACIÓN: si el stock es 0, no se puede vender
            if ($producto['stock'] <= 0) {
                continue; // o puedes mostrar un mensaje de advertencia
            }

            $precio = $producto['precio_venta'];
            $costo  = $producto['precio_compra'];

            $total    = $precio * $cantidad;
            $ganancia = ($precio - $costo) * $cantidad;

            Venta::agregarDetalle($ventaId, $producto_id, $cantidad, $precio);

            // Reducir stock
            Producto::decreaseStock($producto_id, $cantidad);

            // Registrar movimiento
            Movimiento::registrarProductoVendido(
                $producto_id,
                $cantidad,
                $precio,
                $usuario_id
            );

            $totalVenta   += $total;
            $gananciaVenta += $ganancia;
        }

        // Actualizar totales de la venta
        Venta::actualizarTotales($ventaId, $totalVenta, $gananciaVenta);

        header('Location: index.php?c=venta&a=create');
    }
}
?>
