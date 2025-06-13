<?php
// criar_senha.php
// Página de criação/recuperação de senha

session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TCC Clínica Odonto - Criar Senha</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="form-container">
            <div class="logo">
                <img src="../img/logo.svg" alt="Logo Clínica Odonto">
            </div>

            <h1>Criar Senha</h1>

            <?php if(isset($_SESSION['msg'])): ?>
            <div class="alert <?php echo $_SESSION['alert_type']; ?>">
                <?php 
                        echo $_SESSION['msg']; 
                        unset($_SESSION['msg']);
                        unset($_SESSION['alert_type']);
                    ?>
            </div>
            <?php endif; ?>

            <form action="processa_senha.php" method="POST">
                <div class="input-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i>
                    </label>
                    <input type="email" id="email" name="email" placeholder="Digite seu email" required>
                </div>

                <div class="input-group">
                    <label for="senha">
                        <i class="fas fa-lock"></i>
                    </label>
                    <input type="password" id="senha" name="senha" placeholder="Crie uma senha" required>
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

                <button type="submit" class="btn-primary">Criar</button>
            </form>

            <div class="form-footer">
                <p>Já possui cadastro? <a href="login.php">Faça seu login</a></p>
            </div>
        </div>
    </div>

    <script src="../js/script.js"></script>
</body>

</html>