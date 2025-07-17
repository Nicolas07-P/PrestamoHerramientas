<?php
require_once __DIR__.'/../Helpers/Auth.php';
require_once __DIR__.'/../Model/Usuario.php';
/**
 * Controlador para la gestion de usuarios.
 * Maneja operaciones CRUD y autenticación de usuarios.
 */
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
    /**
     * Muestra el formulario de edición de un usuario.
     * @param int $id ID del usuario a editar.
     */

    public function edit($id) {
        $usuario = Usuario::find($id);
        include __DIR__ . '/../View/usuarios/edit.php';
    }
    /**
     * Actualiza los datos de un usuario.
     * @param int $id ID del usuario a actualizar.
     * @param array $data Datos actualizados del usuario.
     */

    public function update($id, $data) {
        Usuario::update($id, $data);
        header("Location: ?controller=usuarios");

    }
    /**
     * Elimina un usuario.
     * @param int $id ID del usuario a eliminar.
     * Maneja excepciones si el usuario está relacionado con otros registros.
     */

    public function delete($id) {
    try {
        Usuario::delete($id);
        header("Location: ?controller=usuarios");
    } catch (PDOException $e) {
        header("Location: ?controller=usuarios&error=relacionado");
    }
    exit;
    }

    /**
     * Busca un usuario por medio de su correo electronico.
     * @param string $email Correo electronico del usuario.
     */
    public static function findByEmail($email) {
    $db = Database::connect();
    $stmt = $db->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

}
