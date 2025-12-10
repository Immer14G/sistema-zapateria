<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Movimientos - Zapatería</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">

    <h3 class="mb-4 fw-bold">📄 Movimientos del Sistema</h3>

    <a href="index.php?c=movimiento&a=pdf" class="btn btn-danger mb-3">
        Descargar PDF
    </a>

    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
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
                <th>Ticket</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($movimientos as $m): ?>
                <tr>
                    <td><?= $m['id'] ?></td>
                    <td><?= $m['factura_id'] ?: '-' ?></td>
                    <td><?= $m['producto'] ?: '-' ?></td>
                    <td><?= $m['descripcion'] ?></td>
                    <td><?= $m['cantidad'] ?: '-' ?></td>
                    <td><?= $m['precio_venta'] ? '$'.number_format($m['precio_venta'], 2) : '-' ?></td>
                    <td><?= $m['ganancia'] ? '$'.number_format($m['ganancia'], 2) : '-' ?></td>
                    <td><?= $m['usuario'] ?: '-' ?></td>
                    <td><?= $m['fecha'] ?></td>

                    <!-- BOTÓN DE TICKET SOLO SI ES UNA VENTA -->
                    <td>
                        <?php if ($m['tipo'] === 'venta'): ?>
                            <a href="index.php?c=movimiento&a=pdfProducto&id=<?= $m['id'] ?>"
                               target="_blank"
                               class="btn btn-sm btn-primary">
                                Ticket
                            </a>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="index.php?c=home&a=index" class="btn btn-secondary">Volver</a>

</div>

</body>
</html>
