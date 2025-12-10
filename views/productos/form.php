<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?= isset($producto) ? 'Editar' : 'Nuevo' ?> producto</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
.img-producto { width:80px; height:80px; object-fit:cover; border-radius:5px; }
</style>
</head>
<body>
<div class="container mt-4">
    <h3><?= isset($producto) ? 'Editar' : 'Nuevo' ?> producto</h3>

    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form method="POST" action="index.php?c=producto&a=<?= isset($producto) ? 'update' : 'store' ?>" enctype="multipart/form-data">
        <?php if(isset($producto)): ?>
            <input type="hidden" name="id" value="<?= $producto['id'] ?>">
        <?php endif; ?>

        <div class="mb-2">
            <input class="form-control" name="nombre" placeholder="Nombre" value="<?= isset($producto['nombre']) ? htmlspecialchars($producto['nombre']) : '' ?>" required>
        </div>

        <div class="mb-2">
            <select class="form-control" name="categoria_id" required>
                <option value="">-- Seleccione categoría --</option>
                <?php foreach($categorias as $c): ?>
                    <option value="<?= $c['id'] ?>" <?= isset($producto['categoria_id']) && $producto['categoria_id']==$c['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($c['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-2">
            <select class="form-control" name="proveedor_id" required>
                <option value="">-- Seleccione proveedor --</option>
                <?php foreach($proveedores as $p): ?>
                    <option value="<?= $p['id'] ?>" <?= isset($producto['proveedor_id']) && $producto['proveedor_id']==$p['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($p['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-2">
            <input type="number" step="0.01" class="form-control" name="precio_compra" placeholder="Precio compra" value="<?= isset($producto['precio_compra']) ? $producto['precio_compra'] : '' ?>" required>
        </div>

        <div class="mb-2">
            <input type="number" step="0.01" class="form-control" name="precio_venta" placeholder="Precio venta" value="<?= isset($producto['precio_venta']) ? $producto['precio_venta'] : '' ?>" required>
        </div>

        <div class="mb-2">
            <input type="number" class="form-control" name="stock" placeholder="Stock" value="<?= isset($producto['stock']) ? $producto['stock'] : '' ?>" required>
        </div>

        <div class="mb-2">
            <label>Imagen del producto</label>
            <input type="file" class="form-control" name="imagen" accept="image/*">
            <?php if(isset($producto['imagen']) && $producto['imagen'] != ''): ?>
                <img src="assets/img/productos/<?= $producto['imagen'] ?>" class="img-producto mt-2">
            <?php endif; ?>
        </div>

        <button class="btn btn-success"><?= isset($producto) ? 'Actualizar' : 'Guardar' ?></button>
        <a class="btn btn-secondary" href="index.php?c=producto&a=index">Cancelar</a>
    </form>
</div>
</body>
</html>
