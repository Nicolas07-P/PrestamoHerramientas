<?php
require_once __DIR__.'/../../config/database.php';

class Herramienta {
    public static function all() {
        $db = Database::connect();
        return $db->query("SELECT * FROM herramientas")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM herramientas WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO herramientas (nombre, descripcion, cantidad_disponible) VALUES (?, ?, ?)");
        $stmt->execute([$data['nombre'], $data['descripcion'], $data['cantidad_disponible']]);
    }

    public static function update($id, $data) {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE herramientas SET nombre = ?, descripcion = ?, cantidad_disponible = ? WHERE id = ?");
        $stmt->execute([$data['nombre'], $data['descripcion'], $data['cantidad_disponible'], $id]);
    }

    public static function delete($id) {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM herramientas WHERE id = ?");
        $stmt->execute([$id]);
    }

    public static function descontarCantidad($id, $cantidad) {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE herramientas SET cantidad_disponible = cantidad_disponible - ? WHERE id = ? AND cantidad_disponible >= ?");
        $stmt->execute([$cantidad, $id, $cantidad]);
    }


}
