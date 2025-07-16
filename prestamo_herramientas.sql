CREATE DATABASE IF NOT EXISTS prestamo_herramientas;
USE prestamo_herramientas;

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'usuario') NOT NULL
);

-- Tabla de herramientas
CREATE TABLE IF NOT EXISTS herramientas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    cantidad_disponible INT UNSIGNED NOT NULL DEFAULT 0
);

-- Tabla de préstamos
CREATE TABLE IF NOT EXISTS prestamos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    fecha_prestamo DATE NOT NULL,
    fecha_devolucion_estimada DATE NOT NULL,
    fecha_devolucion_real DATE DEFAULT NULL,
    estado ENUM('activo', 'devuelto') DEFAULT 'activo',
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE,
);

CREATE TABLE IF NOT EXISTS detalle_prestamos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_prestamo INT NOT NULL,
    id_herramienta INT NOT NULL,
    cantidad INT NOT NULL,
    devuelto TINYINT(1) DEFAULT 0;
    FOREIGN KEY (id_prestamo) REFERENCES prestamos(id) ON DELETE CASCADE,
    FOREIGN KEY (id_herramienta) REFERENCES herramientas(id)
);


