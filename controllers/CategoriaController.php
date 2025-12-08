<?php
require_once './models/Categoria.php';
require_once './models/Movimiento.php';

class CategoriaController {

    public function index() {
        $categorias = Categoria::getAll();
        require 'views/categorias/index.php';
    }

    public function create() {
       
        require 'views/categorias/form.php';
    }

    public function store() {
       

        $nombre = $_POST['nombre'];
        Categoria::create($nombre);

        Movimiento::registrar('crear_categoria', "Se creó la categoría: $nombre");

        header('Location: index.php?c=categoria&a=index');
    }

    public function delete() {
       

        $id = $_GET['id'] ?? null;

        if ($id) {
            Categoria::delete($id);
            Movimiento::registrar('eliminar_categoria', "Se eliminó la categoría ID $id");
        }

        header('Location: index.php?c=categoria&a=index');
    }
}
?>
