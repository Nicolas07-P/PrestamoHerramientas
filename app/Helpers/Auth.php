<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
class Auth {
    public static function check() {
        return isset($_SESSION['usuario']);
    }

    public static function user() {
        return $_SESSION['usuario'] ?? null;
    }

    public static function isAdmin() {
        return self::check() && $_SESSION['usuario']['rol'] === 'admin';
    }

    public static function requireLogin() {
        $inLoginPage = ($_GET['controller'] ?? '') === 'auth' && ($_GET['action'] ?? '') === 'login';

        if (!self::check() && !$inLoginPage) {
            header("Location: ?controller=auth&action=login");
            exit;
        }
    }
    
    public static function requireAdmin() {
        if (!self::isAdmin()) {
            echo "Acceso denegadooo";
            exit;
        }
    }
}
