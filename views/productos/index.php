<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Productos</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
.img-producto {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 5px;
}
</style>
</head>
<body>
<div class="container mt-4">

    <h3>Productos 
        <a class="btn btn-sm btn-primary" href="index.php?c=producto&a=create">Nuevo</a>
    </h3>

    <!-- BUSCADOR -->
    <form class="row g-3 mb-3" method="get" action="index.php">
        <input type="hidden" name="c" value="producto">
        <input type="hidden" name="a" value="index">
        <div class="col-auto">
            <input type="text" name="q" class="form-control" placeholder="Buscar por nombre, categoría o proveedor..." 
                   value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Buscar</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Categoria</th>
                <th>Proveedor</th>
                <th>Precio Venta</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($productos as $p): ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td>
                    <?php if(!empty($p['imagen']) && file_exists($p['imagen'])): ?>
                        <img src="<?= $p['imagen'] ?>" class="img-producto">
                    <?php else: ?>
                        <img src="assets/img/productos/default.png" class="img-producto">
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($p['nombre']) ?></td>
                <td><?= htmlspecialchars($p['categoria']) ?></td>
                <td><?= htmlspecialchars($p['proveedor']) ?></td>
                <td><?= $p['precio_venta'] ?></td>
                <td><?= $p['stock'] ?></td>
                <td>
                  <a class="btn btn-sm btn-warning" href="index.php?c=producto&a=edit&id=<?= $p['id'] ?>">Editar</a>
                  <a class="btn btn-sm btn-danger" href="index.php?c=producto&a=delete&id=<?= $p['id'] ?>" onclick="return confirm('Eliminar?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <a href="index.php?c=home&a=index" class="btn btn-secondary">Volver</a>

</div>
</body>
</html>
