<?php
/**
 * logout.php
 * Script responsável por encerrar a sessão do usuário
 * 
 * Este arquivo realiza:
 * 1. Inicialização da sessão atual
 * 2. Limpeza de todas as variáveis de sessão
 * 3. Destruição da sessão
 * 4. Redirecionamento para a página de login
 */

session_start();

// Limpa todas as variáveis de sessão
$_SESSION = array();

// Destrói a sessão atual
session_destroy();

// Redireciona para a página de login
header("Location: login.php");
exit;
