<?php
// login.php
// Página de login de usuários

session_start();    
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TCC Clínica Odonto - Login</title>
    <link rel="stylesheet" href="/TechSorrisos-DevSamuel/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="form-container">
            <div class="logo">
                <img src="/TechSorrisos-DevSamuel/img/logo.svg" alt="Logo Clínica Odonto">
            </div>

            <h1>Login</h1>

            <?php if(isset($_SESSION['msg'])): ?>
            <div class="alert <?php echo $_SESSION['alert_type']; ?>">
                <?php 
                        echo $_SESSION['msg']; 
                        unset($_SESSION['msg']);
                        unset($_SESSION['alert_type']);
                    ?>
            </div>
            <?php endif; ?>

            <form action="processa_login.php" method="POST">
                <div class="input-group">
                    <label for="usuario">
                        <i class="fas fa-user"></i>
                    </label>
                    <input type="text" id="usuario" name="usuario" placeholder="Usuário" required>
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

                <div class="forgot-password">
                    <a href="criar_senha.php">Esqueci minha senha</a>
                </div>

                <div class="social-login">
                    <p>Logar Com</p>
                    <div class="social-icons">
                        <a href="#" class="google-icon">
                            <img src="/TechSorrisos-DevSamuel/img/google-icon.png" alt="Google">
                        </a>
                        <a href="#" class="facebook-icon">
                            <img src="/TechSorrisos-DevSamuel/img/facebook-icon.png" alt="Facebook">
                        </a>
                        <a href="#" class="apple-icon">
                            <img src="/TechSorrisos-DevSamuel/img/apple-icon.png" alt="Apple">
                        </a>
                    </div>
                </div>

                <button type="submit" class="btn-primary">Acessar</button>
            </form>

            <div class="form-footer">
                <p>Não tem uma conta? <a href="cadastro.php">Cadastrar-se</a></p>
            </div>
        </div>
    </div>

    <script src="/TechSorrisos-DevSamuel/js/script.js"></script>
</body>

</html>