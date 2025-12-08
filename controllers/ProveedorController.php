<?php
require_once './models/Proveedor.php';
require_once './models/Movimiento.php';

class ProveedorController {

    private function soloAdmin() {
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            die("<h3 style='color:red;text-align:center'>Acceso denegado (solo Administradores)</h3>");
        }
    }

    public function index() {
        $proveedores = Proveedor::getAll();
        require 'views/proveedores/index.php';
    }

    public function create() {
        $this->soloAdmin();
        require 'views/proveedores/form.php';
    }

    public function store() {
        $this->soloAdmin();

        $data = [
            'nombre'=>$_POST['nombre'],
            'telefono'=>$_POST['telefono'],
            'email'=>$_POST['email'],
            'direccion'=>$_POST['direccion']
        ];

        Proveedor::create($data);
        Movimiento::registrar('crear_proveedor', "Se creó el proveedor: {$data['nombre']}"); 
        
        header('Location: index.php?c=proveedor&a=index');
    }

    public function delete() {
        $this->soloAdmin();

        $id = $_GET['id'] ?? null;
        if ($id) {
            Proveedor::delete($id);
            Movimiento::registrar('eliminar_proveedor', "Se eliminó el proveedor ID $id");
        }
        header('Location: index.php?c=proveedor&a=index');
    }
}
?>
