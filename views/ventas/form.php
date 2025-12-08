<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nueva venta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-4">
    <h3>Nueva venta</h3>

    <form method="POST" action="index.php?c=venta&a=store">

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Producto</th>
                    <th>Costo (Compra)</th>
                    <th>Precio Venta</th>
                    <th>Cantidad</th>
                    <th></th>
                </tr>
            </thead>

            <tbody id="rows">
                <tr>
                    <!-- PRODUCTO -->
                    <td>
                        <select name="producto_id[]" class="form-control producto-select" onchange="updatePrice(this)" required>
                            <option value="">-- Seleccione --</option>

                            <?php foreach ($productos as $p): ?>
                                <option 
                                    value="<?= $p['id'] ?>"
                                    data-costo="<?= $p['precio_compra'] ?>"
                                    data-precio="<?= $p['precio_venta'] ?>"
                                >
                                    <?= $p['nombre'] ?> (Stock: <?= $p['stock'] ?>)
                                </option>
                            <?php endforeach; ?>

                        </select>
                    </td>

                    <!-- COSTO (SOLO LECTURA) -->
                    <td>
                        <input type="number" name="costo[]" class="form-control costo" readonly>
                    </td>

                    <!-- PRECIO VENTA (EDITABLE) -->
                    <td>
                        <input type="number" name="precio_venta[]" class="form-control precio" min="0" step="0.01" required>
                    </td>

                    <!-- CANTIDAD -->
                    <td>
                        <input type="number" name="cantidad[]" class="form-control cantidad" min="1" value="1" required>
                    </td>

                    <!-- ELIMINAR FILA -->
                    <td>
                        <button type="button" class="btn btn-danger" onclick="removeRow(this)">X</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Botones -->
        <button type="button" class="btn btn-primary" onclick="addRow()">Agregar producto</button>
        <button class="btn btn-success">Registrar venta</button>
        <a href="index.php?c=home&a=index" class="btn btn-secondary">Regresar</a>

    </form>
</div>

<script>
function updatePrice(select) {
    const option = select.options[select.selectedIndex];

    const costo = option.dataset.costo;
    const precio = option.dataset.precio;

    const row = select.closest('tr');

    row.querySelector(".costo").value = costo;
    row.querySelector(".precio").value = precio;
}

function addRow() {
    const row = document.querySelector('#rows tr').cloneNode(true);

    // limpiar valores de la fila nueva
    row.querySelector(".producto-select").value = "";
    row.querySelector(".costo").value = "";
    row.querySelector(".precio").value = "";
    row.querySelector(".cantidad").value = 1;

    document.getElementById('rows').appendChild(row);
}

function removeRow(btn) {
    const totalRows = document.querySelectorAll('#rows tr').length;
    if (totalRows > 1) btn.closest('tr').remove();
}
</script>

</body>
</html>
