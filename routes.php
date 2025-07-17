<?php
/**
 * Archivo de rutas principal del sistema de Préstamo de Herramientas
 *
 * Este archivo recibe todas las solicitudes HTTP y, según los parámetros 'controller' y 'action'
 * presentes en la URL, determina qué controlador y método deben ser ejecutados.
 *
 * Funcionamiento general:
 * - Inicia la sesión si es necesario.
 * - Lee los parámetros 'controller' y 'action' de la URL (?controller=...&action=...).
 * - Según el valor de 'controller', carga el archivo del controlador correspondiente (usuarios, herramientas, prestamos, auth).
 * - Crea una instancia del controlador.
 * - Utiliza un bloque match para llamar al método (action) correspondiente del controlador; si no se especifica o no coincide, usa la acción por defecto (index o login).
 * - Si el controlador no existe, muestra "Página no encontrada."
 *
 * Ejemplo de uso:
 *   - ?controller=usuarios&action=create → Ejecuta UsuarioController::create()
 *   - ?controller=herramientas&action=edit&id=5 → Ejecuta HerramientaController::edit(5)
 *   - ?controller=prestamos&action=historial → Ejecuta PrestamoController::historial()
 *   - Si no se especifica 'controller', la aplicación redirige a login (ver public/index.php)
 *
 * Nota:
 * - Los controladores deben estar en app/Controller y llamarse UsuarioController, HerramientaController, PrestamoController o AutenticacionController.
 * - Cada controlador debe implementar los métodos públicos que aquí se llaman.
 * - El parámetro $_POST se usa para enviar datos de formularios en acciones como 'store' o 'update'.
 * - El parámetro $_GET['id'] se usa en acciones que requieren un identificador (edit, update, delete, devolver).
 */
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
