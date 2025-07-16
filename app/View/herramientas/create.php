<h2>Crear Herramienta</h2>
<form method="POST" action="?controller=herramientas&action=store">
    <label>Nombre de la Herramienta:</label>
    <input name="nombre" placeholder="Nombre" required>
    <label>Descripcion:</label>
    <textarea name="descripcion" placeholder="Descripción"></textarea>
    <label>Cantidad Disponible:</label>
    <input name="cantidad_disponible" type="number" min="0" required>
    <button type="submit">Guardar</button>
    <a href="?controller=herramientas">Ver herramientas</a>
    <a href="?controller=auth&action=login">Ir al inicio</a>
</form>
