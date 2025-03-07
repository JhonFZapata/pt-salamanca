<?php
$title = 'Realizar Venta';
ob_start();
?>
<h3 class="text-center mb-4">Realizar Venta</h3>

<!-- Botón que activa el modal -->
 <div>
   <button type="button" class="btn btn-primary mb-3 float-end" data-bs-toggle="modal" data-bs-target="#productosModal">
     Seleccionar Producto
   </button>
 </div>

<!-- Formulario de venta -->
<form action="index.php?action=createVenta" method="post">
    <!-- Campo oculto para almacenar el ID del producto seleccionado -->
    <input type="hidden" id="producto_id" name="producto_id" required>

    <!-- Campo para mostrar el nombre del producto selecciondoo -->
    <div class="mb-3">
        <label for="producto_nombre" class="form-label">Producto</label>
        <input type="text" class="form-control" id="producto_nombre" placeholder="No se ha seleccionado un producto" readonly>
    </div>
    <!-- Campo para ingresar la cantidad -->
    <div class="mb-3">
        <label for="cantidad" class="form-label">Cantidad</label>
        <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Digita una cantidad" required>
    </div>

    <!-- Botón para realizar la venta -->
    <button type="submit" class="btn btn-primary">Realizar Venta</button>
</form>

<!-- Modal de productos -->
<div class="modal fade modal-lg" id="productosModal" tabindex="-1" aria-labelledby="productosModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="productosModalLabel">Seleccionar Producto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Tabla de productos -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Referencia</th>
                    <th>Precio</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?php echo $producto['id']; ?></td>
                    <td><?php echo $producto['nombre']; ?></td>
                    <td><?php echo $producto['referencia']; ?></td>
                    <td><?php echo '$' . number_format($producto['precio']); ?></td>
                    <td><?php echo $producto['categoria_nombre']; ?></td>
                    <td><?php echo $producto['stock']; ?></td>
                    <td>
                      <!-- Boton para seleccionar un producto -->
                        <button type="button" class="btn btn-warning btn-seleccionar" 
                                data-id="<?php echo $producto['id']; ?>" 
                                data-nombre="<?php echo $producto['nombre']; ?>">
                            Seleccionar
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <!-- Boton para cerrar el modal -->
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Script para manejar la selección del producto -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Selecciono todos los botones de selección por clase
    const botonesSeleccionar = document.querySelectorAll('.btn-seleccionar');

    // Agrego un evento click a cada botón
    botonesSeleccionar.forEach(boton => {
        boton.addEventListener('click', function() {
            // Obtenego el id y el nombre del producto
            const productoId = this.getAttribute('data-id');
            const productoNombre = this.getAttribute('data-nombre');

            // Actualizo el campo oculto y el campo de texto del formulario
            document.getElementById('producto_id').value = productoId;
            document.getElementById('producto_nombre').value = productoNombre;

            // Cierro el modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('productosModal'));
            modal.hide();

        });
    });
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>