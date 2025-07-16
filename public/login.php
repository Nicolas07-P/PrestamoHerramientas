<?php if (isset($_GET['error'])): ?>
    <p style="color: red;">Usuario o contraseña incorrectos</p>
<?php endif; ?>

<form method="POST" action="?controller=auth&action=authenticate">
    <input type="email" name="email" placeholder="Correo electrónico" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button type="submit">Iniciar sesión</button>
</form>
