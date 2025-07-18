<?php include __DIR__ . '/../VistaReutilizable/encabezado.php'; ?>
<link rel="stylesheet" href="/Sistema_prestamo_de_herramientas/public/assets/css/styles.css">

<h2>Listado de Herramientas</h2>

<a href="?controller=herramientas&action=create" class="boton">Nueva Herramienta</a>

<?php if (isset($_GET['error']) && $_GET['error'] === 'relacionada'): ?>
    <div class="mensaje-error">No se puede eliminar la herramienta porque está asociada a un préstamo.</div>
<?php endif; ?>

<table class="tabla">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Disponibles</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($herramientas as $h): ?>
        <tr>
            <td><?= $h['nombre'] ?></td>
            <td><?= $h['descripcion'] ?></td>
            <td><?= $h['cantidad_disponible'] ?></td>
            <td class="acciones">
                <a href="?controller=herramientas&action=edit&id=<?= $h['id'] ?>">Editar</a>
                <a href="?controller=herramientas&action=delete&id=<?= $h['id'] ?>" 
                   onclick="return confirm('¿Está seguro que desea eliminar esta herramienta?');">
                   Eliminar
                </a>
            </td>
        </tr>   
        <?php endforeach; ?>
    </tbody>
</table>

<a href="?controller=auth&action=login" class="boton-secundario">Ir al inicio</a>

<?php include __DIR__ . '/../VistaReutilizable/pie.php'; ?>