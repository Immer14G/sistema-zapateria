<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Dashboard - Zapatería</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<style>
    body { background: #f4f6f9; }
    .navbar { background: #343a40 !important; }
    .navbar-brand { font-weight: bold; color: #fff !important; }
    .card-custom { border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,.1); transition: .2s; }
    .card-custom:hover { transform: translateY(-3px); }
    .list-group-item { border: none; padding: .9rem 1.2rem; font-size: 15px; }
    .list-group-item:hover { background: #e9ecef; }
</style>
</head>
<body>
<?php $rol = $_SESSION['user']['rol'] ?? ''; ?>
<nav class="navbar navbar-expand-lg shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">👟 Zapatería</a>
    <div class="d-flex align-items-center text-white">
      <i class="bi bi-person-circle fs-5 me-2"></i>
      <span class="me-3 fw-semibold"><?= htmlspecialchars($_SESSION['user']['nombre'] ?? 'Usuario'); ?></span>
      <a class="btn btn-outline-light btn-sm" href="index.php?c=auth&a=logout"><i class="bi bi-box-arrow-right"></i> Salir</a>
    </div>
  </div>
</nav>
<div class="container mt-4">
    <h3 class="mb-4 fw-bold">📊 Panel de Control</h3>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card card-custom p-0">
                <div class="card-header bg-dark text-white fw-bold"><i class="bi bi-menu-button-wide"></i> Menú principal</div>
                <div class="list-group list-group-flush">
                    <?php if ($rol === 'admin'): ?>
                        <a class="list-group-item" href="index.php?c=producto&a=index"><i class="bi bi-box-seam"></i> Productos</a>
                        <a class="list-group-item" href="index.php?c=movimiento&a=index"><i class="bi bi-arrow-left-right"></i> Movimientos</a>
                        <li class="nav-item">
                        <a class="nav-link" href="index.php?c=reporte&a=facturas">Reportes</a>
                        </li>
                    <?php endif; ?>
                    <a class="list-group-item" href="index.php?c=venta&a=create"><i class="bi bi-cart-check"></i> Ventas</a>
                </div>
            </div>
        </div>
        <div class="col-md-8 mb-4">
            <div class="card card-custom p-4">
                <h5 class="fw-bold mb-3">⚡ Accesos rápidos</h5>
                <?php if ($rol === 'admin'): ?>
                    <a class="btn btn-outline-primary btn-sm me-2" href="index.php?c=categoria&a=index"><i class="bi bi-tags"></i> Categorías</a>
                    <a class="btn btn-outline-primary btn-sm me-2" href="index.php?c=proveedor&a=index"><i class="bi bi-truck"></i> Proveedores</a>
                    <a class="btn btn-outline-secondary btn-sm" href="index.php?c=producto&a=create"><i class="bi bi-plus-circle"></i> Nuevo Producto</a>
                <?php else: ?>
                    <p class="text-muted">Solo tienes acceso a Ventas.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>