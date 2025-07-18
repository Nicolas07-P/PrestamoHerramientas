<link rel="stylesheet" href="/Sistema_prestamo_de_herramientas/public/assets/css/styles.css">

<div class="dashboard">
    <h2>Bienvenido <?= $_SESSION['usuario']['nombre'] ?>!</h2>

    <?php if ($_SESSION['usuario']['rol'] === 'admin'): ?>
        <div class="panel">
            <h3>Panel de administrador</h3>
            <ul class="menu">
                <li><a href="?controller=usuarios">Usuarios</a></li>
                <li><a href="?controller=herramientas">Herramientas</a></li>
                <li><a href="?controller=prestamos">Préstamos</a></li>
            </ul>
        </div>
    <?php else: ?>
        <div class="panel">
            <h3>Panel de usuario</h3>
            <ul class="menu">
                <li><a href="?controller=prestamos">Mis préstamos</a></li>
            </ul>
        </div>
    <?php endif; ?>

    <div class="logout">
        <a href="?controller=auth&action=logout">Cerrar Sesion</a>
    </div>
</div>

