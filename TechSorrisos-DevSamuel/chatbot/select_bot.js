// --- Script para alternar entre assistentes e chat ---
// Importação dinâmica dos bots
const botModules = {
    recepcionista: '/TechSorrisos-DevSamuel/chatbot/bots/botRecepcionista.js',
    dentista: '/TechSorrisos-DevSamuel/chatbot/bots/botDentista.js',
    assistente: '/TechSorrisos-DevSamuel/chatbot/bots/botAssistente.js'
};

let botAtual = null;
let responderBot = null;

const botOptions = document.querySelectorAll('.chatbot-bot-option');
const startBtn = document.getElementById('chatbot-start-btn');
const introDiv = document.getElementById('chatbot-intro');
const chatArea = document.getElementById('chatbot-chat-area');
const messagesDiv = document.getElementById('chatbot-messages');
const inputForm = document.getElementById('chatbot-input-form');
const inputBox = document.getElementById('chatbot-input');
const backBtn = document.getElementById('chatbot-back-btn');

// Estado: qual bot está selecionado
let botSelecionado = null;

// Seleção visual e lógica do bot
botOptions.forEach(opt => {
    opt.addEventListener('click', () => {
        botOptions.forEach(o => o.classList.remove('selected'));
        opt.classList.add('selected');
        botSelecionado = opt.getAttribute('data-bot');
        startBtn.disabled = false;
    });
    // Acessibilidade: enter ativa seleção
    opt.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') {
            opt.click();
        }
    });
});

// Iniciar conversa com o bot selecionado
startBtn.addEventListener('click', async () => {
    if (!botSelecionado) return;
    await iniciarChatComBot(botSelecionado);
});

// Função para iniciar chat com o bot escolhido
async function iniciarChatComBot(botName) {
    // Limpa histórico visual e input
    messagesDiv.innerHTML = '';
    inputBox.value = '';

    // Importa o módulo do bot dinamicamente
    const botModule = await import(botModules[botName]);

    // Atualiza tipoUsuario e limpa histórico ANTES de chamar o bot
    if (botModule.userSession) {
        botModule.userSession.tipoUsuario = botName;
        botModule.userSession.history = [];
    }

    // Define função de resposta do bot
    if (botName === 'recepcionista') responderBot = botModule.responderComoRecepcionista;
    if (botName === 'dentista') responderBot = botModule.responderComoDentista;
    if (botName === 'assistente') responderBot = botModule.responderComoAssistente;
    botAtual = botName;

    // Esconde intro, mostra chat
    introDiv.style.display = 'none';
    chatArea.style.display = 'block';

    // Mensagem inicial do bot
    const msg = await responderBot('/start');
    adicionarMensagem('assistant', msg);
}

// Função para adicionar mensagem ao chat visual
function adicionarMensagem(role, text) {
    const msgDiv = document.createElement('div');
    msgDiv.className = 'chatbot-msg ' + (role === 'user' ? 'user' : 'assistant');
    msgDiv.textContent = text;
    messagesDiv.appendChild(msgDiv);
    messagesDiv.scrollTop = messagesDiv.scrollHeight;
}

// Envio de mensagem pelo usuário
inputForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const texto = inputBox.value.trim();
    if (!texto || !responderBot) return;
    adicionarMensagem('user', texto);
    inputBox.value = '';
    // Resposta do bot
    adicionarMensagem('assistant', '...');
    const todasMsgs = messagesDiv.querySelectorAll('.chatbot-msg.assistant');
    const loadingMsg = todasMsgs[todasMsgs.length - 1];
    const resposta = await responderBot(texto);
    loadingMsg.textContent = resposta;
});

// Permite trocar de bot a qualquer momento clicando em outra opção
botOptions.forEach(opt => {
    opt.addEventListener('click', async () => {
        if (botAtual && botSelecionado && botSelecionado !== botAtual) {
            // Volta para intro e reseta chat
            introDiv.style.display = 'block';
            chatArea.style.display = 'none';
            startBtn.disabled = false;
        }
    });
});

// Botão para voltar à escolha de assistente
if (backBtn) {
    backBtn.addEventListener('click', () => {
        // Esconde chat, mostra seleção de bots
        chatArea.style.display = 'none';
        introDiv.style.display = 'block';
        // Limpa chat visual e input
        messagesDiv.innerHTML = '';
        inputBox.value = '';
        // Reseta seleção visual e lógica
        botOptions.forEach(o => o.classList.remove('selected'));
        botSelecionado = null;
        botAtual = null;
        responderBot = null;
        startBtn.disabled = true;
    });
}
