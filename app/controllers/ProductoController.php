<?php
require_once __DIR__ . '/../models/ProductoModel.php';

class ProductoController {
    private $model;

    public function __construct($pdo) {
        $this->model = new ProductoModel($pdo);
    }

    // Listar todos los productos
    public function index() {
        $productos = $this->model->getAllProductos();
        require_once __DIR__ . '/../views/productos/index.php';
    }

    // Carga la vista y data para crear un producto
    public function create() {
        $categorias = $this->model->getAllCategorias();
        require_once __DIR__ . '/../views/productos/create.php';
    }

    // Guardar un nuevo producto
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar los datos
            if ( (!isset($_POST['nombre']) || empty($_POST['nombre'])) || 
            (!isset($_POST['referencia']) || empty($_POST['referencia'])) || 
            (!isset($_POST['precio']) || empty($_POST['precio'])) || 
            (!isset($_POST['peso']) || empty($_POST['peso'])) || 
            (!isset($_POST['categoria_id']) || empty($_POST['categoria_id'])) || 
            (!isset($_POST['stock']) || empty($_POST['stock'])))
            {
                $_SESSION['error'] = 'Los campos son requeridos.';
                header('Location: index.php?action=create');
                return;
            }
            // Agrupo los datos
            $data = [
                'nombre' => $_POST['nombre'],
                'referencia' => $_POST['referencia'],
                'precio' => $_POST['precio'],
                'peso' => $_POST['peso'],
                'categoria_id' => $_POST['categoria_id'],
                'stock' => $_POST['stock']
            ];
            if ($this->model->createProducto($data)) {
                $_SESSION['success'] = 'Se creó el producto exitosamente.';
                header('Location: index.php?action=index');
            } else {
                $_SESSION['error'] = 'Error al crear el producto.';
                header('Location: index.php?action=index');
            }
        }
    }

    // Carga la vista y data para editar un producto
    public function edit($id) {
        $producto = $this->model->getProductoById($id);
        require_once __DIR__ . '/../views/productos/edit.php';
    }

    // Editar un producto
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar los datos
            if ( (!isset($_POST['nombre']) || empty($_POST['nombre'])) || 
            (!isset($_POST['referencia']) || empty($_POST['referencia'])) || 
            (!isset($_POST['precio']) || empty($_POST['precio'])) || 
            (!isset($_POST['peso']) || empty($_POST['peso'])) || 
            (!isset($_POST['categoria_id']) || empty($_POST['categoria_id'])) || 
            (!isset($_POST['stock']) || empty($_POST['stock'])))
            {
                $_SESSION['error'] = 'Los campos son requeridos.';
                header('Location: index.php?action=create');
                return;
            }
            $data = [
                'nombre' => $_POST['nombre'],
                'referencia' => $_POST['referencia'],
                'precio' => $_POST['precio'],
                'peso' => $_POST['peso'],
                'categoria_id' => $_POST['categoria_id'],
                'stock' => $_POST['stock']
            ];
            if ($this->model->updateProducto($id, $data)) {
                $_SESSION['success'] = 'Se editó el producto exitosamente.';
                header('Location: index.php?action=index');
            } else {
                $_SESSION['error'] = 'Error al editar el producto.';
                header('Location: index.php?action=index');
            }
        }
    }

    // Eliminar un producto
    public function delete($id) {
        if ($this->model->deleteProducto($id)) {
            $_SESSION['success'] = 'Se eliminó el producto exitosamente.';
            header('Location: index.php?action=index');
        } else {
            $_SESSION['error'] = 'Error al eliminar el producto.';
            header('Location: index.php?action=index');
        }
    }
}
?>