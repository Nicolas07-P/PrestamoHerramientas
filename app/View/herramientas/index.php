<h2>Herramientas</h2>
<a href="?controller=herramientas&action=create">Nueva Herramienta</a>
<?php if (isset($_GET['error']) && $_GET['error'] === 'relacionada'): ?>
    <div style="color:red;">No se puede eliminar la herramienta porque está asociada a un préstamo.</div>
<?php endif; ?>
<table border="1">
    <tr>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Cantidad Disponible</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($herramientas as $h): ?>
    <tr>
        <td><?= $h['nombre'] ?></td>
        <td><?= $h['descripcion'] ?></td>
        <td><?= $h['cantidad_disponible'] ?></td>
        <td>
            <a href="?controller=herramientas&action=edit&id=<?= $h['id'] ?>">Editar</a>
            <a href="?controller=herramientas&action=delete&id=<?= $h['id'] ?>"
            onclick="return confirm('¿Está seguro que desea eliminar esta herramienta?');">
            Eliminar
            </a>
        </td>
    </tr>   
    <?php endforeach; ?>
</table>
<a href="?controller=auth&action=login">Ir al inicio</a>
