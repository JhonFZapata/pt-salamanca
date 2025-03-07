<?php
$title = 'Editar Producto';
ob_start();
?>
<h3 class="text-center mb-4">Editar Producto</h3>
<!-- Formulario de edición -->
<form action="index.php?action=update&id=<?php echo $producto['id']; ?>" method="post">
    <!-- Campo para el nombre -->
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $producto['nombre']; ?>" required>
    </div>
    <!-- Campo para la referencia -->
    <div class="mb-3">
        <label for="referencia" class="form-label">Referencia</label>
        <input type="text" class="form-control" id="referencia" name="referencia" value="<?php echo $producto['referencia']; ?>" required>
    </div>
    <!-- Campo para el precio -->
    <div class="mb-3">
        <label for="precio" class="form-label">Precio</label>
        <input type="number" class="form-control" id="precio" name="precio" value="<?php echo $producto['precio']; ?>" required>
    </div>
    <!-- Campo para el peso -->
    <div class="mb-3">
        <label for="peso" class="form-label">Peso</label>
        <input type="number" class="form-control" id="peso" name="peso" value="<?php echo $producto['peso']; ?>" required>
    </div>
    <!-- Campo para la categoria -->
    <div class="mb-3">
        <label for="categoria_id" class="form-label">Categoría</label>
        <select class="form-control" id="categoria_id" name="categoria_id" required>
            <!-- Aquí debes cargar las categorías desde la base de datos -->
            <option value="1" <?php echo $producto['categoria_id'] == 1 ? 'selected' : ''; ?>>Categoría 1</option>
            <option value="2" <?php echo $producto['categoria_id'] == 2 ? 'selected' : ''; ?>>Categoría 2</option>
        </select>
    </div>
    <!-- Campo para el stock -->
    <div class="mb-3">
        <label for="stock" class="form-label">Stock</label>
        <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $producto['stock']; ?>" required>
    </div>
    <!-- Boton para regresar a la lista -->
    <a role="button" href="index.php?action=index" class="btn btn-secondary">Cancelar</a>
    <!-- Boton para editar el producto -->
    <button type="submit" class="btn btn-primary">Editar</button>
</form>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>