<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<style> body { font-family: 'Courier New', monospace; font-size: 14px; text-align: center; }
 .ticket { width: 200px; margin: 0 auto; } 
 hr { border: 0; border-top: 1px dashed #000; }
 </style>
</head>
<body>

<div class="ticket">
    <img src="https://images.unsplash.com/photo-1600185361160-34c1b894b360?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxfDB8MXxyYW5kb218MHx8c2hvZXN8fDB8fHx8MTY5OTE5Mjg3Mg&ixlib=rb-4.0.3&q=80&w=400" alt="Tienda de zapatos">
    <h2>ZAPATERÍA</h2>
    <h4>Ticket Individual</h4>
    <hr>
    <p><strong>Producto:</strong><br><?= $mov['producto'] ?></p>
    <p><strong>Cantidad:</strong> <?= $mov['cantidad'] ?></p>
    <p><strong>Precio Unitario:</strong> $<?= number_format($mov['precio_venta'], 2) ?></p>
    <hr>
    <p class="total"><strong>Total:</strong> $<?= number_format($mov['cantidad'] * $mov['precio_venta'], 2) ?></p>
   
    <hr>
    <p><small>Atendido por: <?= $mov['usuario'] ?></small></p>
    <p><small><?= $mov['fecha'] ?></small></p>
    <hr>
    <p>¡Gracias por su compra!</p>
</div>

</body>
</html>
