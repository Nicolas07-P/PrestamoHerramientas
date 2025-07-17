<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();}
require_once __DIR__ . '/../Model/Usuario.php';
/**
 * Controlador para la autenticación de usuarios.
 * Permite iniciar sesión, cerrar sesión y manejar la autenticación de usuarios.
 */
class AutenticacionController {

    /**
     * Muestra el formulario login o el darboard si el usuario ya está autenticado.
     */
    public function login() {
        if (isset($_SESSION['usuario'])) {
            include __DIR__ . '/../View/dashboard.php';
            exit;
        }

        include __DIR__ . '/../View/autenticacion/login.php';
    }

    /**
     * Autentica un usuario con sus credenciales.
     * Realiza validaciones de campos vacíos, formato de correo, existencia del usuario y contraseña.
     * Redirige al dashboard si la autenticación es exitosa o muestra un error en
     */
    public function authenticate() {
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        // validacion de campos vacios
        if (empty ($email) || empty($password)) {
            header("Location: ?controller=auth&action=login&error=1");
            exit;
        }
            // Validación de formato de correo
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ?controller=auth&action=login&error=formato_email");
            exit;
        }
        $usuario = Usuario::findByEmail($email);
        // Velidacion si el usuario existe
        if (!$usuario) {
            header("Location: ?controller=auth&action=login&error=usuario_no_encontrado");
            exit;
        }
        //validacion de la contraseña
        if($password!== $usuario['password']){
            header("location: ? controller=auth&action=login&error=contraseña_incorrecta");
            exit;
        }

         $_SESSION['usuario'] = $usuario;
        if ($usuario && $password === $usuario['password']) {
            header("Location: ?contreller=auth&action=login");
            exit;
        } else {
            header("Location: ?controller=auth&action=login&error=1");
            exit;
        }
    }
    /**
     * Cierra la sesion del usuario autenticado y redirige al login.
     */

    public function logout() {
        session_destroy();
        header("Location: ?controller=auth&action=login");
    }
}
