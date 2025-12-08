<!doctype html>
<html><head><meta charset="utf-8"><title>Nuevo producto</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head><body>
<div class="container mt-4">
    <h3>Nuevo producto</h3>
    <form method="POST" action="index.php?c=producto&a=store">
        <div class="mb-2"><input class="form-control" name="nombre" placeholder="Nombre" required></div>
        <div class="mb-2">
            <select class="form-control" name="categoria_id" required>
                <option value="">-- Seleccione categoría --</option>
                <?php foreach($categorias as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-2">
            <select class="form-control" name="proveedor_id" required>
                <option value="">-- Seleccione proveedor --</option>
                <?php foreach($proveedores as $p): ?>
                    <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-2"><input class="number form-control" name="precio_compra" placeholder="Precio compra" required></div>
        <div class="mb-2"><input class="number form-control" name="precio_venta" placeholder="Precio venta" required></div>
        <div class="mb-2"><input class="number form-control" name="stock" placeholder="Stock" required></div>
        <button class="btn btn-success">Guardar</button>
        <a class="btn btn-secondary" href="index.php?c=producto&a=index">Cancelar</a>
    </form>
</div>
</body></html>
