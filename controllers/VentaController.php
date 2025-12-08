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

        // Se reciben arrays
        $productos = $_POST['producto_id'];
        $cantidades = $_POST['cantidad'];

        // Crear la venta vacía
        $ventaId = Venta::crearVentaBase($usuario_id);

        $totalVenta = 0;
        $gananciaVenta = 0;

        foreach ($productos as $i => $producto_id) {
            if (!$producto_id) continue;

            $cantidad = (int)$cantidades[$i];
            $producto = Producto::find($producto_id);

            if (!$producto) continue;
            if ($producto['stock'] < $cantidad) continue;

            $precio = $producto['precio_venta'];
            $costo  = $producto['precio_compra'];

            $total = $precio * $cantidad;
            $ganancia = ($precio - $costo) * $cantidad;

            // Registrar detalle
            Venta::agregarDetalle($ventaId, $producto_id, $cantidad, $precio);

            // Descontar stock
            Producto::decreaseStock($producto_id, $cantidad);

            // Registrar movimiento del producto
            Movimiento::registrarProductoVendido(
                $ventaId,  // factura_id REAL
                $producto_id,
                $producto['nombre'],
                $cantidad,
                $precio,
                $ganancia,
                $usuario_id
            );

            // Acumular totales
            $totalVenta += $total;
            $gananciaVenta += $ganancia;
        }

        // Registrar movimiento principal (encabezado factura)
        Movimiento::registrarFactura($ventaId, $totalVenta, $usuario_id);

        header('Location: index.php?c=venta&a=create');
    }
}
?>
