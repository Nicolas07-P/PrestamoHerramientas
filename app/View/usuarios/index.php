<?php include __DIR__ . '/../VistaReutilizable/encabezado.php'; ?>
<link rel="stylesheet" href="/Sistema_prestamo_de_herramientas/public/assets/css/styles.css">

<h2>Lista de Usuarios</h2>

<?php if (isset($_GET['error']) && $_GET['error'] === 'relacionado'): ?>
    <div class="mensaje-error">No se puede eliminar el usuario porque tiene préstamos asociados.</div>
<?php endif; ?>

<?php if ($_SESSION['usuario']['rol'] === 'admin'): ?>
    <form class="busqueda" method="GET" action="">
        <input type="hidden" name="controller" value="usuarios">
        <input type="text" name="q" placeholder="Buscar usuario" value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
        <button type="submit">Buscar</button>
    </form>
<?php endif; ?>

<a href="?controller=usuarios&action=create" class="accion-principal">Nuevo Usuario</a>

<table class="tabla-datos">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $u): ?>
        <tr>
            <td><?= $u['nombre'] ?></td>
            <td><?= $u['apellido'] ?></td>
            <td><?= $u['email'] ?></td>
            <td><?= $u['rol'] ?></td>
            <td class="celda-acciones">
                <a href="?controller=usuarios&action=edit&id=<?= $u['id'] ?>">Editar</a>
                <a href="?controller=usuarios&action=delete&id=<?= $u['id'] ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include __DIR__ . '/../VistaReutilizable/pie.php'; ?>