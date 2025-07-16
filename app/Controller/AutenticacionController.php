<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();}
require_once __DIR__ . '/../Model/Usuario.php';

class AutenticacionController {
    public function login() {
        if (isset($_SESSION['usuario'])) {
            include __DIR__ . '/../View/dashboard.php';
            exit;
        }

        include __DIR__ . '/../View/autenticacion/login.php';
    }


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
        // Si el usuario existe y la contraseña es correcta, iniciar sesión 
        // y redirige según el rol 
         $_SESSION['usuario'] = $usuario;
        if ($usuario && $password === $usuario['password']) {
            $_SESSION['usuario'] = $usuario;
            if ($usuario['rol'] === 'admin') {
                header("Location: ?controller=usuarios"); // o dashboard
                header("Location: ?controller=prestamos");
            } else {
                header("Location: ?controller=prestamos"); // vista de usuario
            }
            exit;
        } else {
            header("Location: ?controller=auth&action=login&error=1");
            exit;
        }
    }

    public function logout() {
        session_destroy();
        header("Location: ?controller=auth&action=login");
    }
}
