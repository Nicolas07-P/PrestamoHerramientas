<?php
require_once __DIR__.'/../Helpers/Auth.php';
require_once __DIR__.'/../Model/Usuario.php';

class UsuarioController {

    public function __construct() {
        Auth::requireLogin();
        Auth::requireAdmin();
    }

    public function index() {
        Auth::requireLogin();
        Auth::requireAdmin();

        $q = $_GET['q'] ?? '';
        if ($q !== '') {
            $usuarios = Usuario::buscar($q);
        } else {
            $usuarios = Usuario::all();
        }
        include __DIR__ . '/../View/usuarios/index.php';
    }

    public function create() {
        Auth::requireAdmin();
        include __DIR__ . '/../View/usuarios/create.php';
    }

    public function store($data) {
        // Validar campos vacíos
        if (
            empty($data['nombre']) ||
            empty($data['apellido']) ||
            empty($data['email']) ||
            empty($data['password']) ||
            empty($data['rol'])
        ) {
            header("Location: ?controller=usuarios&action=create&error=campos_vacios");
            exit;
        }

        // Validar formato de correo
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            header("Location: ?controller=usuarios&action=create&error=formato_email");
            exit;
        }

        // Validar si el correo ya existe
        if (Usuario::findByEmail($data['email'])) {
            header("Location: ?controller=usuarios&action=create&error=email_existente");
            exit;
        }

        // Validar longitud mínima de contraseña
        if (strlen($data['password']) < 6) {
            header("Location: ?controller=usuarios&action=create&error=clave_corta");
            exit;
        }

        // Si todo está bien, crear usuario
        Usuario::create($data);
        error_log("Usuario creado: " . $data['email']);
        header("Location: ?controller=usuarios");
        exit;
    }

    public function edit($id) {
        $usuario = Usuario::find($id);
        include __DIR__ . '/../View/usuarios/edit.php';
    }

    public function update($id, $data) {
        Usuario::update($id, $data);
        header("Location: ?controller=usuarios");

    }

    public function delete($id) {
    try {
        Usuario::delete($id);
        header("Location: ?controller=usuarios");
    } catch (PDOException $e) {
        header("Location: ?controller=usuarios&error=relacionado");
    }
    exit;
    }

    //busqueda por correo
    public static function findByEmail($email) {
    $db = Database::connect();
    $stmt = $db->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

}
