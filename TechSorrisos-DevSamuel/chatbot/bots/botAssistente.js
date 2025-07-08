// Importa funções e variáveis comuns usadas pelo bot
import { callGroqAPI, userSession, updateHistory } from "./config.js";

/*
==========================================================
🧑‍💻 BOT ASSISTENTE DO SISTEMA DA TECH SORRISOS
→ Especialista em suporte ao sistema online da clínica.
→ Ajuda usuários a navegar, agendar, cancelar, visualizar e usar funcionalidades do site.
→ Responde só dentro do escopo do sistema.
→ Mantém conversa amigável, clara e objetiva.
==========================================================
*/

// 🧠 Memória local do assistente, com as principais funcionalidades e instruções
const memoriaSistema = {
  funcionalidades: [
    "Agendar consultas na aba 'Agendamentos'",
    "Visualizar seus horários futuros e históricos",
    "Cancelar ou remarcar consultas pelo portal",
    "Avaliar atendimento após cada consulta realizada",
    "Receber lembretes automáticos via e-mail ou SMS",
  ],
  instrucoesBasicas: `
- Para agendar uma consulta, acesse a aba "Agendamentos", escolha o dentista e o horário desejado.
- Para remarcar ou cancelar, vá ao seu histórico de consultas e selecione a opção desejada.
- Você pode atualizar seus dados pessoais na seção "Perfil".
- Se encontrar algum erro no sistema, descreva o problema com detalhes para que possamos ajudar.
`,
};

// 💬 Mensagem inicial enviada ao usuário ao iniciar a conversa com o assistente
function mensagemInicial() {
  return `Olá! Eu sou o assistente virtual do sistema da Tech Sorrisos.

Estou aqui para te ajudar a usar nosso sistema online, tirar dúvidas sobre funcionalidades, agendamento e muito mais.

Você pode me perguntar sobre:
- Como agendar, remarcar ou cancelar consultas
- Visualizar seus horários e histórico de atendimentos
- Atualizar seus dados pessoais no sistema
- Receber informações sobre notificações e lembretes

Como posso ajudar você hoje?`;
}

// 🔍 Função que detecta se a mensagem é um comando de início para resetar ou iniciar conversa
function isComandoInicio(texto) {
  const t = texto.trim().toLowerCase();
  return t === "/start" || t === "inicio" || t === "início";
}

// ⛔ Função que verifica se a mensagem do usuário está fora do escopo do sistema da clínica
function foraDoEscopo(texto) {
  // Lista de palavras-chave que indicam que a pergunta não é sobre o sistema
  const palavrasProibidas = [
    "clima", "tempo", "política", "presidente", "futebol", 
    "piada", "filme", "música", "notícia", "noticias"
  ];
  // Verifica se alguma das palavras proibidas está na mensagem do usuário
  return palavrasProibidas.some((p) => texto.toLowerCase().includes(p));
}

// ⚙️ Gera o "system prompt" com as regras e contexto para a IA responder corretamente
function gerarSystemPrompt() {
  // Monta o texto com as informações atuais da memória para dar contexto para a IA
  return `
Você é o assistente virtual especializado no sistema online da clínica Tech Sorrisos.
Seu papel é ajudar os usuários a usar as funcionalidades do sistema, explicando processos, tirando dúvidas técnicas e orientando passo a passo.
Seja sempre claro, amigável, didático e objetivo.
NUNCA responda perguntas fora do contexto do sistema da clínica. Caso receba algo fora do tema, responda educadamente que só pode ajudar sobre o sistema.

Principais funcionalidades do sistema:
${memoriaSistema.funcionalidades.map((f) => "- " + f).join("\n")}

Instruções básicas para uso:
${memoriaSistema.instrucoesBasicas}
`.trim();
}

// 💬 Função principal que processa a mensagem do usuário e retorna a resposta do assistente
export async function responderComoAssistente(mensagemUsuario) {
  // Se for a primeira mensagem (histórico vazio) ou comando de início, responde com a mensagem inicial
  if (!userSession.history.length || isComandoInicio(mensagemUsuario)) {
    const msg = mensagemInicial();
    updateHistory("assistant", msg); // Salva a mensagem no histórico da conversa
    return msg;
  }

  // Se a mensagem estiver fora do escopo do sistema, informa ao usuário educadamente
  if (foraDoEscopo(mensagemUsuario)) {
    const aviso = "Desculpe, sou especializado apenas em suporte ao sistema da clínica Tech Sorrisos. Como posso ajudar dentro desse contexto?";
    updateHistory("assistant", aviso); // Salva o aviso no histórico
    return aviso;
  }

  // Atualiza o histórico da conversa com a mensagem do usuário para manter contexto
  updateHistory("user", mensagemUsuario);

  // Gera o system prompt que será enviado para a API junto com o histórico
  const systemPrompt = gerarSystemPrompt();

  // Chama a API Groq para gerar a resposta com base no histórico e contexto
  const resposta = await callGroqAPI(userSession.history, systemPrompt);

  // Atualiza o histórico da conversa com a resposta do assistente
  updateHistory("assistant", resposta);

  // Retorna a resposta para o front-end exibir ao usuário
  return resposta;
}
