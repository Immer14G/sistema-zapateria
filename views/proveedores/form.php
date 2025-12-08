<!doctype html><html><head><meta charset="utf-8"><title>Nuevo Proveedor</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head><body>
<div class="container mt-4">
  <h3>Nuevo Proveedor</h3>
  <form method="POST" action="index.php?c=proveedor&a=store">
    <div class="mb-2"><input class="form-control" name="nombre" placeholder="Nombre" required></div>
    <div class="mb-2"><input class="form-control" name="telefono" placeholder="Teléfono"></div>
    <div class="mb-2"><input class="form-control" name="email" placeholder="Email"></div>
    <div class="mb-2"><input class="form-control" name="direccion" placeholder="Dirección"></div>
    <button class="btn btn-success">Guardar</button>
    <a class="btn btn-secondary" href="index.php?c=proveedor&a=index">Cancelar</a>
  </form>
</div>
</body></html>
