<h2>Crear Usuario</h2>
<?php
$error = $_GET['error'] ?? '';
if ($error) {
    switch ($error) {
        case 'campos_vacios':
            echo "<div style='color:red'>Todos los campos son obligatorios.</div>";
            break;
        case 'formato_email':
            echo "<div style='color:red'>El correo no tiene un formato válido.</div>";
            break;
        case 'email_existente':
            echo "<div style='color:red'>El correo ya está registrado.</div>";
            break;
        case 'clave_corta':
            echo "<div style='color:red'>La contraseña debe tener al menos 6 caracteres.</div>";
            break;
        default:
            echo "<div style='color:red'>Error desconocido.</div>";
    }
}
?>
<form method="POST" action="?controller=usuarios&action=store">
    <input name="nombre" placeholder="Nombre" required>
    <input name="apellido" placeholder="Apellido" required>
    <input name="email" type="email" placeholder="Email" required>
    <input name="password" type="password" placeholder="Contraseña" required>
    <select name="rol">
        <option value="admin">Admin</option>
        <option value="usuario">Usuario</option>
    </select>
    <button type="submit">Guardar</button>
</form>
