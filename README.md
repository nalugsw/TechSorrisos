# Clínica Odonto

## Visão Geral

Clínica Odonto é uma aplicação web desenvolvida para gerenciar cadastros de usuários, logins e gerenciamento de senhas para uma clínica odontológica. A aplicação oferece uma interface amigável para que pacientes possam criar contas, fazer login e gerenciar suas senhas com segurança.

## Tecnologias Utilizadas

- **Frontend:** HTML5, CSS3, JavaScript
- **Backend:** PHP
- **Banco de Dados:** MySQL
- **Servidor:** XAMPP (Apache)
- **Bibliotecas:** Font Awesome (ícones)

## Estrutura do Projeto

```
clinica-odonto/
├── config/
│   └── database.php       # Configurações de conexão com o banco de dados
├── css/
│   ├── home.css          # Estilos da página principal
│   ├── login.css         # Estilos das páginas de autenticação
│   ├── especialidades.css # Estilos da página de especialidades
│   └── politicas.css     # Estilos da página de políticas
├── js/
│   ├── home.js           # JavaScript da página principal
│   └── script.js         # JavaScript comum (validações, máscaras)
├── img/
│   ├── logo.svg          # Logo da clínica
│   └── ...              # Outras imagens do sistema
├── php/
│   ├── login.php         # Página de login
│   ├── cadastro.php      # Formulário de cadastro
│   ├── home.php          # Página principal após login
│   ├── especialidades.php # Página de especialidades
│   └── ...              # Outros arquivos PHP
└── README.md             # Documentação do projeto
```

## Funcionalidades Principais

1. **Sistema de Autenticação**

   - Cadastro de novos pacientes
   - Login com email/CPF
   - Recuperação de senha
   - Sessões seguras

2. **Área do Paciente**

   - Visualização de perfil
   - Agendamento de consultas
   - Histórico de atendimentos
   - Acesso às especialidades

3. **Especialidades**

   - Listagem de especialidades
   - Descrições detalhadas
   - Agendamento direto
   - Informações dos profissionais

4. **Interface Responsiva**
   - Design adaptativo
   - Menu mobile
   - Sidebar para navegação
   - Ótima experiência em todos dispositivos

## Instruções de Instalação

1. Clone o repositório para sua máquina local.
2. Navegue até o diretório do projeto.
3. Configure as definições do banco de dados em `config/database.php`.
4. Importe o banco de dados utilizando o arquivo `.sql` presente no repositório.
5. Inicie um servidor local (como XAMPP) e acesse a aplicação via `index.php`.

## Configuração do Ambiente

1. **Requisitos**

   - XAMPP instalado
   - PHP 7.4 ou superior
   - MySQL 5.7 ou superior

2. **Instalação**

   ```bash
   # Clone o repositório na pasta htdocs do XAMPP
   git clone [url-do-repositorio] clinica-odonto

   # Importe o banco de dados
   mysql -u root -p < clinica-odonto/.sql

   # Configure o arquivo de conexão
   # Edite config/database.php com suas credenciais
   ```

3. **Acesso**
   - Inicie o Apache e MySQL no XAMPP
   - Acesse: http://localhost/clinica-odonto

## Segurança

- Senhas criptografadas com password_hash
- Proteção contra SQL Injection
- Validação de dados
- Sessões seguras

## Manutenção

- Mantenha o XAMPP atualizado
- Faça backup regular do banco de dados
- Monitore os logs de erro
- Atualize as dependências quando necessário

## Contribuição

Contribuições são bem-vindas! Para contribuir:

1. Faça um Fork do projeto
2. Crie uma branch para sua feature
3. Commit suas mudanças
4. Push para a branch
5. Abra um Pull Request

## Suporte

Em caso de dúvidas ou problemas:

1. Consulte a documentação
2. Verifique os logs de erro
3. Entre em contato com a equipe de desenvolvimento

## Licença

Este projeto está sob a licença MIT. Veja o arquivo LICENSE para mais detalhes.
