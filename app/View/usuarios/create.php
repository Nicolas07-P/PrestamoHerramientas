<?php include __DIR__ . '/../VistaReutilizable/encabezado.php'; ?>
<link rel="stylesheet" href="../public/assets/css/styles.css">

<h2>Crear Usuario</h2>

<?php
$error = $_GET['error'] ?? '';
if ($error) {
    $mensajes = [
        'campos_vacios' => 'Todos los campos son obligatorios',
        'formato_email' => 'El correo no tiene formato válido',
        'email_existente' => 'El correo ya está registrado',
        'clave_corta' => 'La contraseña debe tener al menos 6 caracteres'
    ];
    echo '<div class="mensaje-error">'.($mensajes[$error] ?? 'Error desconocido').'</div>';
}
?>

<form class="form-usuario" method="POST" action="?controller=usuarios&action=store">
    <input name="nombre" placeholder="Nombre" required>
    <input name="apellido" placeholder="Apellido" required>
    <input name="email" type="email" placeholder="Email" required>
    <input name="password" type="password" placeholder="Contraseña" required>
    <select name="rol">
        <option value="admin">Administrador</option>
        <option value="usuario" selected>Usuario</option>
    </select>
    <button type="submit">Guardar</button>
</form>

<?php include __DIR__ . '/../VistaReutilizable/pie.php'; ?>