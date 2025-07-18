<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
/**
 * La Clase Auth proporcina metodos para la autenticación y autorización de usuarios.
 * Permite verificar si un usuario está autenticado, obtener información del usuario,
 */
class Auth {
    /**
     * verifica si el usuario ya ha iniciado sesion.
     * @return bool true si el usuario está autenticado, false en caso contrario.
     */
    public static function check() {
        return isset($_SESSION['usuario']);
    }
    /**
     * Devuelve el usuario autenticado.
     * @return array|null El usuario autenticado o null si no hay usuario autenticado.
     */

    public static function user() {
        return $_SESSION['usuario'] ?? null;
    }
     /**
      * Verifica si el usuario logueado tien rol de administrador 
      */
    public static function isAdmin() {
        return self::check() && $_SESSION['usuario']['rol'] === 'admin';
    }
    /**
     * Redirige al usuario a la página de inicio de sesión si no está autenticado.
     */
    public static function requireLogin() {
        $inLoginPage = ($_GET['controller'] ?? '') === 'auth' && ($_GET['action'] ?? '') === 'login';

        if (!self::check() && !$inLoginPage) {
            header("Location: ?controller=auth&action=login");
            exit;
        }
    }

    /**
     * Exige que el usuario sea administrador.
     * Si el usuario no es administrador, lo devuelve al dashboard 
     */    
    public static function requireAdmin() {
        if (!self::isAdmin()) {
            header("Location: ?controller=auth&action=login&error=acceso_denegado");
            exit;
        }
    }
}
