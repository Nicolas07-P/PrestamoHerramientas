<h2>Registrar Préstamo</h2>
<form method="POST" action="?controller=prestamos&action=store">

    <div id="herramientas-container">
        <div class="herramienta">
            <label>Herramienta:</label>
            <select name="herramientas[]">
                <?php foreach ($herramientas as $h): ?>
                    <option value="<?= $h['id'] ?>"><?= $h['nombre'] ?> (<?= $h['cantidad_disponible'] ?>)</option>
                <?php endforeach; ?>
            </select>
            <label>Cantidad:</label>
            <input type="number" name="cantidades[]" min="1" value="1">
        </div>
    </div>

    <button type="button" onclick="agregarHerramienta()">+ Agregar otra herramienta</button>

    <label>Fecha de préstamo:</label>
    <input name="fecha_prestamo" type="date" required>

    <label>Fecha estimada de devolución:</label>
    <input name="fecha_devolucion_estimada" type="date" required>

    <button type="submit">Guardar</button>
</form>

<script>
function agregarHerramienta() {
    const container = document.getElementById('herramientas-container');
    const html = container.children[0].outerHTML;
    container.insertAdjacentHTML('beforeend', html);
}
</script>
<a href="?controller=auth&action=login">Inicio</a>