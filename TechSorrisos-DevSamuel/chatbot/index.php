<?php
// index.php - Interface principal do ChatBot TechSorrisos
session_start();
?> 
<?php include $_SERVER['DOCUMENT_ROOT'].'/TechSorrisos-DevSamuel/php/partials/header.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatBot TechSorrisos</title>
    <!-- Estilos globais e do chatbot -->
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/chatbot-widget.css">
    <link rel="stylesheet" href="chatbot-index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/TechSorrisos-DevSamuel/php/partials/sidebar.php'; ?>
   

    <!-- Fundo animado azul -->
    <div class="chatbot-bg-animated"></div>

    <!-- Container centralizado do chatbot -->
    <div class="chatbot-center-absolute">
        <div class="chatbot-main-container">
            <!-- Cabeçalho do chatbot -->
            <div class="chatbot-header">
                <i class="fa-solid fa-robot"></i>
                ChatBot TechSorrisos
            </div>

            <!-- Seção de escolha do assistente -->
            <div class="chatbot-bots-intro" id="chatbot-intro">
                <div>
                    Olá! 👋 Bem-vindo(a) ao sistema da clínica TechSorrisos.<br>
                    Escolha abaixo com qual assistente deseja conversar:
                </div>
                <div class="chatbot-bots-list" id="chatbot-bots-list">
                    <!-- Opção: Recepcionista Virtual -->
                        <div class="chatbot-bot-option" data-bot="recepcionista" tabindex="0">
                        <span class="chatbot-bot-icon"><i class="fa-solid fa-headset"></i></span>
                        <div class="chatbot-bot-info">
                            <div class="chatbot-bot-title">Recepcionista Virtual</div>
                            <div class="chatbot-bot-desc">
                                Tire dúvidas sobre a clínica, agendamentos, horários, localização, valores e informações gerais.
                            </div>
                        </div>
                    </div>
                    <!-- Opção: Dentista Virtual -->
                    <div class="chatbot-bot-option" data-bot="dentista" tabindex="0">
                        <span class="chatbot-bot-icon"><i class="fa-solid fa-tooth"></i></span>
                        <div class="chatbot-bot-info">
                            <div class="chatbot-bot-title">Dentista Virtual</div>
                            <div class="chatbot-bot-desc">
                                Receba orientações técnicas, tire dúvidas sobre sintomas, tratamentos e cuidados odontológicos.
                            </div>
                        </div>
                    </div>
                    <!-- Opção: Assistente do Sistema -->
                    <div class="chatbot-bot-option" data-bot="assistente" tabindex="0">
                        <span class="chatbot-bot-icon"><i class="fa-solid fa-laptop-medical"></i></span>
                        <div class="chatbot-bot-info">
                            <div class="chatbot-bot-title">Assistente do Sistema</div>
                            <div class="chatbot-bot-desc">
                                Suporte para usar o sistema online: agendar, cancelar, visualizar consultas e navegar pelo site.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chatbot-choose-label">Clique em um assistente para começar</div>
                <button class="chatbot-start-btn" id="chatbot-start-btn" disabled>Iniciar Conversa</button>
            </div>

            <!-- Área do chat (aparece após escolha do bot) -->
            <div class="chatbot-chat-area" id="chatbot-chat-area" style="display:none;">
                <button type="button" class="chatbot-back-btn" id="chatbot-back-btn">
                    <i class="fa fa-arrow-left"></i> Trocar Assistente
                </button>
                <div class="chatbot-messages" id="chatbot-messages"></div>
                <form class="chatbot-input-area" id="chatbot-input-form" autocomplete="off">
                    <input type="text" id="chatbot-input" placeholder="Digite sua mensagem..." autocomplete="off" required />
                    <button type="submit" id="chatbot-send-btn"><i class="fa-solid fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </div>
    <?php include '../php/partials/footer.php'; ?>
    <script src="/TechSorrisos-DevSamuel/js/home.js"></script>
    <script type="module" src="select_bot.js"></script>
</body>
</html>
