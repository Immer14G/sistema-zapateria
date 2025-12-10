<?php
function nf($v) {
    return (is_numeric($v) ? number_format($v, 2) : "0.00");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Movimientos del Sistema</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background-color:#f4f6f9; }
.table th { background:#343a40;color:#fff;font-weight:bold; }
.card { border-radius:12px;box-shadow:0 4px 10px rgba(0,0,0,0.08); }
.titulo { font-weight:800;color:#2d3436; }
.badge-ticket { background-color:#6c5ce7; }
</style>
</head>
<body>
<div class="container mt-4">
<h3 class="titulo mb-4">📄 Historial de Ventas del Sistema</h3>

<div class="card p-4">
<table class="table table-striped table-hover text-center align-middle">
<thead>
<tr>
    <th>ID</th>
    <th>Tipo</th>
    <th>Producto ID</th>
    <th>Descripción</th>
    <th>Cantidad</th>
    <th>Precio Venta</th>
    <th>Monto</th>
    <th>Ganancia</th>
    <th>Usuario</th>
    <th>Fecha</th>
    <th>Ticket</th>
</tr>
</thead>
<tbody>
<?php foreach ($movimientos as $m): ?>
<tr>
    <td><?= $m['id'] ?></td>
    <td><?= $m['tipo'] ?></td>
    <td><?= $m['producto_id'] ?></td>
    <td><?= $m['descripcion'] ?></td>
    <td><?= $m['cantidad'] ?></td>
    <td>$<?= nf($m['precio_venta']) ?></td>
    <td>$<?= nf($m['monto']) ?></td>
    <td>$<?= nf($m['ganancia']) ?></td>
    <td><?= $m['usuario'] ?></td>
    <td><?= $m['fecha'] ?></td>
    <td>
        <a href="index.php?c=movimiento&a=pdfProducto&id=<?= $m['id'] ?>" 
           class="btn btn-sm btn-primary" target="_blank">Ticket</a>
    </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>

<a href="index.php?c=home&a=index" class="btn btn-secondary mt-3">Volver</a>
</div>
</body>
</html>
