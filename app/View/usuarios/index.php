<h2>Usuarios</h2>
<?php if (isset($_GET['error']) && $_GET['error'] === 'relacionado'): ?>
    <div style="color:red;">No se puede eliminar el usuario porque tiene préstamos asociados.</div>
<?php endif; ?>
<?php if ($_SESSION['usuario']['rol'] === 'admin'): ?>
<form method="GET" action="">
    <input type="hidden" name="controller" value="usuarios">
    <input type="text" name="q" placeholder="Buscar usuario" value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
    <button type="submit">Buscar</button>
</form>
<?php endif; ?>
<a href="?controller=usuarios&action=create">Nuevo Usuario</a>
<table border="1">
    <tr>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Email</th>
        <th>Rol</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($usuarios as $u): ?>
    <tr>
        <td><?= $u['nombre'] ?></td>
        <td><?= $u['apellido'] ?></td>
        <td><?= $u['email'] ?></td>
        <td><?= $u['rol'] ?></td>
        <td>
            <a href="?controller=usuarios&action=edit&id=<?= $u['id'] ?>">Editar</a>
            <a href="?controller=usuarios&action=delete&id=<?= $u['id'] ?>">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<a href="?controller=auth&action=login">Inicio</a>