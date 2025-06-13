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
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    if (strlen($cpf) != 11) {
        $_SESSION['msg'] = "CPF inválido.";
        $_SESSION['alert_type'] = "error";
        header("Location: cadastro.php");
        exit;
    }
    
    // Validação e formatação do telefone
    $telefone = preg_replace('/[^0-9]/', '', $telefone);
    if (strlen($telefone) < 10 || strlen($telefone) > 11) {
        $_SESSION['msg'] = "Telefone inválido.";
        $_SESSION['alert_type'] = "error";
        header("Location: cadastro.php");
        exit;
    }
    
    // Validação do formato do email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['msg'] = "E-mail inválido.";
        $_SESSION['alert_type'] = "error";
        header("Location: cadastro.php");
        exit;
    }
    
    // Validação de senha
    if ($senha !== $confirma_senha) {
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
        $cpf_formatado = substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
        
        // Formatação do telefone para exibição
        if (strlen($telefone) == 11) {
            // Formato celular: (XX) XXXXX-XXXX
            $telefone_formatado = '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 5) . '-' . substr($telefone, 7, 4);
        } else {
            // Formato fixo: (XX) XXXX-XXXX
            $telefone_formatado = '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 4) . '-' . substr($telefone, 6, 4);
        }
        
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