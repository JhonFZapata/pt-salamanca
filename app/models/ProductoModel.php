<?php
class ProductoModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Retorna todos los productos
    public function getAllProductos() {
        $sql = "SELECT p.*, c.nombre AS categoria_nombre 
                FROM productos p 
                INNER JOIN categorias c ON p.categoria_id = c.id";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Retorna todas las categorías
    public function getAllCategorias() {
        $sql = "SELECT * FROM categorias";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Retorna un producto por ID
    public function getProductoById($id) {
        $sql = "SELECT * FROM productos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crea un nuevo producto
    public function createProducto($data) {
        try{
            $sql = "INSERT INTO productos (nombre, referencia, precio, peso, categoria_id, stock, fecha_creacion, fecha_actualizacion) 
                    VALUES (:nombre, :referencia, :precio, :peso, :categoria_id, :stock, :fecha_creacion, :fecha_actualizacion)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                'nombre' => $data['nombre'],
                'referencia' => $data['referencia'],
                'precio' => $data['precio'],
                'peso' => $data['peso'],
                'categoria_id' => $data['categoria_id'],
                'stock' => $data['stock'],
                'fecha_creacion' => date('Y-m-d'),
                'fecha_actualizacion' => date('Y-m-d')
            ]);
        } catch (\Throwable $th) {
            return false;
        }
    }

    // Actualiza un producto
    public function updateProducto($id, $data) {
        try{
            $sql = "UPDATE productos 
                    SET nombre = :nombre, referencia = :referencia, precio = :precio, peso = :peso, 
                        categoria_id = :categoria_id, stock = :stock, fecha_actualizacion = :fecha_actualizacion 
                    WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                'nombre' => $data['nombre'],
                'referencia' => $data['referencia'],
                'precio' => $data['precio'],
                'peso' => $data['peso'],
                'categoria_id' => $data['categoria_id'],
                'stock' => $data['stock'],
                'fecha_actualizacion' => date('Y-m-d'),
                'id' => $id
            ]);
        } catch (\Throwable $th) {
            return false;
        }
    }

    // Elimina un producto
    public function deleteProducto($id) {
        try {
            $sql = "DELETE FROM productos WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute(['id' => $id]);
        } catch (\Throwable $th) {
            return false;
        }
    }
}
?>