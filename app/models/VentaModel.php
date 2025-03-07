<?php
class VentaModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Realiza una venta
    public function createVenta($producto_id, $cantidad) {
        // Verificar el stock del producto
        $sql = "SELECT stock FROM productos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $producto_id]);
        $producto = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($producto && $producto['stock'] >= $cantidad) {
            // Insertar la venta
            $sql = "INSERT INTO ventas (producto_id, cantidad, fecha_venta) 
                    VALUES (:producto_id, :cantidad, :fecha_venta)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'producto_id' => $producto_id,
                'cantidad' => $cantidad,
                'fecha_venta' => date('Y-m-d')
            ]);

            // Actualiza el stock del producto
            $sql = "UPDATE productos SET stock = stock - :cantidad WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                'cantidad' => $cantidad,
                'id' => $producto_id
            ]);
        } else {
            return false; // No hay stock
        }
    }
}
?>