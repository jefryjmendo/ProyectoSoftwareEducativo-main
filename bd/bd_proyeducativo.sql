CREATE DATABASE IF NOT EXISTS aplicacion;
USE aplicacion;

-- Tabla Usuarios
CREATE TABLE usuarios (
    usuario_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('docente', 'estudiante') NOT NULL
);

-- Tabla Temas
CREATE TABLE temas (
    tema_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    docente_id INT NOT NULL,
    FOREIGN KEY (docente_id) REFERENCES usuarios(usuario_id)
);

-- Tabla Tests
CREATE TABLE tests (
    test_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    tema_id INT NOT NULL,
    FOREIGN KEY (tema_id) REFERENCES temas(tema_id)
);

-- Tabla Preguntas
CREATE TABLE preguntas (
    pregunta_id INT AUTO_INCREMENT PRIMARY KEY,
    contenido TEXT NOT NULL,
    test_id INT NOT NULL,
    FOREIGN KEY (test_id) REFERENCES tests(test_id)
);

-- Tabla Resultados_Tests
CREATE TABLE resultados_tests (
    resultado_id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    test_id INT NOT NULL,
    puntaje DECIMAL(5, 2) NOT NULL,
    fecha DATETIME NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(usuario_id),
    FOREIGN KEY (test_id) REFERENCES tests(test_id)
);
