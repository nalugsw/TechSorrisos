<?php
/**
 * Arquivo de processamento do login de usuários
 * 
 * Este script é responsável por:
 * 1. Validar as credenciais do usuário
 * 2. Autenticar o usuário no sistema
 * 3. Criar a sessão do usuário
 * 4. Redirecionar para a página apropriada
 */

session_start();
require_once '../config/database.php';
// Importa funções utilitárias de validação
require_once __DIR__ . '/utils/validation.php';

// Verificar se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera e limpa os dados do formulário
    $usuario = trim($_POST['usuario']); // Pode ser email ou CPF
    $senha = $_POST['senha'];
    
    // Validação básica dos campos
    if (empty($usuario) || empty($senha)) {
        $_SESSION['msg'] = "Preencha todos os campos.";
        $_SESSION['alert_type'] = "error";
        header("Location: login.php");
        exit;
    }
    
    try {
        // Busca o usuário no banco de dados (por email ou CPF)
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ? OR cpf = ?");
        $stmt->execute([$usuario, $usuario]);
        $user = $stmt->fetch();
        
        // Verifica se o usuário existe
        if (!$user) {
            $_SESSION['msg'] = "Usuário não encontrado.";
            $_SESSION['alert_type'] = "error";
            header("Location: login.php");
            exit;
        }
        
        // Verifica se a senha está correta usando hash seguro
        if (password_verify($senha, $user['senha'])) {
            // Login bem-sucedido - Cria variáveis de sessão
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['usuario_nome'] = $user['nome_completo'];
            $_SESSION['usuario_email'] = $user['email'];
            
            // Redireciona para a página inicial após login
            header("Location: home.php");
            exit;
        } else {
            // Senha incorreta
            $_SESSION['msg'] = "Senha incorreta.";
            $_SESSION['alert_type'] = "error";
            header("Location: login.php");
            exit;
        }
        
    } catch (PDOException $e) {
        // Tratamento de erros do banco de dados
        $_SESSION['msg'] = "Erro ao fazer login: " . $e->getMessage();
        $_SESSION['alert_type'] = "error";
        header("Location: login.php");
        exit;
    }
} else {
    // Se não for método POST, redireciona para a página de login
    header("Location: login.php");
    exit;
}