/*
==========================================================
⚙️ CONFIG.JS — CONFIGURAÇÕES E UTILITÁRIOS GERAIS
→ Centraliza configuração da API Groq e controle de sessão.
→ Guarda histórico de mensagens entre usuário e assistentes.
→ Exporta funções para todos os bots usarem.
==========================================================
*/

// ✅ URL base da Groq API (ajuste se necessário)
const GROQ_API_URL = "https://api.groq.com/openai/v1/chat/completions";

// ✅ Chave da API Groq
const GROQ_API_KEY = "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";

// ✅ Sessão do usuário (simples, guardando histórico e tipo de usuário)
// Em produção, você poderia salvar em banco de dados ou localStorage.
export const userSession = {
  tipoUsuario: null,         // Ex.: "cliente", "dentista", "recepcionista"
  history: [],               // Histórico completo da conversa
};

/**
 * 📝 Atualiza o histórico de mensagens
 * @param {string} role - "user" ou "assistant"
 * @param {string} content - Texto da mensagem
 */
export function updateHistory(role, content) {
  userSession.history.push({
    role,
    content,
  });
}

/**
 * 🤖 Faz chamada à Groq API para gerar resposta do bot
 * @param {Array} history - Histórico completo da conversa (array de mensagens)
 * @param {string} systemPrompt - Texto com as regras e contexto para a IA
 * @returns {Promise<string>} Resposta gerada pela IA
 */
export async function callGroqAPI(history, systemPrompt) {
  try {
    // Monta lista de mensagens para enviar para a Groq API
    const messages = [
      {
        role: "system",
        content: systemPrompt,
      },
      ...history,
    ];

    // Configura o payload da requisição
    const payload = {
      model: "llama-2-70b-4096", // ou outro modelo listado no painel Groq
      messages,
      temperature: 0.3,
      max_tokens: 1024,
      top_p: 1,
      stream: false,
    };

    console.log("Enviando para Groq:", payload);

    // Faz a requisição HTTP para a Groq API
    const response = await fetch(GROQ_API_URL, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Authorization: `Bearer ${GROQ_API_KEY}`,
      },
      body: JSON.stringify(payload),
    });

    if (!response.ok) {
      const errorText = await response.text();
      console.error(`Erro na API Groq: ${response.status} ${response.statusText}`, errorText);
      return `Erro na API Groq: ${response.status} ${response.statusText}\n${errorText}`;
    }

    const data = await response.json();

    // Extrai o texto da resposta
    const respostaIA = data.choices[0].message.content;

    return respostaIA;
  } catch (error) {
    console.error("Erro ao chamar a API Groq:", error);
    return "Erro ao chamar a API Groq: " + error.message;
  }
}

