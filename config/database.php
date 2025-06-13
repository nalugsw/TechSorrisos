<?php
/**
 * Arquivo de configuração do banco de dados
 * Este arquivo estabelece a conexão com o banco de dados MySQL usando PDO
 * 
 * Parâmetros de conexão:
 * - host: endereço do servidor (localhost para desenvolvimento local)
 * - dbname: nome do banco de dados da clínica
 * - username: usuário do MySQL (root por padrão em desenvolvimento)
 * - password: senha do MySQL
 */

// Definição das credenciais do banco de dados
$host = 'localhost'; // Servidor MySQL local
$dbname = 'clinica_odonto'; // Nome do banco de dados
$username = 'root'; // Usuário padrão do Laragon
$password = ''; // Senha vazia por padrão no Laragon

try {
    // Criação da conexão PDO com o banco de dados
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Configuração para lançar exceções em caso de erros
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Configuração para retornar resultados como arrays associativos
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Em caso de erro na conexão, interrompe a execução e exibe a mensagem
    die("Erro de conexão com o banco de dados: " . $e->getMessage());
}