-- Cria o banco de dados: tabelas
CREATE DATABASE tabelas;

-- Acessar o banco de dados Tabelas para executar comandos SQL
USE tabelas;

-- Cria a tabela de produtos
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    estoque INT NOT NULL
);

-- Insere dados na tabela de produtos
INSERT INTO produtos (nome, preco, estoque) VALUES
('Notebook', 2500.00, 15),
('Mouse', 50.00, 30),
('Teclado', 120.00, 25);

-- Cria a tabela de vendas
CREATE TABLE vendas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    trimestre VARCHAR(50) NOT NULL,
    valor DECIMAL(10, 2) NOT NULL
);

-- Insere dados na tabela de vendas
INSERT INTO vendas (trimestre, valor) VALUES
('1º Trimestre', 50000.00),
('2º Trimestre', 65000.00);