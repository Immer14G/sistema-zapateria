<!doctype html><html><head><meta charset="utf-8"><title>Categorias</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head><body>
<div class="container mt-4">
  <h3>Categorías <a class="btn btn-sm btn-primary" href="index.php?c=categoria&a=create">Nueva</a></h3>
  <table class="table table-bordered">
    <thead><tr><th>ID</th><th>Nombre</th><th>Acciones</th></tr></thead>
    <tbody>
    <?php foreach($categorias as $cat): ?>
      <tr>
        <td><?= $cat['id'] ?></td>
        <td><?= htmlspecialchars($cat['nombre']) ?></td>
        <td><a class="btn btn-sm btn-danger" href="index.php?c=categoria&a=delete&id=<?= $cat['id'] ?>">Eliminar</a></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
  <a href="index.php?c=home&a=index" class="btn btn-secondary">Volver</a>
</div>
</body></html>
