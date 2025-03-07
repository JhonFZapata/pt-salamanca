<?php
session_start();

require_once __DIR__ . '/config/database.php'; // Conexión PDO
require_once __DIR__ . '/app/controllers/ProductoController.php'; // Controlador de productos
require_once __DIR__ . '/app/controllers/VentaController.php'; // Controlador de ventas

$action = isset($_GET['action']) ? $_GET['action'] : 'index'; // Acción a ejecutar
$id = isset($_GET['id']) ? $_GET['id'] : null; // Parametro de id

$productoController = new ProductoController($pdo);
$ventaController = new VentaController($pdo);

// Rutas
switch ($action) {
    case 'index':
        $productoController->index();
        break;
    case 'create':
        $productoController->create();
        break;
    case 'store':
        $productoController->store();
        break;
    case 'edit':
        $productoController->edit($id);
        break;
    case 'update':
        $productoController->update($id);
        break;
    case 'delete':
        $productoController->delete($id);
        break;
    case 'venta':
        $ventaController->index();
        break;
    case 'createVenta':
        $ventaController->create();
        break;
    default:
        $productoController->index();
        break;
}
?>