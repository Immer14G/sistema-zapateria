<!doctype html><html><head><meta charset="utf-8"><title>Proveedores</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head><body>
<div class="container mt-4">
  <h3>Proveedores <a class="btn btn-sm btn-primary" href="index.php?c=proveedor&a=create">Nuevo</a></h3>
  <table class="table table-bordered">
    <thead><tr><th>ID</th><th>Nombre</th><th>Teléfono</th><th>Email</th><th>Dirección</th><th>Acciones</th></tr></thead>
    <tbody>
    <?php foreach($proveedores as $p): ?>
      <tr>
        <td><?= $p['id'] ?></td>
        <td><?= htmlspecialchars($p['nombre']) ?></td>
        <td><?= htmlspecialchars($p['telefono']) ?></td>
        <td><?= htmlspecialchars($p['email']) ?></td>
        <td><?= htmlspecialchars($p['direccion']) ?></td>
        <td><a class="btn btn-sm btn-danger" href="index.php?c=proveedor&a=delete&id=<?= $p['id'] ?>">Eliminar</a></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
  <a href="index.php?c=home&a=index" class="btn btn-secondary">Volver</a>
</div>
</body></html>
