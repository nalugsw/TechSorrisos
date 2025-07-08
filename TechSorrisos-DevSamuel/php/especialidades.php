<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Especialidades - TechSorrisos</title>
    <link rel="stylesheet" href="/TechSorrisos-DevSamuel/css/home.css">
    <link rel="stylesheet" href="/TechSorrisos-DevSamuel/css/especialidades.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <!-- Sidebar -->
    <?php include $_SERVER['DOCUMENT_ROOT'].'/TechSorrisos-DevSamuel/php/partials/sidebar.php'; ?>

    <!-- Main Header -->
    <?php include $_SERVER['DOCUMENT_ROOT'].'/TechSorrisos-DevSamuel/php/partials/header.php'; ?>

    <main class="especialidades-main">
        <div class="especialidades-container">
            <h1 class="especialidades-title">Especialidades</h1>
            <p class="especialidades-subtitle">Confira abaixo as especialidades em que atuamos</p>

            <div class="especialidades-grid">
                <!-- Odontopediatria -->
                <div class="especialidade-card">
                    <div class="especialidade-icon">
                        <img src="/TechSorrisos-DevSamuel/img/logo.svg" alt="Ícone Odontopediatria">
                    </div>
                    <div class="especialidade-info">
                        <h3>Odontopediatria</h3>
                        <p>Cuidados bucais para crianças com foco na prevenção</p>
                        <div class="card-actions">
                            <a href="especialidade-detalhe.php?id=1" class="saiba-mais-btn">Saiba mais</a>
                            <a href="marcar-avaliacao.php" class="agendar-btn">Agendar</a>
                        </div>
                    </div>
                </div>

                <!-- Ortodontia -->
                <div class="especialidade-card">
                    <div class="especialidade-icon">
                        <img src="/TechSorrisos-DevSamuel/img/logo.svg" alt="Ícone Ortodontia">
                    </div>
                    <div class="especialidade-info">
                        <h3>Ortodontia</h3>
                        <p>Correção do alinhamento dental e mordida</p>
                        <div class="card-actions">
                            <a href="especialidade-detalhe.php?id=2" class="saiba-mais-btn">Saiba mais</a>
                            <a href="marcar-avaliacao.php" class="agendar-btn">Agendar</a>
                        </div>
                    </div>
                </div>

                <!-- Prostodontia -->
                <div class="especialidade-card">
                    <div class="especialidade-icon">
                        <img src="/TechSorrisos-DevSamuel/img/logo.svg" alt="Ícone Prostodontia">
                    </div>
                    <div class="especialidade-info">
                        <h3>Prostodontia</h3>
                        <p>Reabilitação oral com próteses estéticas e funcionais</p>
                        <div class="card-actions">
                            <a href="especialidade-detalhe.php?id=3" class="saiba-mais-btn">Saiba mais</a>
                            <a href="marcar-avaliacao.php" class="agendar-btn">Agendar</a>
                        </div>
                    </div>
                </div>

                <!-- Odontologia estética -->
                <div class="especialidade-card">
                    <div class="especialidade-icon">
                        <img src="/TechSorrisos-DevSamuel/img/logo.svg" alt="Ícone Odontologia estética">
                    </div>
                    <div class="especialidade-info">
                        <h3>Odontologia estética</h3>
                        <p>Tratamentos para melhorar a aparência do sorriso</p>
                        <div class="card-actions">
                            <a href="especialidade-detalhe.php?id=4" class="saiba-mais-btn">Saiba mais</a>
                            <a href="marcar-avaliacao.php" class="agendar-btn">Agendar</a>
                        </div>
                    </div>
                </div>

                <!-- Periodontia -->
                <div class="especialidade-card">
                    <div class="especialidade-icon">
                        <img src="/TechSorrisos-DevSamuel/img/logo.svg" alt="Ícone Periodontia">
                    </div>
                    <div class="especialidade-info">
                        <h3>Periodontia</h3>
                        <p>Saúde gengival e prevenção de doenças</p>
                        <div class="card-actions">
                            <a href="especialidade-detalhe.php?id=5" class="saiba-mais-btn">Saiba mais</a>
                            <a href="marcar-avaliacao.php" class="agendar-btn">Agendar</a>
                        </div>
                    </div>
                </div>

                <!-- Patologia oral -->
                <div class="especialidade-card">
                    <div class="especialidade-icon">
                        <img src="/TechSorrisos-DevSamuel/img/logo.svg" alt="Ícone Patologia oral">
                    </div>
                    <div class="especialidade-info">
                        <h3>Patologia oral</h3>
                        <p>Diagnóstico e tratamento de lesões bucais</p>
                        <div class="card-actions">
                            <a href="especialidade-detalhe.php?id=6" class="saiba-mais-btn">Saiba mais</a>
                            <a href="marcar-avaliacao.php" class="agendar-btn">Agendar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/TechSorrisos-DevSamuel/php/partials/footer.php'; ?>

    <script src="/TechSorrisos-DevSamuel/js/home.js"></script>
</body>
</html>
