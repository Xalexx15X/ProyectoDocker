-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS proyectodocker;

-- Usar la base de datos
USE proyectodocker;

-- Crear la tabla users
CREATE TABLE IF NOT EXISTS kebab (
    idKebab INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(45) NOT NULL,
    precio DOUBLE NOT NULL
);

