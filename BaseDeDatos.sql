DROP DATABASE IF EXISTS GAMERSXPRESSION;
CREATE DATABASE IF NOT EXISTS GAMERSXPRESSION;
USE GAMERSXPRESSION;


CREATE TABLE IF NOT EXISTS compania (
  id_compania INT AUTO_INCREMENT,
  nombre VARCHAR(45) NOT NULL,
  PRIMARY KEY (id_compania)
);

INSERT INTO compania
    VALUE (NULL, "KONAMI"),(NULL, "Midway"),(NULL, "Naughty Dog");


CREATE TABLE IF NOT EXISTS categoria (
  id_categoria INT AUTO_INCREMENT,
  categoria VARCHAR(45) NULL,
  PRIMARY KEY (id_categoria)
);

INSERT INTO categoria
    VALUE (NULL, "Acción"),(NULL, "Ciencia Ficción"),(NULL, "Terror");

CREATE TABLE IF NOT EXISTS juego (

    id_juego INT AUTO_INCREMENT,
    nombre VARCHAR(45),
    historia_resumida VARCHAR(2000),
    calificacion DOUBLE,
    imagen BLOB,
    id_compania INT NOT NULL,
    id_juego_secuela INT NULL,
    id_categoria INT NOT NULL,
    PRIMARY KEY (id_juego),
    FOREIGN KEY (id_juego_secuela) REFERENCES juego (id_juego),
    FOREIGN KEY (id_compania) REFERENCES compania (id_compania),
    FOREIGN KEY (id_categoria) REFERENCES categoria (id_categoria)
);

CREATE TABLE IF NOT EXISTS tipo_usuario (
  id_tipo_usuario INT AUTO_INCREMENT,
  tipo VARCHAR(45),
  PRIMARY KEY (id_tipo_usuario)
);

INSERT INTO tipo_usuario 
    VALUES (NULL, "MODERADOR"),(NULL, "ADMINISTRADOR"),(NULL, "USUARIO");


CREATE TABLE IF NOT EXISTS usuario (
    id_usuario INT AUTO_INCREMENT,
    nombre VARCHAR(45),
    correo VARCHAR(45),
    contraseña VARCHAR(45),
    estado VARCHAR(45),
    id_tipo_usuario INT NOT NULL,
    PRIMARY KEY (id_usuario),
    FOREIGN KEY (id_tipo_usuario)
        REFERENCES tipo_usuario (id_tipo_usuario)
);

INSERT INTO usuario 
    VALUES  (NULL, "Vardoc Funao", "VardocElMejorDeOverwatch@gmail.cl", "14copas", "HABILITADO", 3),
            (NULL, "SoyAdmin", "adminsoy@gmail.cl", "adm", "HABILITADO", 2);


CREATE TABLE IF NOT EXISTS publicacion (

    id_publicacion INT AUTO_INCREMENT,
    titulo VARCHAR(45),
    contenido VARCHAR(2000),
    imagen BLOB ,
    me_gusta INT,
    fecha DATETIME,
    id_juego INT NOT NULL,
    id_usuario INT NOT NULL,
    PRIMARY KEY (id_publicacion),
    FOREIGN KEY (id_juego)
        REFERENCES juego (id_juego),
    FOREIGN KEY (id_usuario)
        REFERENCES usuario (id_usuario)
);


CREATE TABLE IF NOT EXISTS comentario (

    id_comentario INT AUTO_INCREMENT,
    comentario VARCHAR(800),
    fecha DATE,
    id_publicacion INT NOT NULL,
    id_usuario INT NOT NULL,
    PRIMARY KEY (id_comentario),
    FOREIGN KEY (id_publicacion)
        REFERENCES publicacion (id_publicacion),
    FOREIGN KEY (id_usuario)
        REFERENCES usuario (id_usuario)
  
);

CREATE TABLE IF NOT EXISTS razon_report (

    id_razon_report INT AUTO_INCREMENT,
    razon VARCHAR(45),
    PRIMARY KEY (id_razon_report)
  
);


CREATE TABLE IF NOT EXISTS report_comentario (
  
    id_report_comentario INT AUTO_INCREMENT,
    id_razones_report INT NOT NULL,
    descripcion VARCHAR(200),
    fecha DATE,
    id_comentario INT NOT NULL,
    id_usuario INT NOT NULL,
    PRIMARY KEY (id_report_comentario),
    FOREIGN KEY (id_comentario)
        REFERENCES comentario (id_comentario),
    FOREIGN KEY (id_usuario)
        REFERENCES usuario (id_usuario),
    FOREIGN KEY (id_razones_report)
        REFERENCES razon_report (id_razon_report)

);


CREATE TABLE IF NOT EXISTS report_publicacion(
  
    id_report_publicacion INT AUTO_INCREMENT,
    id_razon_report INT NOT NULL,
    descripcion VARCHAR(200),
    fecha DATE,
    id_publicacion INT NOT NULL,
    id_usuario INT NOT NULL,
    PRIMARY KEY (id_report_publicacion),
    FOREIGN KEY (id_razon_report)
        REFERENCES razon_report (id_razon_report),
    FOREIGN KEY (id_publicacion)
        REFERENCES publicacion (id_publicacion),
    FOREIGN KEY (id_usuario)
        REFERENCES usuario (id_usuario)
);


CREATE TABLE IF NOT EXISTS me_gusta (

    id_me_gusta INT AUTO_INCREMENT,
    me_gusta INT,
    id_usuario INT NOT NULL,
    id_publicacion INT NOT NULL,
    PRIMARY KEY (id_me_gusta),
    FOREIGN KEY (id_usuario)
        REFERENCES usuario (id_usuario),
    FOREIGN KEY (id_publicacion)
        REFERENCES publicacion (id_publicacion)
);

CREATE TABLE IF NOT EXISTS calificacion (

    id_calificacion INT AUTO_INCREMENT,
    calificacion INT,
    id_usuario INT NOT NULL,
    id_juego INT NOT NULL,
    PRIMARY KEY (id_calificacion),
    FOREIGN KEY (id_usuario)
        REFERENCES usuario (id_usuario),
    FOREIGN KEY (id_juego)
        REFERENCES juego (id_juego)
);

