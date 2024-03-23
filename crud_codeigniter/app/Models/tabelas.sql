CREATE DATABASE biblioteca;

CREATE TABLE usuarios(
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(128) UNIQUE NOT NULL,
    nome VARCHAR(128) NOT NULL,
    senha VARCHAR(128) NOT NULL,
    tipo char(1) NOT NULL 
);

CREATE TABLE livros(
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(128) UNIQUE NOT NULL,
    autor VARCHAR(128) NOT NULL,
    editora VARCHAR(128) NOT NULL,
    quantidade INT NOT NULL,
    ano INT NOT NULL
);

CREATE TABLE alugueis(
    id INT AUTO_INCREMENT PRIMARY KEY,
    inicio DATETIME NOT NULL,
    usuario_id INT,
    livro_id INT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (livro_id) REFERENCES livros(id) ON DELETE CASCADE ON UPDATE CASCADE
);