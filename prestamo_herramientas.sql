CREATE DATABASE IF NOT EXISTS prestamo_herramientas1;
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
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Tabla detalle de préstamos
CREATE TABLE IF NOT EXISTS detalle_prestamos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_prestamo INT NOT NULL,
    id_herramienta INT NOT NULL,
    cantidad INT NOT NULL,
    devuelto TINYINT(1) DEFAULT 0,
    FOREIGN KEY (id_prestamo) REFERENCES prestamos(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_herramienta) REFERENCES herramientas(id) ON DELETE CASCADE ON UPDATE CASCADE
);
-- Inserción de usuarios
INSERT INTO usuarios (nombre, apellido, email, password, rol) VALUES
('Admin', 'Sistema', 'admin@test.com', 'admin123', 'admin'),
('Juan', 'Perez', 'juan@test.com', 'juan123', 'usuario'),
('Maria', 'Gomez', 'maria@test.com', 'maria123', 'usuario'),
('Carlos', 'Lopez', 'carlos@test.com', 'carlos123', 'usuario'),
('Ana', 'Martinez', 'ana@test.com', 'ana123', 'usuario'),
('Luis', 'Garcia', 'luis@test.com', 'luis123', 'usuario'),
('Sofia', 'Rodriguez', 'sofia@test.com', 'sofia123', 'usuario'),
('Pedro', 'Sanchez', 'pedro@test.com', 'pedro123', 'usuario'),
('Laura', 'Fernandez', 'laura@test.com', 'laura123', 'usuario'),
('David', 'Torres', 'david@test.com', 'david123', 'usuario'),
('Elena', 'Diaz', 'elena@test.com', 'elena123', 'usuario'),
('Pablo', 'Ruiz', 'pablo@test.com', 'pablo123', 'usuario'),
('Marta', 'Jimenez', 'marta@test.com', 'marta123', 'usuario'),
('Javier', 'Moreno', 'javier@test.com', 'javier123', 'usuario'),
('Lucia', 'Alvarez', 'lucia@test.com', 'lucia123', 'usuario'),
('Raul', 'Romero', 'raul@test.com', 'raul123', 'usuario'),
('Carmen', 'Navarro', 'carmen@test.com', 'carmen123', 'usuario'),
('Alberto', 'Morales', 'alberto@test.com', 'alberto123', 'usuario'),
('Isabel', 'Ortega', 'isabel@test.com', 'isabel123', 'usuario'),
('Diego', 'Rubio', 'diego@test.com', 'diego123', 'usuario');
-- Inserción de herramientas
INSERT INTO herramientas (nombre, descripcion, cantidad_disponible) VALUES
('Martillo', 'Martillo de carpintero estándar', 15),
('Destornillador plano', 'Destornillador de cabeza plana mediano', 20),
('Destornillador estrella', 'Destornillador Phillips #2', 18),
('Llave inglesa', 'Llave ajustable de 8 pulgadas', 12),
('Alicates', 'Alicates de punta fina', 10),
('Sierra manual', 'Sierra para madera de 20 pulgadas', 8),
('Taladro eléctrico', 'Taladro inalámbrico 18V', 5),
('Llave de tubo', 'Juego de llaves de tubo 10 piezas', 6),
('Cinta métrica', 'Cinta métrica de 5 metros', 25),
('Nivel', 'Nivel de burbuja de 60 cm', 10),
('Pala', 'Pala de jardinería', 7),
('Carretilla', 'Carretilla de obra', 4),
('Escalera', 'Escalera extensible de 3 metros', 3),
('Cincel', 'Juego de cinceles para metal', 9),
('Soplete', 'Soplete de gas butano', 2),
('Pistola de silicona', 'Pistola termofusible para silicona', 5),
('Cortador de azulejos', 'Cortador manual para cerámica', 4),
('Flexómetro', 'Flexómetro de 8 metros', 12),
('Brochas', 'Juego de brochas para pintura', 15),
('Rodillo', 'Rodillo para pintar paredes', 8);
-- Inserción de préstamos
INSERT INTO prestamos (id_usuario, fecha_prestamo, fecha_devolucion_estimada, fecha_devolucion_real, estado) VALUES
(2, '2023-01-05', '2023-01-12', '2023-01-11', 'devuelto'),
(3, '2023-01-07', '2023-01-14', '2023-01-15', 'devuelto'),
(4, '2023-01-10', '2023-01-17', NULL, 'activo'),
(5, '2023-01-12', '2023-01-19', '2023-01-18', 'devuelto'),
(6, '2023-01-15', '2023-01-22', NULL, 'activo'),
(7, '2023-01-18', '2023-01-25', '2023-01-24', 'devuelto'),
(8, '2023-01-20', '2023-01-27', '2023-01-26', 'devuelto'),
(9, '2023-01-22', '2023-01-29', NULL, 'activo'),
(10, '2023-01-25', '2023-02-01', '2023-01-31', 'devuelto'),
(11, '2023-01-28', '2023-02-04', NULL, 'activo'),
(12, '2023-02-01', '2023-02-08', '2023-02-07', 'devuelto'),
(13, '2023-02-03', '2023-02-10', '2023-02-09', 'devuelto'),
(14, '2023-02-05', '2023-02-12', NULL, 'activo'),
(15, '2023-02-08', '2023-02-15', '2023-02-14', 'devuelto'),
(16, '2023-02-10', '2023-02-17', NULL, 'activo'),
(17, '2023-02-12', '2023-02-19', '2023-02-18', 'devuelto'),
(18, '2023-02-15', '2023-02-22', '2023-02-21', 'devuelto'),
(19, '2023-02-18', '2023-02-25', NULL, 'activo'),
(20, '2023-02-20', '2023-02-27', '2023-02-26', 'devuelto'),
(2, '2023-02-22', '2023-03-01', NULL, 'activo');
-- Inserción de detalle de préstamos
INSERT INTO detalle_prestamos (id_prestamo, id_herramienta, cantidad, devuelto) VALUES
(1, 1, 1, 1),
(1, 3, 1, 1),
(2, 5, 2, 1),
(3, 7, 1, 0),
(4, 2, 1, 1),
(4, 4, 1, 1),
(5, 6, 1, 0),
(6, 8, 1, 1),
(7, 10, 1, 1),
(8, 12, 1, 0),
(9, 14, 2, 1),
(10, 16, 1, 0),
(11, 18, 1, 1),
(12, 20, 1, 1),
(13, 1, 1, 0),
(14, 3, 1, 1),
(15, 5, 1, 0),
(16, 7, 1, 1),
(17, 9, 2, 1),
(18, 11, 1, 0),
(19, 13, 1, 1),
(20, 15, 1, 0);