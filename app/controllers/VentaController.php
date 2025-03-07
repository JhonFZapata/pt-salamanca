<?php
require_once __DIR__ . '/../models/VentaModel.php';
require_once __DIR__ . '/../models/ProductoModel.php';

class VentaController {
    private $model;
    private $modelProducto;

    public function __construct($pdo) {
        $this->model = new VentaModel($pdo);
        $this->modelProducto = new ProductoModel($pdo);
    }

    // Carga la vista y data para una venta
    public function index() {
        $productos = $this->modelProducto->getAllProductos();
        require_once __DIR__ . '/../views/ventas/create.php';
    }

    // Realizar una venta
    public function create() {
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        // Verificar si se envió el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar los datos
            if ((!isset($_POST['producto_id']) || empty($_POST['producto_id'])) || 
                (!isset($_POST['cantidad']) || empty($_POST['cantidad']))
            ) {
                $_SESSION['error'] = 'Los campos son requeridos.';
                header('Location: index.php?action=venta');
                return;
            }
            $producto_id = $_POST['producto_id'];
            $cantidad = $_POST['cantidad'];

            if ($this->model->createVenta($producto_id, $cantidad)) {
                $_SESSION['success'] = 'Venta realizada con éxito';
                header('Location: index.php?action=venta');
            } else {
                $_SESSION['error'] = 'No hay suficiente stock para realizar la venta';
                header('Location: index.php?action=venta');
            }
        } else {
            header('Location: index.php?action=venta');
        }
    }
}
?>