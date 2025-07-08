<?php
/**
 * validation.php
 * Funções utilitárias para validação e formatação de dados de usuário.
 * 
 * - only_numbers: Remove caracteres não numéricos de uma string.
 * - is_valid_cpf: Valida se o CPF possui 11 dígitos.
 * - format_cpf: Formata o CPF para o padrão XXX.XXX.XXX-XX.
 * - is_valid_telefone: Valida se o telefone possui 10 ou 11 dígitos.
 * - format_telefone: Formata o telefone para padrão brasileiro.
 * - is_valid_email: Valida o formato do email.
 * - senhas_iguais: Verifica se duas senhas são iguais.
 */

/**
 * Remove todos os caracteres não numéricos de uma string.
 */
function only_numbers($value) {
    return preg_replace('/\D/', '', $value);
}

/**
 * Valida se o CPF possui 11 dígitos.
 */
function is_valid_cpf($cpf) {
    return strlen($cpf) === 11;
}

/**
 * Formata o CPF para o padrão XXX.XXX.XXX-XX.
 */
function format_cpf($cpf) {
    return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
}

/**
 * Valida se o telefone possui 10 ou 11 dígitos.
 */
function is_valid_telefone($telefone) {
    $len = strlen($telefone);
    return $len === 10 || $len === 11;
}

/**
 * Formata o telefone para o padrão brasileiro.
 */
function format_telefone($telefone) {
    if (strlen($telefone) == 11) {
        // Celular: (XX) XXXXX-XXXX
        return '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 5) . '-' . substr($telefone, 7, 4);
    } else {
        // Fixo: (XX) XXXX-XXXX
        return '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 4) . '-' . substr($telefone, 6, 4);
    }
}

/**
 * Valida o formato do email.
 */
function is_valid_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Verifica se duas senhas são iguais.
 */
function senhas_iguais($senha, $confirma_senha) {
    return $senha === $confirma_senha;
}
