<?php include __DIR__ . '/../VistaReutilizable/encabezado.php'; ?>
<link rel="stylesheet" href="/Sistema_prestamo_de_herramientas/public/assets/css/styles.css">

<h2>Editar Usuario</h2>

<form class="form-edicion" method="POST" action="?controller=usuarios&action=update&id=<?= $usuario['id'] ?>">
    <div class="campo-formulario">
        <input name="nombre" value="<?= $usuario['nombre'] ?>" placeholder="Nombre" required>
    </div>
    
    <div class="campo-formulario">
        <input name="apellido" value="<?= $usuario['apellido'] ?>" placeholder="Apellido" required>
    </div>
    
    <div class="campo-formulario">
        <input name="email" type="email" value="<?= $usuario['email'] ?>" placeholder="Email" required>
    </div>
    
    <div class="campo-formulario">
        <select name="rol">
            <option value="admin" <?= $usuario['rol'] === 'admin' ? 'selected' : '' ?>>Administrador</option>
            <option value="usuario" <?= $usuario['rol'] === 'usuario' ? 'selected' : '' ?>>Usuario normal</option>
        </select>
    </div>
    
    <div class="acciones-formulario">
        <button type="submit">Guardar cambios</button>
    </div>
</form>

<?php include __DIR__ . '/../VistaReutilizable/pie.php'; ?>