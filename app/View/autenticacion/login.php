/**
 * Vista: Para ingresar correo y contraseña y loguearse en el sistema.
 * Path: /app/View/autenticacion/login.php
 * Descripción: Muestra campos para el ingreso de correo y contraseña.
 *
 * Acciones:
 * - POST ?controller=auth&action=authenticate
 */
<?php include __DIR__ . '/../VistaReutilizable/encabezado.php'; ?>
<link rel="stylesheet" href="/Sistema_prestamo_de_herramientas/public/assets/css/styles.css">

<div class="login">
    <h2>Iniciar Sesión</h2>

    <?php
    $error = $_GET['error'] ?? '';
    if ($error) {
        $mensajes = [
            '1' => 'Todos los campos son obligatorios',
            'formato_email' => 'El correo no tiene un formato válido',
            'usuario_no_encontrado' => 'Usuario no encontrado',
            'contraseña_incorrecta' => 'Contraseña incorrecta',
            'clave_incorrecta' => 'Contraseña incorrecta'
        ];
        echo '<div class="error">'.($mensajes[$error] ?? 'Error desconocido').'</div>';
    }
    ?>

    <form method="POST" action="?controller=auth&action=authenticate">
        <div class="campo">
            <input type="email" name="email" placeholder="Correo electrónico" required>
        </div>
        
        <div class="campo">
            <input type="password" name="password" placeholder="Contraseña" required>
        </div>
        
        <button type="submit">Entrar</button>
    </form>
</div>

<?php include __DIR__ . '/../VistaReutilizable/pie.php'; ?>