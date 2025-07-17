<?php
require_once __DIR__.'/../../config/database.php';
/**
 * Modelo de herramientas permite gestionar las herramientas disponibles.
 * Proporciona métodos para crear, listar, actualizar, descontar cantidad de herramientas y eliminar herramientas.
 */
class Herramienta {
    /**
     * Obtiene todas las herramientas disponibles.
     * @return array Lista de herramientas.
     */
    public static function all() {
        $db = Database::connect();
        return $db->query("SELECT * FROM herramientas")->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Busca una herramienta por su ID.
     * @param int $id ID de la herramienta a buscar.
     * @return array|null Datos de la herramienta o null si no se encuentra.
     */

    public static function find($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM herramientas WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    /**
     * Crea una nueva herramienta.
     * @param array $data Datos de la herramienta a crear.
     */

    public static function create($data) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO herramientas (nombre, descripcion, cantidad_disponible) VALUES (?, ?, ?)");
        $stmt->execute([$data['nombre'], $data['descripcion'], $data['cantidad_disponible']]);
    }
    /**
     * Actualiza los datos de una herramienta.
     * @param int $id ID de la herramienta a actualizar.
     * @param array $data Nuevos datos de la herramienta.
     */

    public static function update($id, $data) {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE herramientas SET nombre = ?, descripcion = ?, cantidad_disponible = ? WHERE id = ?");
        $stmt->execute([$data['nombre'], $data['descripcion'], $data['cantidad_disponible'], $id]);
    }
    /**
     * Elimina una herramienta por su ID.
     * @param int $id ID de la herramienta a eliminar.
     */

    public static function delete($id) {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM herramientas WHERE id = ?");
        $stmt->execute([$id]);
    }
    /**
     * Descuenta una cantidad de una herramienta específica.
     * @param int $id ID de la herramienta.
     * @param int $cantidad Cantidad a descontar.
     */

    public static function descontarCantidad($id, $cantidad) {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE herramientas SET cantidad_disponible = cantidad_disponible - ? WHERE id = ? AND cantidad_disponible >= ?");
        $stmt->execute([$cantidad, $id, $cantidad]);
    }


}
