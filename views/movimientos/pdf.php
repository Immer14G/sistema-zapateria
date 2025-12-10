<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reporte de Movimientos</title>
<style>
table { width: 100%; border-collapse: collapse; font-size: 12px; }
th, td { border: 1px solid #333; padding: 4px; text-align: left; }
th { background: #222; color: white; }
</style>
</head>
<body>

<h2>📄 Reporte de Movimientos</h2>

<table>
<thead>
<tr>
    <th>ID</th>
    <th>Factura</th>
    <th>Producto</th>
    <th>Descripción</th>
    <th>Cantidad</th>
    <th>Precio Venta</th>
    <th>Ganancia</th>
    <th>Usuario</th>
    <th>Fecha</th>
</tr>
</thead>

<tbody>
<?php foreach ($movimientos as $m): ?>
<tr>
    <td><?= $m['id'] ?></td>
    <td><?= $m['factura_id'] ?: '-' ?></td>
    <td><?= $m['producto'] ?: '-' ?></td>
    <td><?= $m['descripcion'] ?></td>
    <td><?= $m['cantidad'] ?></td>
    <td><?= $m['precio_venta'] ? '$'.number_format($m['precio_venta'], 2) : '-' ?></td>
    <td><?= $m['ganancia'] ? '$'.number_format($m['ganancia'], 2) : '-' ?></td>
    <td><?= $m['usuario'] ?></td>
    <td><?= $m['fecha'] ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

</body>
</html>
