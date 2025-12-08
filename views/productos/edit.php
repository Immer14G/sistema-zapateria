<!doctype html>
<html><head><meta charset="utf-8"><title>Editar producto</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head><body>
<div class="container mt-4">
    <h3>Editar producto</h3>
    <form method="POST" action="index.php?c=producto&a=update">
        <input type="hidden" name="id" value="<?= $producto['id'] ?>">
        <div class="mb-2"><input class="form-control" name="nombre" placeholder="Nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required></div>
        <div class="mb-2">
            <select class="form-control" name="categoria_id" required>
                <?php foreach($categorias as $c): ?>
                    <option value="<?= $c['id'] ?>" <?= $c['id']==$producto['categoria_id'] ? 'selected' : '' ?>><?= htmlspecialchars($c['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-2">
            <select class="form-control" name="proveedor_id" required>
                <?php foreach($proveedores as $p): ?>
                    <option value="<?= $p['id'] ?>" <?= $p['id']==$producto['proveedor_id'] ? 'selected' : '' ?>><?= htmlspecialchars($p['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-2"><input class="number form-control" name="precio_compra" placeholder="Precio compra" value="<?= $producto['precio_compra'] ?>" required></div>
        <div class="mb-2"><input class="number form-control" name="precio_venta" placeholder="Precio venta" value="<?= $producto['precio_venta'] ?>" required></div>
        <div class="mb-2"><input class="number form-control" name="stock" placeholder="Stock" value="<?= $producto['stock'] ?>" required></div>
        <button class="btn btn-success">Actualizar</button>
        <a class="btn btn-secondary" href="index.php?c=producto&a=index">Cancelar</a>
    </form>
</div>
</body></html>
