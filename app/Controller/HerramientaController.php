<?php
require_once __DIR__.'/../Helpers/Auth.php';
require_once __DIR__.'/../Model/Herramienta.php';

class HerramientaController {
    public function index() {
        $herramientas = Herramienta::all();
        include '../app/View/herramientas/index.php';
    }

    public function create() {
        include '../app/View/herramientas/create.php';
    }

    public function store($data) {
        Herramienta::create($data);
        header("Location: ?controller=herramientas");

    }

    public function edit($id) {
        $herramienta = Herramienta::find($id);
        include '../app/View/herramientas/edit.php';
    }

    public function update($id, $data) {
        Herramienta::update($id, $data);
        header("Location: ?controller=herramientas");

    }

    public function delete($id) {
        try {
            Herramienta::delete($id);
            header("Location: ?controller=herramientas");
        } catch (PDOException $e) {
            header("Location: ?controller=herramientas&error=relacionada");
        }
        exit;
    }
    public static function descontarCantidad($id) {
    $db = Database::connect();
    $stmt = $db->prepare("UPDATE herramientas SET cantidad_disponible = cantidad_disponible - 1 WHERE id = ? AND cantidad_disponible > 0");
    $stmt->execute([$id]);
}

}
