<h2>Iniciar Sesión</h2>
<?php
$error = $_GET['error'] ?? '';
if ($error) {
    switch ($error) {
        case '1':
            echo "<div style='color:red'>Todos los campos son obligatorios.</div>";
            break;
        case 'formato_email':
            echo "<div style='color:red'>El correo no tiene un formato válido.</div>";
            break;
        case 'usuario_no_encontrado':
            echo "<div style='color:red'>Usuario no encontrado.</div>";
            break;
        case 'contraseña_incorrecta':
        case 'clave_incorrecta':
            echo "<div style='color:red'>Contraseña incorrecta.</div>";
            break;
        default:
            echo "<div style='color:red'>Error desconocido.</div>";
    }
}
?>

<form method="POST" action="?controller=auth&action=authenticate">
    <input type="email" name="email" placeholder="Correo electrónico" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button type="submit">Iniciar sesión</button>
</form>
