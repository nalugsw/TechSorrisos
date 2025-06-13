# Guia de Instalação - TechSorrisos

## Pré-requisitos

1. XAMPP (Versão 8.0 ou superior)
   - Apache
   - MySQL
   - PHP 8.0+

## Passo a Passo

### 1. Instalação do XAMPP

1. Baixe o XAMPP do site oficial: https://www.apachefriends.org/
2. Execute o instalador
3. Instale no diretório padrão (C:\xampp)

### 2. Configuração do Projeto

1. Clone ou copie os arquivos do projeto para a pasta:

   ```
   C:\xampp\htdocs\TechSorrisos\
   ```

2. Inicie os serviços do XAMPP:
   - Abra o Painel de Controle do XAMPP
   - Inicie o Apache
   - Inicie o MySQL

### 3. Configuração do Banco de Dados

1. Abra o navegador e acesse: http://localhost/phpmyadmin
2. Crie um novo banco de dados:
   - Nome: clinica_odonto
   - Collation: utf8mb4_unicode_ci
3. Importe o arquivo SQL:
   - Clique na aba "Importar"
   - Selecione o arquivo `.sql` do projeto
   - Clique em "Executar"

### 4. Configuração do PHP

Verifique se as seguintes extensões estão habilitadas no php.ini:

- pdo_mysql
- mysqli
- mbstring
- json

### 5. Teste da Instalação

1. Abra o navegador
2. Acesse: http://localhost/TechSorrisos/clinica-odonto
3. Você deve ver a página de login do sistema

## Estrutura de Arquivos

```
clinica-odonto/
├── config/          # Configurações do sistema
├── css/            # Arquivos de estilo
├── js/             # Arquivos JavaScript
├── img/            # Imagens do sistema
└── php/            # Arquivos PHP
```

## Problemas Comuns

### Erro de Conexão com Banco de Dados

1. Verifique se o MySQL está rodando
2. Confira as credenciais em `config/database.php`
3. Verifique se o banco foi criado corretamente

### Erro 404

1. Verifique se o Apache está rodando
2. Confira se os arquivos estão no diretório correto
3. Verifique as permissões das pastas

### Páginas em Branco

1. Verifique os logs do PHP em `C:\xampp\php\logs`
2. Ative a exibição de erros no php.ini
3. Confira se todas as extensões necessárias estão ativas

## Suporte

Em caso de problemas:

1. Verifique os logs do Apache: `C:\xampp\apache\logs`
2. Verifique os logs do PHP: `C:\xampp\php\logs`
3. Consulte a documentação do XAMPP
