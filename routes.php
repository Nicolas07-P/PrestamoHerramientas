<?php
session_start();

$action = $_GET['action'] ?? '';
$controller = $_GET['controller'] ?? '';

switch ($controller) {
    case 'usuarios':
        require_once __DIR__ . '/app/Controller/UsuarioController.php';
        $c = new UsuarioController();
        match ($action) {
            'create' => $c->create(),
            'store' => $c->store($_POST),
            'edit' => $c->edit($_GET['id']),
            'update' => $c->update($_GET['id'], $_POST),
            'delete' => $c->delete($_GET['id']),
            default => $c->index(),
        };
        break;

    case 'herramientas':
        require_once __DIR__ . '/app/Controller/HerramientaController.php';
        $c = new HerramientaController();
        match ($action) {
            'create' => $c->create(),
            'store' => $c->store($_POST),
            'edit' => $c->edit($_GET['id']),
            'update' => $c->update($_GET['id'], $_POST),
            'delete' => $c->delete($_GET['id']),
            default => $c->index(),
        };
        break;

    case 'prestamos':
        require_once __DIR__ . '/app/Controller/PrestamoController.php';
        $c = new PrestamoController();
        match ($action) {
            'create' => $c->create(),
            'store' => $c->store($_POST),
            'devolver' => $c->devolver($_GET['id']),
            'devolver_parcial' => $c->devolver_parcial(),
            'historial' => $c->historial(),
            default => $c->index(),
        };
        break;

    case 'auth':
        require_once __DIR__ . '/app/Controller/AutenticacionController.php';
        $c = new AutenticacionController();
        match ($action) {
            'login' => $c->login(),
            'logout' => $c->logout(),
            'authenticate' => $c->authenticate(),
            default => $c->login(),
        };
        break;

    default:
        echo "Página no encontrada.";
}
