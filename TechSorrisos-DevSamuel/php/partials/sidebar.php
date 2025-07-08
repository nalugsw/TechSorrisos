<?php
/**
 * partials/sidebar.php
 * Este arquivo contém a sidebar lateral do site, com menu do usuário.
 * Inclua este arquivo nas páginas protegidas para manter a navegação lateral padronizada.
 * Certifique-se de que $_SESSION['usuario_nome'] está disponível.
 */
?>
<div class="sidebar" id="sidebar">
    <span class="close-btn" id="closeSidebar">
        <i class="fas fa-times"></i>
    </span>
    <div class="profile">
        <div class="profile-icon">
            <i class="fas fa-user"></i>
        </div>
        <div class="profile-info">
            <p>Bem-vindo(a),</p>
            <p class="user-name"><?php echo isset($_SESSION['usuario_nome']) ? $_SESSION['usuario_nome'] : ''; ?></p>
        </div>
    </div>
    <div class="menu">
        <a href="/TechSorrisos-DevSamuel/php/perfil.php">
            <i class="fas fa-user-circle"></i>
            Meu perfil
        </a>
        <a href="/TechSorrisos-DevSamuel/php/especialidades.php">
            <i class="fas fa-tooth"></i>
            Especialidades
        </a>
        <a href="/TechSorrisos-DevSamuel/php/agenda.php">
            <i class="fas fa-calendar-alt"></i>
            Minha Agenda
        </a>
        <a href="/TechSorrisos-DevSamuel/php/marcar-avaliacao.php">
            <i class="fas fa-calendar-plus"></i>
            Marcar Avaliação
        </a>
        <a href="#" onclick="document.querySelector('form[action=\'/TechSorrisos-DevSamuel/php/logout.php\']').submit(); return false;">
            <i class="fas fa-sign-out-alt"></i>
            Sair
        </a>
    </div>
    <div class="privacy">
        <a href="/TechSorrisos-DevSamuel/php/politicas-privacidade.php">POLÍTICAS DE PRIVACIDADE</a>
    </div>
</div>
<div class="sidebar-overlay" id="sidebarOverlay"></div>
<!-- Form oculto para logout -->
<form action="/TechSorrisos-DevSamuel/php/logout.php" method="POST" style="display: none;"></form>
