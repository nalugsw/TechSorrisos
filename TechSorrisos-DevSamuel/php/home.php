<?php
// index.php
// Página inicial após o login

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
    <title>TechSorrisos - Home</title>
    <link rel="stylesheet" href="/TechSorrisos-DevSamuel/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/TechSorrisos-DevSamuel/php/partials/sidebar.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/TechSorrisos-DevSamuel/php/partials/header.php'; ?>

    <div class="home-hero">
        <div class="home-hero-content">
            <h1 class="home-hero-title">
                Excelência no cuidado,<br>
                confiança no sorriso.
            </h1>
            <a href="marcar-avaliacao.php" class="home-hero-btn">Agende sua consulta</a>
        </div>
        <div class="home-hero-img">
            <img src="../img/dentista-home.png" alt="Dentista TechSorrisos">
        </div>
    </div>

    <!-- Seção Sobre -->
    <section id="sobre" class="sobre-section">
        <div class="sobre-container">
            <div class="sobre-content">
                <div class="sobre-text">
                    <h2>Conheça um pouco sobre nós</h2>
                    <h3>Sobre a TechSorrisos</h3>
                    <p>A TechSorrisos é uma clínica odontológica dedicada a transformar sorrisos com qualidade,
                        tecnologia e atendimento humanizado.</p>
                    <p>Contamos com uma equipe de profissionais altamente qualificados e especializadas em diversas
                        áreas da odontologia, oferecendo desde tratamentos preventivos até procedimentos estéticos e
                        restauradores.</p>
                </div>
                <div class="sobre-img">
                    <img src="../img/Imagem-sobre.png" alt="Atendimento TechSorrisos">
                </div>
            </div>
        </div>
    </section>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/TechSorrisos-DevSamuel/php/partials/footer.php'; ?>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const sidebar = document.getElementById("sidebar");
        const sidebarOverlay = document.getElementById("sidebarOverlay");
        const openSidebarProfileBtn = document.getElementById("openSidebarProfile");
        const openSidebarMenuBtn = document.getElementById("openSidebarMenu");
        const closeSidebarBtn = document.getElementById("closeSidebar");

        // Função para abrir sidebar
        function openSidebar() {
            sidebar.classList.add("open");
            sidebarOverlay.classList.add("open");
            document.body.style.overflow = "hidden";
        }

        // Função para fechar sidebar
        function closeSidebar() {
            sidebar.classList.remove("open");
            sidebarOverlay.classList.remove("open");
            document.body.style.overflow = "";
        }

        // Adicionar event listeners para ambos os botões
        if (openSidebarProfileBtn) {
            openSidebarProfileBtn.addEventListener("click", openSidebar);
        }
        if (openSidebarMenuBtn) {
            openSidebarMenuBtn.addEventListener("click", openSidebar);
        }

        // Event listener para fechar
        if (closeSidebarBtn) {
            closeSidebarBtn.addEventListener("click", closeSidebar);
        }

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener("click", closeSidebar);
        }

        // Fechar com ESC
        document.addEventListener("keydown", function(e) {
            if (e.key === "Escape") {
                closeSidebar();
            }
        });
    });
    </script>
</body>
</html>