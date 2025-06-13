<?php
/**
 * processa_senha.php
 * Arquivo responsável por processar a criação/alteração de senha
 * 
 * Este script realiza:
 * 1. Validação do email e senha fornecidos
 * 2. Verificação da existência do usuário
 * 3. Atualização segura da senha no banco de dados
 * 4. Feedback apropriado para o usuário
 */

session_start();
require_once '../config/database.php';

// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera e limpa os dados do formulário
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $confirma_senha = $_POST['confirma_senha'];
    
    // Validação dos campos obrigatórios
    if (empty($email) || empty($senha) || empty($confirma_senha)) {
        $_SESSION['msg'] = "Todos os campos são obrigatórios.";
        $_SESSION['alert_type'] = "error";
        header("Location: criar_senha.php");
        exit;
    }
    
    // Validação do formato do email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['msg'] = "E-mail inválido.";
        $_SESSION['alert_type'] = "error";
        header("Location: criar_senha.php");
        exit;
    }
    
    // Validação de senha e confirmação
    if ($senha !== $confirma_senha) {
        $_SESSION['msg'] = "As senhas não coincidem.";
        $_SESSION['alert_type'] = "error";
        header("Location: criar_senha.php");
        exit;
    }
    
    try {
        // Verifica se o email existe no banco de dados
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() === 0) {
            $_SESSION['msg'] = "E-mail não cadastrado.";
            $_SESSION['alert_type'] = "error";
            header("Location: criar_senha.php");
            exit;
        }
        
        // Cria hash seguro da nova senha
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        
        // Atualiza a senha no banco de dados
        $stmt = $pdo->prepare("UPDATE usuarios SET senha = ? WHERE email = ?");
        $resultado = $stmt->execute([$senha_hash, $email]);
        
        if ($resultado) {
            // Senha atualizada com sucesso
            $_SESSION['msg'] = "Senha atualizada com sucesso! Faça o login para acessar.";
            $_SESSION['alert_type'] = "success";
            header("Location: login.php");
            exit;
        } else {
            // Erro na atualização
            $_SESSION['msg'] = "Erro ao atualizar senha. Tente novamente.";
            $_SESSION['alert_type'] = "error";
            header("Location: criar_senha.php");
            exit;
        }
        
    } catch (PDOException $e) {
        // Tratamento de erros do banco de dados
        $_SESSION['msg'] = "Erro ao atualizar senha: " . $e->getMessage();
        $_SESSION['alert_type'] = "error";
        header("Location: criar_senha.php");
        exit;
    }
} else {
    // Se não for método POST, redireciona para a página de criação de senha
    header("Location: criar_senha.php");
    exit;
}