/**
 * Script SQL para criação do banco de dados da clínica
 * 
 * Este script:
 * 1. Cria o banco de dados clinica_odonto
 * 2. Define a tabela de usuários com todos os campos necessários
 * 3. Estabelece restrições de unicidade para CPF e email
 */

-- Criação do banco de dados
CREATE DATABASE clinica_odonto;
USE clinica_odonto;

-- Criação da tabela de usuários
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,                    -- ID único do usuário
    nome_completo VARCHAR(100) NOT NULL,                 -- Nome completo do usuário
    cpf VARCHAR(14) UNIQUE NOT NULL,                     -- CPF com formato XXX.XXX.XXX-XX
    telefone VARCHAR(15) NOT NULL,                       -- Telefone com formato (XX) XXXXX-XXXX
    email VARCHAR(100) UNIQUE NOT NULL,                  -- Email único do usuário
    senha VARCHAR(255) NOT NULL,                         -- Senha criptografada
    data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP     -- Data e hora do cadastro
);

-- Comando para visualizar todos os usuários
select * from usuarios;