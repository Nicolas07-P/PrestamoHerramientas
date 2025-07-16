<h2>Editar Usuario</h2>
<form method="POST" action="?controller=usuarios&action=update&id=<?= $usuario['id'] ?>">
    <input name="nombre" value="<?= $usuario['nombre'] ?>" required>
    <input name="apellido" value="<?= $usuario['apellido'] ?>" required>
    <input name="email" type="email" value="<?= $usuario['email'] ?>" required>
    <select name="rol">
        <option value="admin" <?= $usuario['rol'] === 'admin' ? 'selected' : '' ?>>Admin</option>
        <option value="usuario" <?= $usuario['rol'] === 'usuario' ? 'selected' : '' ?>>Usuario</option>
    </select>
    <button type="submit">Actualizar</button>
</form>
