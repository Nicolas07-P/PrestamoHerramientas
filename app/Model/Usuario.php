<?php
require_once __DIR__.'/../../config/database.php';
/**
 * Modelo de usuarios
 * Proporciona metodos para gestionar los datos de los usuarios en la base de datos.
 * Permite crear, actualizar, eliminar y buscar usuarios.
 */
class Usuario {
    /**
     * Hace busqueda de todos los usuarios.
     * @return array Lista de usuarios.
     */
    public static function all() {
        $db = Database::connect();
        return $db->query("SELECT * FROM usuarios")->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Busca un usuario por medio de su ID.
     * @param int $id ID del usuario a buscar.
     * @return array|null Datos del usuario o null si no se encuentra.
     */
    public static function find($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    /**
     * Crea un nuevo usuario.
     * @param array $data Datos del usuario a crear.
     */

    public static function create($data) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO usuarios (nombre, apellido, email, password, rol) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$data['nombre'], $data['apellido'], $data['email'], $data['password'], $data['rol']]);
    }
    /**
     * Actualiza los datos de un usuario.
     * @param int $id ID del usuario a actualizar.
     * @param array $data Nuevos datos del usuario.
     */

    public static function update($id, $data) {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE usuarios SET nombre = ?, apellido = ?, email = ?, rol = ? WHERE id = ?");
        $stmt->execute([$data['nombre'], $data['apellido'], $data['email'], $data['rol'], $id]);
    }
    /**
     * Elimina un usuario por medio de su ID.
     * @param int $id ID del usuario a eliminar.
     */

    public static function delete($id) {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
    }
    /**
     * Busca un usuario por su email.
     * @param string $email Email del usuario a buscar.
     * @return array|null Datos del usuario o null si no se encuentra.
     */

    public static function findByEmail($email) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    /**
     * Esta función permite buscar usuarios por nombre, apellido o email.
     * @param string $q Término de búsqueda.
     * @return array Lista de usuarios que coinciden con el término.
     */
    public static function buscar($q) {
    $db = Database::connect();
    $sql = "SELECT * FROM usuarios WHERE nombre LIKE ? OR apellido LIKE ? OR email LIKE ?";
    $like = "%$q%";
    $stmt = $db->prepare($sql);
    $stmt->execute([$like, $like, $like]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}


