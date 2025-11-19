CREATE DATABASE bd_biblioteca;
USE bd_biblioteca;

CREATE TABLE autor (
id_autor INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(45),
nacionalidade VARCHAR(50),
data_nascimento DATE,
biografia TEXT,
);

CREATE TABLE livros (
 id_livro INT PRIMARY KEY AUTO_INCREMENT,
 titulo VARCHAR(100) NOT NULL,
 categoria VARCHAR(50) NOT NULL,
 data_lancamento DATE,
 qtd_pagina INT NOT NULL,
 editora VARCHAR(50) NOT NULL,
 fk_autor INT,
 FOREIGN KEY (fk_autor) REFERENCES autor(id_autor)
);

CREATE TABLE clientes (
 id_cliente INT PRIMARY KEY AUTO_INCREMENT,
 nome VARCHAR(50) NOT NULL,
 idade INT NOT NULL,
 rg VARCHAR(20) NOT NULL,
 email VARCHAR(45) NOT NULL
);

CREATE TABLE emprestimo (
 id_emprestimo INT PRIMARY KEY AUTO_INCREMENT,
 data_emp DATETIME NOT NULL,
 data_devolucao DATETIME NOT NULL,
 fk_livro INT,
 fk_cliente INT,
 FOREIGN KEY (fk_livro) REFERENCES livros(id_livro),
 FOREIGN KEY (fk_cliente) REFERENCES clientes(id_cliente)
);

INSERT INTO autor (nome, idade) VALUES
('Machado de Assis', 69),
('Clarice Lispector', 56),
('Jorge Amado', 88);

INSERT INTO livros (titulo, categoria, data_lancamento, qtd_pagina, editora, fk_autor) VALUES
('Dom Casmurro', 'Romance', '1899-01-01', 256, 'Editora A', 1),
('A Hora da Estrela', 'Ficção', '1977-10-01', 96, 'Editora B', 2),
('Capitães da Areia', 'Romance', '1937-05-01', 280, 'Editora C', 3);

INSERT INTO clientes (nome, idade, rg) VALUES
('Ana Souza', 25, '12345678-9'),
('Carlos Lima', 32, '98765432-1'),
('Juliana Alves', 29, '45678912-3');

INSERT INTO emprestimo (data_emp, data_devolucao, fk_livro, fk_cliente) VALUES
('2025-10-01 10:00:00', '2025-10-15 10:00:00', 1, 1),
('2025-10-02 14:30:00', '2025-10-16 14:30:00', 2, 2),
('2025-10-03 09:00:00', '2025-10-17 09:00:00', 3, 3);

SELECT 
    e.id_emprestimo,
    c.nome AS cliente,
    l.titulo AS livro,
    e.data_emp,
    e.data_devolucao
FROM emprestimo e
JOIN clientes c ON e.fk_cliente = c.id_cliente
JOIN livros l ON e.fk_livro = l.id_livro;


