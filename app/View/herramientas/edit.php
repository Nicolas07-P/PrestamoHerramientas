<h2>Editar Herramienta</h2>
<form method="POST" action="?controller=herramientas&action=update&id=<?= $herramienta['id'] ?>">
    <input name="nombre" value="<?= $herramienta['nombre'] ?>" required>
    <textarea name="descripcion"><?= $herramienta['descripcion'] ?></textarea>
    <input name="cantidad_disponible" type="number" value="<?= $herramienta['cantidad_disponible'] ?>" required>
    <button type="submit">Actualizar</button>
    <a href ="?controller=auth&action=login">Ir al inicio</a>
</form>
