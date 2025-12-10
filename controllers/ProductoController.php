<?php
require_once 'models/Producto.php';
require_once 'models/Movimiento.php';

class ProductoController {
    private function soloAdmin() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['rol'] !== 'admin') {
            die('<h3 style="color:red;text-align:center">Acceso denegado (solo Administradores)</h3>');
        }
    }

    public function index() {
        if (!isset($_SESSION['user'])) header('Location: index.php?c=auth&a=login');

        $q = isset($_GET['q']) ? trim($_GET['q']) : '';

        global $conexion;
        if ($q) {
            // Busca coincidencias en nombre, categoría o proveedor
            $stmt = $conexion->prepare("
                SELECT p.*, c.nombre AS categoria, pr.nombre AS proveedor
                FROM productos p
                LEFT JOIN categorias c ON p.categoria_id = c.id
                LEFT JOIN proveedores pr ON p.proveedor_id = pr.id
                WHERE p.nombre LIKE :busqueda
                   OR c.nombre LIKE :busqueda
                   OR pr.nombre LIKE :busqueda
            ");
            $stmt->execute(['busqueda' => "%$q%"]);
            $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $productos = Producto::getAll();
        }

        require 'views/productos/index.php';
    }

    public function create() {
        $this->soloAdmin();
        $categorias = Producto::getCategorias();
        $proveedores = Producto::getProveedores();
        require 'views/productos/form.php';
    }

    public function store() {
        $this->soloAdmin();
        $data = [
            'nombre'=>$_POST['nombre'],
            'categoria_id'=>$_POST['categoria_id'],
            'proveedor_id'=>$_POST['proveedor_id'],
            'precio_compra'=>$_POST['precio_compra'],
            'precio_venta'=>$_POST['precio_venta'],
            'stock'=>$_POST['stock']
        ];
        Producto::create($data);
        Movimiento::registrar('crear_producto', "Se creó el producto: {$data['nombre']}"); 
        header('Location: index.php?c=producto&a=index');
    }

    public function edit() {
        $this->soloAdmin();
        $id = $_GET['id'] ?? null;
        if (!$id) header('Location: index.php?c=producto&a=index');
        $producto = Producto::find($id);
        $categorias = Producto::getCategorias();
        $proveedores = Producto::getProveedores();
        require 'views/productos/edit.php';
    }

    public function update() {
        $this->soloAdmin();
        $id = $_POST['id'];
        $data = [
            'nombre'=>$_POST['nombre'],
            'categoria_id'=>$_POST['categoria_id'],
            'proveedor_id'=>$_POST['proveedor_id'],
            'precio_compra'=>$_POST['precio_compra'],
            'precio_venta'=>$_POST['precio_venta'],
            'stock'=>$_POST['stock']
        ];
        Producto::update($id, $data);
        Movimiento::registrar('editar_producto', "Se editó el producto ID $id");
        header('Location: index.php?c=producto&a=index');
    }

    public function delete() {
        $this->soloAdmin();
        $id = $_GET['id'] ?? null;
        if ($id) {
            Producto::delete($id);
            Movimiento::registrar('eliminar_producto', "Se eliminó el producto ID $id");
        }
        header('Location: index.php?c=producto&a=index');
    }
}
?>
