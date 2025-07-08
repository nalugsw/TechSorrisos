// Importa funções e variáveis comuns para comunicação com a API e histórico
import { callGroqAPI, userSession, updateHistory } from "./config.js";

/*
==========================================================
🦷 BOT DENTISTA VIRTUAL DA TECH SORRISOS
→ Atua como dentista profissional, técnico e acolhedor.
→ Responde dúvidas sobre sintomas, tratamentos, procedimentos, cuidados.
→ Usa linguagem clara, didática, empática e objetiva.
→ Nunca responde fora do escopo odontológico da clínica.
==========================================================
*/

// 🧠 Memória interna com especialidades, orientações e sintomas comuns
const memoriaDentista = {
  especialidades: ["Ortodontia", "Endodontia", "Periodontia", "Implantes"],
  orientacoesPadrao: [
    "Evite alimentos duros ou muito quentes após procedimentos.",
    "Escove os dentes pelo menos 3 vezes ao dia com escova macia.",
    "Use fio dental diariamente para prevenir inflamações.",
  ],
  sintomasComuns: {
    "dor de dente": "Pode indicar cárie ou inflamação no nervo. Recomendo avaliação com raio-X.",
    sensibilidade: "Possível retração gengival ou desgaste do esmalte dental.",
    sangramento: "Pode ser sinal de gengivite. Agende uma limpeza profissional.",
    "mau hálito": "Pode estar relacionado a higiene inadequada ou problemas na língua.",
  },
};

// 💬 Mensagem inicial enviada ao usuário para iniciar interação
function mensagemInicial() {
  return `Olá! Eu sou o dentista virtual da clínica Tech Sorrisos.

Estou aqui para ajudar com dúvidas sobre tratamentos odontológicos, sintomas, cuidados e procedimentos.

Você pode me perguntar sobre:
- Tipos de tratamentos e especialidades
- Como cuidar dos dentes antes e depois dos procedimentos
- Sintomas comuns e quando procurar atendimento
- Esclarecimentos sobre exames e avaliações

Como posso ajudar você hoje?`;
}

// 🔍 Função para detectar comandos de início (/start, início)
function isComandoInicio(texto) {
  const t = texto.trim().toLowerCase();
  return t === "/start" || t === "inicio" || t === "início";
}

// ⛔ Função que verifica se a mensagem está fora do escopo odontológico
function foraDoEscopo(texto) {
  const palavrasProibidas = [
    "clima", "política", "futebol", "piada", "filme", "música", "notícia",
  ];
  return palavrasProibidas.some((p) => texto.toLowerCase().includes(p));
}

// ⚙️ Cria o prompt para a IA baseado nas orientações e contexto do dentista
function gerarSystemPrompt() {
  return `
Você é um dentista virtual da clínica Tech Sorrisos.
Seu papel é fornecer informações técnicas e orientações claras, didáticas e acolhedoras sobre odontologia.
Nunca responda perguntas que não estejam relacionadas a odontologia ou à clínica.
Use as seguintes informações para ajudar nas respostas:

Especialidades:
${memoriaDentista.especialidades.join(", ")}

Orientações básicas para pacientes:
${memoriaDentista.orientacoesPadrao.map(o => "- " + o).join("\n")}

Sintomas comuns e suas possíveis causas:
${Object.entries(memoriaDentista.sintomasComuns)
  .map(([sintoma, resposta]) => `- ${sintoma}: ${resposta}`)
  .join("\n")}
`.trim();
}

// 💬 Função principal para processar a mensagem e responder como dentista
export async function responderComoDentista(mensagemUsuario) {
  // Responde mensagem inicial se for primeira interação (histórico vazio) ou comando de início
  if (!userSession.history.length || isComandoInicio(mensagemUsuario)) {
    const msg = mensagemInicial();
    updateHistory("assistant", msg);
    return msg;
  }

  // Bloqueia perguntas fora do escopo odontológico, respondendo educadamente
  if (foraDoEscopo(mensagemUsuario)) {
    const aviso = "Desculpe, posso responder apenas dúvidas relacionadas à odontologia da Tech Sorrisos. Como posso ajudar?";
    updateHistory("assistant", aviso);
    return aviso;
  }

  // Atualiza o histórico com a pergunta do usuário
  updateHistory("user", mensagemUsuario);

  // Gera o prompt para enviar junto com o histórico para a API da Groq
  const systemPrompt = gerarSystemPrompt();

  // Chama a API da Groq para obter a resposta do dentista virtual
  const resposta = await callGroqAPI(userSession.history, systemPrompt);

  // Atualiza o histórico com a resposta gerada
  updateHistory("assistant", resposta);

  // Retorna a resposta para exibição ao usuário
  return resposta;
}
