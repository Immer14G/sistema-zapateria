<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Facturas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <h3>Facturas Registradas</h3>

  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>Factura</th>
        <th>Fecha</th>
        <th>Vendedor</th>
        <th>Total</th>
        <th>PDF</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($facturas as $f): ?>
      <tr>
        <td><?= $f['factura_id'] ?></td>
        <td><?= $f['fecha'] ?></td>
        <td><?= htmlspecialchars($f['vendedor']) ?></td>
        <td><b>$<?= number_format($f['total'], 2) ?></b></td>
        <td>
          <a href="index.php?c=reporte&a=facturaPDF&id=<?= $f['factura_id'] ?>" 
             class="btn btn-danger btn-sm">PDF</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <a href="index.php?c=home&a=index" class="btn btn-secondary">Volver</a>
</div>
</body>
</html>
