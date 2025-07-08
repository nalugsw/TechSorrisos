// Importa funções e variáveis essenciais para comunicação com a API e histórico de conversa
import { callGroqAPI, userSession, updateHistory } from "./config.js";

/*
==========================================================
🤖 BOT RECEPCIONISTA VIRTUAL DA TECH SORRISOS
→ Simula a recepcionista real do consultório.
→ Responde dúvidas sobre a clínica, dentistas, serviços, agendamentos, localização, telefone, horários, valores, etc.
→ Linguagem simpática, acolhedora, humana e clara.
→ Nunca responde perguntas fora do contexto do consultório.
==========================================================
*/

// 🧠 Memória local da recepcionista com informações sobre clínica, dentistas e procedimentos
const memoriaRecepcionista = {
  localizacao: "Rua dos Sorrisos, nº 123 - São Paulo, SP",
  telefone: "(11) 99999-0000",
  horariosAtendimento: "Segunda a Sexta, das 08h às 18h",
  dentistas: [
    { nome: "Dr. Claudio", especialidade: "Ortodontia" },
    { nome: "Dra. Juliana", especialidade: "Clínica Geral" },
    { nome: "Dra. Marina", especialidade: "Endodontia" },
  ],
  procedimentos: ["limpeza", "clareamento", "canal", "implante", "aparelho"],
};

// 💬 Mensagem inicial enviada para o usuário ao iniciar conversa com a recepcionista
function mensagemInicial() {
  return `Olá! Eu sou a recepcionista virtual da Tech Sorrisos.

Posso ajudar você com informações sobre:
- Localização e horários da clínica
- Serviços e procedimentos oferecidos
- Informações sobre os dentistas
- Agendamento, remarcação e cancelamento de consultas

Como posso ajudar você hoje?`;
}

// 🔍 Detecta comandos de início para iniciar ou reiniciar a conversa
function isComandoInicio(texto) {
  const t = texto.trim().toLowerCase();
  return t === "/start" || t === "inicio" || t === "início";
}

// ⛔ Detecta mensagens fora do escopo da clínica, para resposta educada
function foraDoEscopo(texto) {
  const palavrasProibidas = [
    "clima", "política", "futebol", "piada", "filme", "música", "notícia",
  ];
  return palavrasProibidas.some((p) => texto.toLowerCase().includes(p));
}

// ⚙️ Gera o prompt para a IA com todas as informações relevantes da recepção
function gerarSystemPrompt() {
  return `
Você é uma recepcionista virtual da clínica odontológica Tech Sorrisos.
Seu papel é responder de forma clara, simpática e acolhedora todas as dúvidas sobre:
- A clínica (localização, telefone, horários)
- Dentistas (nomes e especialidades)
- Procedimentos e serviços oferecidos
- Agendamento, remarcação e cancelamento de consultas
- Valores e condições de pagamento

Nunca responda perguntas fora do contexto da clínica. Caso receba algo assim, informe educadamente que só pode ajudar sobre o consultório.

Informações importantes:
- Localização: ${memoriaRecepcionista.localizacao}
- Telefone: ${memoriaRecepcionista.telefone}
- Horário de atendimento: ${memoriaRecepcionista.horariosAtendimento}
- Dentistas: ${memoriaRecepcionista.dentistas.map(d => d.nome + " (" + d.especialidade + ")").join(", ")}
- Procedimentos oferecidos: ${memoriaRecepcionista.procedimentos.join(", ")}
`.trim();
}

// 💬 Função principal que recebe mensagem do usuário e retorna resposta da recepcionista
export async function responderComoRecepcionista(mensagemUsuario) {
  // Se for primeira mensagem (histórico vazio) ou comando de início, responde com a mensagem inicial
  if (!userSession.history.length || isComandoInicio(mensagemUsuario)) {
    const msg = mensagemInicial();
    updateHistory("assistant", msg);
    return msg;
  }

  // Se mensagem fora do escopo, responde educadamente que só ajuda sobre a clínica
  if (foraDoEscopo(mensagemUsuario)) {
    const aviso = "Desculpe, só posso ajudar com dúvidas relacionadas à clínica Tech Sorrisos. Como posso ajudar?";
    updateHistory("assistant", aviso);
    return aviso;
  }

  // Atualiza histórico com a mensagem do usuário para manter contexto
  updateHistory("user", mensagemUsuario);

  // Gera prompt para a IA com base nas informações da recepção
  const systemPrompt = gerarSystemPrompt();

  // Chama a API Groq para gerar a resposta da recepcionista virtual
  const resposta = await callGroqAPI(userSession.history, systemPrompt);

  // Atualiza histórico com a resposta gerada para continuidade da conversa
  updateHistory("assistant", resposta);

  // Retorna resposta para exibir ao usuário
  return resposta;
}
