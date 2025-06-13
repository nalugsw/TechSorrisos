# Guia de Desenvolvimento - TechSorrisos

## Estrutura do Sistema

### 1. Autenticação

- `login.php`: Página de login
- `cadastro.php`: Cadastro de novos usuários
- `criar_senha.php`: Recuperação de senha
- Arquivos de processamento:
  - `processa_login.php`
  - `processa_cadastro.php`
  - `processa_senha.php`

### 2. Páginas Principais

- `home.php`: Dashboard principal
- `especialidades.php`: Lista de especialidades
- `politicas-privacidade.php`: Termos e políticas

### 3. Estilos (CSS)

- `login.css`: Estilos das páginas de autenticação
- `home.css`: Estilos do dashboard e componentes comuns
- `especialidades.css`: Estilos específicos das especialidades
- `politicas.css`: Estilos da página de políticas

### 4. JavaScript

- `script.js`: Validações e máscaras de formulário
- `home.js`: Funcionalidades do dashboard e menu

## Padrões de Código

### 1. PHP

- Use PDO para conexões com banco de dados
- Sempre valide inputs do usuário
- Use password_hash() para senhas
- Mantenha sessões seguras

### 2. JavaScript

- Use event listeners para interações
- Implemente validações client-side
- Mantenha o código modular
- Use máscaras para campos formatados

### 3. CSS

- Siga a metodologia BEM para classes
- Mantenha a responsividade
- Use variáveis CSS para cores
- Mantenha a consistência visual

## Banco de Dados

### Tabela: usuarios

```sql
id              - INT (PK, AUTO_INCREMENT)
nome_completo   - VARCHAR(100)
cpf            - VARCHAR(14) UNIQUE
telefone       - VARCHAR(15)
email          - VARCHAR(100) UNIQUE
senha          - VARCHAR(255)
data_cadastro  - DATETIME
```

## Fluxos Principais

### 1. Cadastro de Usuário

1. Usuário acessa cadastro.php
2. Preenche formulário
3. processa_cadastro.php valida dados
4. Salva no banco de dados
5. Redireciona para login

### 2. Login

1. Usuário acessa login.php
2. Insere credenciais
3. processa_login.php verifica dados
4. Cria sessão
5. Redireciona para home.php

### 3. Recuperação de Senha

1. Usuário acessa criar_senha.php
2. Insere email
3. Insere nova senha
4. processa_senha.php atualiza banco
5. Redireciona para login

## Segurança

### 1. Proteção contra SQL Injection

- Use prepared statements
- Escape caracteres especiais
- Valide tipos de dados

### 2. Proteção contra XSS

- Use htmlspecialchars()
- Valide inputs
- Sanitize outputs

### 3. Senhas

- Use password_hash()
- Nunca armazene senhas em texto plano
- Use salt automático

## Manutenção

### 1. Logs

- Verifique logs do Apache
- Monitore erros PHP
- Acompanhe logs do MySQL

### 2. Backup

- Faça backup do banco regularmente
- Mantenha cópia dos arquivos
- Documente alterações

### 3. Atualizações

- Mantenha o PHP atualizado
- Atualize bibliotecas
- Verifique segurança

## Dicas de Desenvolvimento

### 1. Ambiente Local

- Use XAMPP para desenvolvimento
- Ative error_reporting
- Use ferramentas de debug

### 2. Boas Práticas

- Comente o código
- Mantenha padrão de nomenclatura
- Faça commits frequentes

### 3. Testes

- Teste em diferentes navegadores
- Verifique responsividade
- Valide formulários

## Recursos Úteis

### 1. Documentação

- [PHP Documentation](https://www.php.net/docs.php)
- [MDN Web Docs](https://developer.mozilla.org)
- [MySQL Documentation](https://dev.mysql.com/doc/)

### 2. Ferramentas

- Visual Studio Code
- MySQL Workbench
- Chrome DevTools

### 3. Bibliotecas

- Font Awesome (ícones)
- PHPMailer (se implementar envio de emails)
- jQuery (se necessário)
