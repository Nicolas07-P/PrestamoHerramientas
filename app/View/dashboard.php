<h2>Bienvenido, <?= $_SESSION['usuario']['nombre'] ?>!</h2>

<?php if ($_SESSION['usuario']['rol'] === 'admin'): ?>
    <p>Panel de administrador:</p>
    <ul>
        <li><a href="?controller=usuarios">Gestionar Usuarios</a></li>
        <li><a href="?controller=herramientas">Gestionar Herramientas</a></li>
        <li><a href="?controller=prestamos">Ver Préstamos</a></li>
    </ul>
<?php else: ?>
    <p>Panel de usuario:</p>
    <ul>
        <li><a href="?controller=prestamos">Mis Préstamos</a></li>
    </ul>
<?php endif; ?>

<p><a href="?controller=auth&action=logout">Cerrar sesión</a></p>
