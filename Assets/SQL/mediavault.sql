CREATE DATABASE IF NOT EXISTS mediavault;
USE mediavault;

-- Tabla de usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Tabla de contenido (reemplaza 'archivos')
CREATE TABLE contenido (
    id INT AUTO_INCREMENT PRIMARY KEY,
    
    nombre VARCHAR(255) NOT NULL,
    descripcion VARCHAR(500),

    archivo VARCHAR(500),   -- ruta al archivo subido
    url VARCHAR(500),       -- URL externa opcional

    tipo ENUM('imagen', 'video', 'texto') NOT NULL,

    usuario_id INT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);
