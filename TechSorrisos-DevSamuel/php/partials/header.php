<?php
/**
 * partials/header.php
 * Este arquivo contém o cabeçalho principal do site (logo e navegação).
 * Inclua este arquivo nas páginas para manter o header padronizado.
 */
?>
<header class="main-header">
    <div class="logo">
        <a href="/TechSorrisos-DevSamuel/php/home.php" class="logo-content">
            <img src="/TechSorrisos-DevSamuel/img/logo.svg" alt="TechSorrisos Logo" class="logo-img">
            <span class="logo-text">TechSorrisos</span>
        </a>
    </div>
    <nav class="desktop-nav">
        <a href="/TechSorrisos-DevSamuel/php/home.php">Home</a>
        <a href="/TechSorrisos-DevSamuel/php/home.php#sobre">Sobre</a>
        <a href="/TechSorrisos-DevSamuel/php/especialidades.php">Especialidades</a>
        <a href="/TechSorrisos-DevSamuel/php/home.php#contato">Contato</a>
        <a href="/TechSorrisos-DevSamuel/chatbot/index.php">ChatBot</a>
    </nav>
    <div class="nav-buttons">
        <button class="profile-btn desktop-only" id="openSidebarProfile" aria-label="Abrir perfil">
            <i class="fas fa-user"></i>
        </button>
        <div class="mobile-menu">
            <button class="menu-btn" id="openSidebarMenu" aria-label="Menu">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>
</header>
