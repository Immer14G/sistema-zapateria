<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <style>
      body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
      .ticket { width: 100%; max-width: 420px; margin: auto; }
      .header { text-align: center; margin-bottom: 20px; }
      table { width: 100%; border-collapse: collapse; }
      th, td { border: 1px solid #000; padding: 5px; }
      .total { text-align: right; margin-top: 15px; font-size: 16px; font-weight: bold; }
  </style>
</head>

<body>
<div class="ticket">
    <div class="header">
        <h2>FACTURA</h2>
        <p>N° <?= $factura["factura_id"] ?></p>
        <p>Fecha: <?= $factura["fecha"] ?></p>
        <p>Vendedor: <?= htmlspecialchars($factura["vendedor"]) ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cant.</th>
                <th>Precio</th>
                <th>Subt.</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($factura["productos"] as $p): ?>
            <tr>
                <td><?= htmlspecialchars($p["producto"]) ?></td>
                <td><?= $p["cantidad"] ?></td>
                <td>$<?= number_format($p["precio"], 2) ?></td>
                <td>$<?= number_format($p["subtotal"], 2) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="total">
        TOTAL: $<?= number_format($factura["total"], 2) ?>
    </div>
</div>
</body>
</html>
