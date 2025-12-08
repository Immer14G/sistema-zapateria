<!doctype html><html><head><meta charset="utf-8"><title>Nueva Categoria</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head><body>
<div class="container mt-4">
  <h3>Nueva Categoría</h3>
  <form method="POST" action="index.php?c=categoria&a=store">
    <div class="mb-2"><input class="form-control" name="nombre" placeholder="Nombre" required></div>
    <button class="btn btn-success">Guardar</button>
    <a class="btn btn-secondary" href="index.php?c=categoria&a=index">Cancelar</a>
  </form>
</div>
</body></html>
