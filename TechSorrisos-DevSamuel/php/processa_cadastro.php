<?php
/**
 * Arquivo de processamento de cadastro de usuários
 * 
 * Este script é responsável por:
 * 1. Validar os dados do formulário de cadastro
 * 2. Formatar dados como CPF e telefone
 * 3. Verificar duplicidade de cadastro
 * 4. Criar novo usuário no banco de dados
 * 5. Gerenciar feedback para o usuário
 */

session_start();
require_once '../config/database.php';
// Importa funções utilitárias de validação e formatação
require_once __DIR__ . '/utils/validation.php';

// Verificar se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera e limpa os dados do formulário
    $nome_completo = trim($_POST['nome_completo']);
    $cpf = trim($_POST['cpf']);
    $telefone = trim($_POST['telefone']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $confirma_senha = $_POST['confirma_senha'];
    
    // Validação dos campos obrigatórios
    if (empty($nome_completo) || empty($cpf) || empty($telefone) || empty($email) || empty($senha) || empty($confirma_senha)) {
        $_SESSION['msg'] = "Todos os campos são obrigatórios.";
        $_SESSION['alert_type'] = "error";
        header("Location: cadastro.php");
        exit;
    }
    
    // Validação e formatação do CPF
    $cpf = only_numbers($cpf);
    if (!is_valid_cpf($cpf)) {
        $_SESSION['msg'] = "CPF inválido.";
        $_SESSION['alert_type'] = "error";
        header("Location: cadastro.php");
        exit;
    }
    
    // Validação e formatação do telefone
    $telefone = only_numbers($telefone);
    if (!is_valid_telefone($telefone)) {
        $_SESSION['msg'] = "Telefone inválido.";
        $_SESSION['alert_type'] = "error";
        header("Location: cadastro.php");
        exit;
    }
    
    // Validação do formato do email
    if (!is_valid_email($email)) {
        $_SESSION['msg'] = "E-mail inválido.";
        $_SESSION['alert_type'] = "error";
        header("Location: cadastro.php");
        exit;
    }
    
    // Validação de senha
    if (!senhas_iguais($senha, $confirma_senha)) {
        $_SESSION['msg'] = "As senhas não coincidem.";
        $_SESSION['alert_type'] = "error";
        header("Location: cadastro.php");
        exit;
    }
    
    try {
        // Verifica se já existe usuário com mesmo CPF ou email
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE cpf = ? OR email = ?");
        $stmt->execute([$cpf, $email]);
        
        if ($stmt->rowCount() > 0) {
            $_SESSION['msg'] = "CPF ou e-mail já cadastrado.";
            $_SESSION['alert_type'] = "error";
            header("Location: cadastro.php");
            exit;
        }
        
        // Formatação do CPF para exibição (XXX.XXX.XXX-XX)
        $cpf_formatado = format_cpf($cpf);
        
        // Formatação do telefone para exibição
        $telefone_formatado = format_telefone($telefone);
        
        // Cria hash seguro da senha
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        
        // Insere novo usuário no banco de dados
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome_completo, cpf, telefone, email, senha) VALUES (?, ?, ?, ?, ?)");
        $resultado = $stmt->execute([$nome_completo, $cpf_formatado, $telefone_formatado, $email, $senha_hash]);
        
        if ($resultado) {
            // Cadastro realizado com sucesso
            $_SESSION['msg'] = "Cadastro realizado com sucesso! Faça o login para acessar.";
            $_SESSION['alert_type'] = "success";
            header("Location: login.php");
            exit;
        } else {
            // Erro ao cadastrar
            $_SESSION['msg'] = "Erro ao cadastrar. Tente novamente.";
            $_SESSION['alert_type'] = "error";
            header("Location: cadastro.php");
            exit;
        }
        
    } catch (PDOException $e) {
        // Tratamento de erros do banco de dados
        $_SESSION['msg'] = "Erro ao cadastrar: " . $e->getMessage();
        $_SESSION['alert_type'] = "error";
        header("Location: cadastro.php");
        exit;
    }
} else {
    // Se não for método POST, redireciona para a página de cadastro
    header("Location: cadastro.php");
    exit;
}