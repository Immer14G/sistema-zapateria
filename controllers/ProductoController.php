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
        $productos = Producto::getAll();
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