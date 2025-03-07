<?php
$title = 'Lista de Productos';
ob_start();
?>
<h3 class="text-center mb-4">Lista de Productos</h3>
<!-- Boton de navegación -->
<div>
    <a href="index.php?action=create" class="btn btn-primary w-auto mb-3 float-end">Crear Producto</a>
</div>
<!-- Tabla de productos -->
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Referencia</th>
            <th>Precio</th>
            <th>Peso</th>
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
            <td><?php echo '$'. number_format($producto['precio']); ?></td>
            <td><?php echo $producto['peso'].' gr'; ?></td>
            <td><?php echo $producto['categoria_nombre']; ?></td>
            <td><?php echo $producto['stock'].' und'; ?></td>
            <td>

                <!-- Boton para ir a editar -->
                <a href="index.php?action=edit&id=<?php echo $producto['id']; ?>" class="btn btn-warning">Editar</a>
                <!-- Boton para activar modal de confirmación -->
                <button type="button"  class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalConfirm" data-id="<?php echo $producto['id']; ?>">Eliminar</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Modal de confirmación -->
<div class="modal fade" id="modalConfirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Atención</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Esta acción eliminará definitivamente el producto <br>¿Desea continuar?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, cancelar</button>
        <!-- Boton para eliminar -->
        <a  id="confirmDelete" href="#" role="button" class="btn btn-danger">Si, eliminar</a>
      </div>
    </div>
  </div>
</div>

<!-- Script para manejar el producto a eliminar -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  // Caputro el evento de mostrar el modal
    const modalConfirm = document.getElementById('modalConfirm');
    const confirmDelete = document.getElementById('confirmDelete');

    // Asigno la url de eliminación al botón de confirmación
    modalConfirm.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var productId = button.getAttribute('data-id');
        confirmDelete.href = 'index.php?action=delete&id=' + productId;
    });
});
</script>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>