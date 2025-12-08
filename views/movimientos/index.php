<div class="container mt-4">
    <h3 class="mb-3">Movimientos</h3>

    <?php 
    $facturaActual = null;

    foreach ($movimientos as $m):

        if ($m['factura_id'] != $facturaActual):

            if ($facturaActual !== null) echo "</tbody></table><br>";

            $facturaActual = $m['factura_id'];
    ?>

        <h4>Factura #<?= $m['factura_id'] ?> — <?= $m['fecha'] ?> — <?= $m['usuario'] ?></h4>

        <a href="index.php?c=factura&a=pdf&id=<?= $m['factura_id'] ?>" 
           class="btn btn-danger btn-sm mb-2">PDF</a>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Ganancia</th>
                </tr>
            </thead>
            <tbody>

    <?php endif; ?>

    <tr>
        <td><?= $m['producto'] ?></td>
        <td><?= $m['cantidad'] ?></td>
        <td>$<?= number_format($m['precio_venta'],2) ?></td>
        <td>$<?= number_format($m['ganancia'],2) ?></td>
    </tr>

    <?php endforeach; ?>

    </tbody>
    </table>
</div>
