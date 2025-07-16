<?php
require_once __DIR__.'/../../config/database.php';

class Usuario {
    public static function all() {
        $db = Database::connect();
        return $db->query("SELECT * FROM usuarios")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO usuarios (nombre, apellido, email, password, rol) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$data['nombre'], $data['apellido'], $data['email'], $data['password'], $data['rol']]);
    }

    public static function update($id, $data) {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE usuarios SET nombre = ?, apellido = ?, email = ?, rol = ? WHERE id = ?");
        $stmt->execute([$data['nombre'], $data['apellido'], $data['email'], $data['rol'], $id]);
    }

    public static function delete($id) {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
    }

    public static function findByEmail($email) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}


