<h2>Usuarios</h2>
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