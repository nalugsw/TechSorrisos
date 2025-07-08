<?php
// cadastro.php
// Página de cadastro de usuários

session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TCC Clínica Odonto - Cadastro</title>
    <link rel="stylesheet" href="/TechSorrisos-DevSamuel/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="form-container">
            <div class="logo">
                <img src="/TechSorrisos-DevSamuel/img/logo.svg" alt="Logo Clínica Odonto">
            </div>

            <h1>Cadastro</h1>

            <?php if(isset($_SESSION['msg'])): ?>
            <div class="alert <?php echo $_SESSION['alert_type']; ?>">
                <?php 
                        echo $_SESSION['msg']; 
                        unset($_SESSION['msg']);
                        unset($_SESSION['alert_type']);
                    ?>
            </div>
            <?php endif; ?>

            <form action="processa_cadastro.php" method="POST">
                <div class="input-group">
                    <label for="nome_completo">
                        <i class="fas fa-user"></i>
                    </label>
                    <input type="text" id="nome_completo" name="nome_completo" placeholder="Nome Completo" required>
                </div>

                <div class="input-group">
                    <label for="cpf">
                        <i class="fas fa-id-card"></i>
                    </label>
                    <input type="text" id="cpf" name="cpf" placeholder="CPF" maxlength="14" required>
                </div>

                <div class="input-group">
                    <label for="telefone">
                        <i class="fas fa-phone"></i>
                    </label>
                    <input type="tel" id="telefone" name="telefone" placeholder="Telefone" maxlength="15" required>
                </div>

                <div class="input-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i>
                    </label>
                    <input type="email" id="email" name="email" placeholder="Email" required>
                </div>

                <div class="input-group">
                    <label for="senha">
                        <i class="fas fa-lock"></i>
                    </label>
                    <input type="password" id="senha" name="senha" placeholder="Senha" required>
                    <span class="toggle-password">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>

                <div class="input-group">
                    <label for="confirma_senha">
                        <i class="fas fa-lock"></i>
                    </label>
                    <input type="password" id="confirma_senha" name="confirma_senha"
                        placeholder="Digite a senha novamente" required>
                    <span class="toggle-password">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>

                <button type="submit" class="btn-primary">Prosseguir</button>
            </form>

            <div class="form-footer">
                <p>Já possui cadastro? <a href="login.php">Faça seu login</a></p>
            </div>
        </div>
    </div>

    <script src="/TechSorrisos-DevSamuel/js/script.js"></script>
</body>

</html>