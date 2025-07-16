<?php
require_once __DIR__.'/../../config/database.php';
require_once __DIR__.'/../Helpers/Auth.php';
class Prestamo {
    public static function all() {
        $db = Database::connect();
        return $db->query("SELECT * FROM prestamos WHERE estado = 'activo'")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function historial() {
        $db = Database::connect();
        return $db->query("SELECT * FROM prestamos WHERE estado = 'devuelto'")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO prestamos (id_usuario, id_herramienta, fecha_prestamo, fecha_devolucion_estimada, estado) VALUES (?, ?, ?, ?, 'activo')");
        $stmt->execute([$data['id_usuario'], $data['id_herramienta'], $data['fecha_prestamo'], $data['fecha_devolucion_estimada']]);

        $db->exec("UPDATE herramientas SET cantidad_disponible = cantidad_disponible - 1 WHERE id = " . intval($data['id_herramienta']));
    }

    public static function devolverHerramientaDetalle($idDetalle) {
        $db = Database::connect();

        // 1. Obtener la cantidad y datos del detalle
        $stmt = $db->prepare("SELECT id_prestamo, id_herramienta, cantidad FROM detalle_prestamos WHERE id = ?");
        $stmt->execute([$idDetalle]);
        $detalle = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($detalle && $detalle['cantidad'] > 0) {
            // 2. Devolver stock
            $stmt = $db->prepare("UPDATE herramientas SET cantidad_disponible = cantidad_disponible + ? WHERE id = ?");
            $stmt->execute([$detalle['cantidad'], $detalle['id_herramienta']]);

            // 3. Marcar esa herramienta como devuelta SOLO en ese detalle
            $stmt = $db->prepare("UPDATE detalle_prestamos SET devuelto = 1 WHERE id = ?");
            $stmt->execute([$idDetalle]);

            // 4. Verificar si todas las herramientas ya fueron devueltas
            $stmt = $db->prepare("SELECT COUNT(*) FROM detalle_prestamos WHERE id_prestamo = ? AND devuelto = 0");
            $stmt->execute([$detalle['id_prestamo']]);
            $faltan = $stmt->fetchColumn();

            if ($faltan == 0) {
                $stmt = $db->prepare("UPDATE prestamos SET estado = 'devuelto', fecha_devolucion_real = CURDATE() WHERE id = ?");
                $stmt->execute([$detalle['id_prestamo']]);
            }
        }
    }

    public static function crearDevolverId($data) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO prestamos (id_usuario, fecha_prestamo, fecha_devolucion_estimada) VALUES (?, ?, ?)");
        $stmt->execute([$data['id_usuario'], $data['fecha_prestamo'], $data['fecha_devolucion_estimada']]);
        return $db->lastInsertId();
    }

    public static function agregarDetalle($idPrestamo, $idHerramienta, $cantidad) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO detalle_prestamos (id_prestamo, id_herramienta, cantidad) VALUES (?, ?, ?)");
        $stmt->execute([$idPrestamo, $idHerramienta, $cantidad]);
    }


    public static function prestamosActivos() {
        $db = Database::connect();
        $where = "WHERE p.estado = 'activo'";
        $params = [];

        if (!Auth::isAdmin()) {
            $where .= " AND p.id_usuario = ?";
            $params[] = $_SESSION['usuario']['id'];
        }

        $sql = "
            SELECT p.id AS id_prestamo, u.nombre, u.apellido, h.nombre AS herramienta, dp.cantidad,
                dp.id_herramienta, dp.id AS id_detalle,
                p.fecha_prestamo, p.fecha_devolucion_estimada, p.fecha_devolucion_real, p.estado
            FROM prestamos p
            JOIN usuarios u ON p.id_usuario = u.id
            JOIN detalle_prestamos dp ON p.id = dp.id_prestamo
            JOIN herramientas h ON dp.id_herramienta = h.id
            $where
            ORDER BY p.fecha_prestamo DESC
        ";

        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function prestamosCompletados() {
        $db = Database::connect();
        $where = "WHERE p.estado = 'devuelto'";
        $params = [];

        if (!Auth::isAdmin()) {
            $where .= " AND p.id_usuario = ?";
            $params[] = $_SESSION['usuario']['id'];
        }

        $sql = "
            SELECT p.id AS id_prestamo, u.nombre, u.apellido, h.nombre AS herramienta, dp.cantidad,
                p.fecha_prestamo, p.fecha_devolucion_estimada, p.fecha_devolucion_real
            FROM prestamos p
            JOIN usuarios u ON p.id_usuario = u.id
            JOIN detalle_prestamos dp ON p.id = dp.id_prestamo
            JOIN herramientas h ON dp.id_herramienta = h.id
            $where
            ORDER BY p.fecha_devolucion_real DESC
        ";

        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function buscar($q = '', $estado = 'activo') {
    $db = Database::connect();
    $where = "WHERE p.estado = ?";
    $params = [$estado];

    if ($q !== '') {
        $where .= " AND (u.nombre LIKE ? OR u.apellido LIKE ? OR h.nombre LIKE ?)";
        $like = "%$q%";
        $params[] = $like;
        $params[] = $like;
        $params[] = $like;
    }

    // Si el usuario no es admin, solo ve sus préstamos
    if (!Auth::isAdmin()) {
        $where .= " AND p.id_usuario = ?";
        $params[] = $_SESSION['usuario']['id'];
    }

    $sql = "
        SELECT p.id AS id_prestamo, u.nombre, u.apellido, h.nombre AS herramienta, dp.cantidad, dp.id_herramienta, dp.id AS id_detalle,
            p.fecha_prestamo, p.fecha_devolucion_estimada, p.fecha_devolucion_real, p.estado
        FROM prestamos p
        JOIN usuarios u ON p.id_usuario = u.id
        JOIN detalle_prestamos dp ON p.id = dp.id_prestamo
        JOIN herramientas h ON dp.id_herramienta = h.id
        $where
        ORDER BY p.fecha_prestamo DESC
    ";
    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}
