<?php
$title = 'Crear Producto';
ob_start();
?>
<h3 class="text-center mb-4">Crear Producto</h3>
<!-- Formulario de creación -->
<form action="index.php?action=store" method="post">
    <!-- Campo para el nombre -->
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Digita un nombre" required>
    </div>
    <!-- Campo para la referencia -->
    <div class="mb-3">
        <label for="referencia" class="form-label">Referencia</label>
        <input type="text" class="form-control" id="referencia" name="referencia" placeholder="Digita un referencia única" required>
    </div>
    <!-- Campo para el precio -->
    <div class="mb-3">
        <label for="precio" class="form-label">Precio</label>
        <input type="number" class="form-control" id="precio" name="precio" placeholder="Digita el precio" required>
    </div>
    <!-- Campo para el peso -->
    <div class="mb-3">
        <label for="peso" class="form-label">Peso</label>
        <input type="number" class="form-control" id="peso" name="peso" placeholder="Digita el peso en gramos" >
    </div>
    <!-- Campo para la categoria -->
    <div class="mb-3">
        <label for="categoria_id" class="form-label">Categoría</label>
        <select class="form-control" id="categoria_id" name="categoria_id" required>
            <option selected value="">Seleciona una categoría</option>
            <!-- Cargo las categorías existentes -->
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nombre']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <!-- Campo para el stock -->
    <div class="mb-3">
        <label for="stock" class="form-label">Stock</label>
        <input type="number" class="form-control" id="stock" name="stock" placeholder="Digita el stock" required>
    </div>
    <!-- Boton para regresar a la lista -->
    <a role="button" href="index.php?action=index" class="btn btn-secondary">Cancelar</a>
    <!-- Boton para crear el producto -->
    <button type="submit" class="btn btn-primary">Crear</button>
</form>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>