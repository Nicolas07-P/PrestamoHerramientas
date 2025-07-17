<?php
require_once __DIR__.'/../Helpers/Auth.php';
require_once __DIR__.'/../Model/Herramienta.php';
/**
 * Controlador para la gestión de herramientas.
 * Permite listar, crear, editar y eliminar herramientas.
 */
class HerramientaController {
    public function index() {
        $herramientas = Herramienta::all();
        include '../app/View/herramientas/index.php';
    }
    /**
     * Muestra el formulario para crear una nueva herramienta.
     * Incluye la vista de creación de herramientas.
     */
    public function create() {
        include '../app/View/herramientas/create.php';
    }
    /**
     * Almacena una nueva herramienta en la base de datos.
     * @param array $data Datos de la herramienta a crear.
     */
    public function store($data) {
        Herramienta::create($data);
        header("Location: ?controller=herramientas");

        /**
         * Muestra el formulario para editar una herramienta existente.
         * @param int $id ID de la herramienta a editar.
         */
    }

    public function edit($id) {
        $herramienta = Herramienta::find($id);
        include '../app/View/herramientas/edit.php';
    }

    /**
     * Actualiza los datos de una herramienta existente.
     * @param int $id ID de la herramienta a actualizar.
     * @param array $data Datos actualizados de la herramienta.
     */

    public function update($id, $data) {
        Herramienta::update($id, $data);
        header("Location: ?controller=herramientas");

    }
    /**
     * Elimina un herramineta de la base de datos.
     * @param int $id ID de la herramienta a eliminar.
     */
    public function delete($id) {
        try {
            Herramienta::delete($id);
            header("Location: ?controller=herramientas");
        } catch (PDOException $e) {
            header("Location: ?controller=herramientas&error=relacionada");
        }
        exit;
    }
    /**
     * Descuenta la cantidad disponible de una herramienta.
     * @param int $id ID de la herramienta a descontar.
     */
    public static function descontarCantidad($id) {
    $db = Database::connect();
    $stmt = $db->prepare("UPDATE herramientas SET cantidad_disponible = cantidad_disponible - 1 WHERE id = ? AND cantidad_disponible > 0");
    $stmt->execute([$id]);
}

}
