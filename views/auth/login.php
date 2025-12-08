<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Inicio de sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow p-4" style="width: 100%; max-width: 420px; border-radius: 15px;">
        <h3 class="text-center mb-4">Iniciar sesión</h3>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger text-center"><?= $error ?></div>
        <?php endif; ?>

        <form action="index.php?c=auth&a=autenticar" method="POST">


            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input type="text" name="usuario" class="form-control" placeholder="example" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" placeholder="•••••••••" required>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-2">
                Ingresar
            </button>
        </form>

            </div>
        </div>

</body>
</html>
