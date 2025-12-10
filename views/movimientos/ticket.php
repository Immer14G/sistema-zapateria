<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<style>
body {
    font-family: 'Courier New', monospace;
    font-size: 14px;
    text-align: center;
}
.ticket {
    width: 200px;
    margin: 0 auto;
}
hr {
    border: 0;
    border-top: 1px dashed #000;
}
</style>
</head>
<body>

<div class="ticket">
    <h3>ZAPATERÍA</h3>
    <small>Ticket individual</small>
    <hr>

    <p><strong>Producto:</strong><br><?= $mov['producto'] ?></p>
    <p><strong>Cantidad:</strong> <?= $mov['cantidad'] ?></p>
    <p><strong>Precio Unitario:</strong> $<?= number_format($mov['precio_venta'], 2) ?></p>

    <hr>

    <p><strong>Total:</strong> $<?= number_format($mov['cantidad'] * $mov['precio_venta'], 2) ?></p>
    <p><strong>Ganancia:</strong> $<?= number_format($mov['ganancia'], 2) ?></p>

    <hr>
    <small>Atendido por: <?= $mov['usuario'] ?></small><br>
    <small><?= $mov['fecha'] ?></small>

    <hr>
    <p>¡Gracias por su compra!</p>
</div>

</body>
</html>
