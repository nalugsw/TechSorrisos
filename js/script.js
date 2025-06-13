/**
 * script.js
 * Script principal para funcionalidades do Sistema de Cadastro
 *
 * Este arquivo contém todas as funcionalidades JavaScript do sistema, incluindo:
 * - Máscaras para campos de CPF e telefone
 * - Visualização de senha
 * - Validação de formulários
 * - Animações e efeitos visuais
 */

document.addEventListener("DOMContentLoaded", function () {
  /**
   * Máscara para campo de CPF
   * Formato: XXX.XXX.XXX-XX
   */
  const cpfInput = document.getElementById("cpf");
  if (cpfInput) {
    cpfInput.addEventListener("input", function (e) {
      let value = e.target.value.replace(/\D/g, ""); // Remove não-dígitos

      // Limita a 11 dígitos
      if (value.length > 11) {
        value = value.slice(0, 11);
      }

      // Aplica a máscara conforme digita
      if (value.length > 9) {
        value = value.replace(
          /^(\d{3})(\d{3})(\d{3})(\d{0,2}).*/,
          "$1.$2.$3-$4"
        );
      } else if (value.length > 6) {
        value = value.replace(/^(\d{3})(\d{3})(\d{0,3}).*/, "$1.$2.$3");
      } else if (value.length > 3) {
        value = value.replace(/^(\d{3})(\d{0,3}).*/, "$1.$2");
      }

      e.target.value = value;
    });
  }

  /**
   * Máscara para campo de telefone
   * Formatos: (XX) XXXXX-XXXX (celular) ou (XX) XXXX-XXXX (fixo)
   */
  const telefoneInput = document.getElementById("telefone");
  if (telefoneInput) {
    telefoneInput.addEventListener("input", function (e) {
      let value = e.target.value.replace(/\D/g, ""); // Remove não-dígitos

      // Limita a 11 dígitos
      if (value.length > 11) {
        value = value.slice(0, 11);
      }

      // Aplica máscara conforme quantidade de dígitos
      if (value.length > 10) {
        // Celular com DDD
        value = value.replace(/^(\d{2})(\d{5})(\d{4}).*/, "($1) $2-$3");
      } else if (value.length > 6) {
        // Telefone fixo com DDD
        value = value.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, "($1) $2-$3");
      } else if (value.length > 2) {
        // Começo do DDD
        value = value.replace(/^(\d{2})(\d{0,5}).*/, "($1) $2");
      }

      e.target.value = value;
    });
  }

  /**
   * Funcionalidade de mostrar/ocultar senha
   * Alterna entre tipo password e text no input
   */
  const togglePasswordButtons = document.querySelectorAll(".toggle-password");

  togglePasswordButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const inputField = this.previousElementSibling;
      const iconElement = this.querySelector("i");

      // Alterna entre mostrar e ocultar senha
      if (inputField.type === "password") {
        inputField.type = "text";
        iconElement.classList.remove("fa-eye");
        iconElement.classList.add("fa-eye-slash");
      } else {
        inputField.type = "password";
        iconElement.classList.remove("fa-eye-slash");
        iconElement.classList.add("fa-eye");
      }
    });
  });

  /**
   * Validação de confirmação de senha
   * Verifica se as senhas digitadas são iguais
   */
  const senhaInput = document.getElementById("senha");
  const confirmaSenhaInput = document.getElementById("confirma_senha");

  if (senhaInput && confirmaSenhaInput) {
    // Validação ao digitar no campo de confirmar senha
    confirmaSenhaInput.addEventListener("input", function () {
      if (senhaInput.value !== confirmaSenhaInput.value) {
        confirmaSenhaInput.setCustomValidity("As senhas não coincidem");
      } else {
        confirmaSenhaInput.setCustomValidity("");
      }
    });

    // Validação ao digitar no campo de senha
    senhaInput.addEventListener("input", function () {
      if (confirmaSenhaInput.value) {
        if (senhaInput.value !== confirmaSenhaInput.value) {
          confirmaSenhaInput.setCustomValidity("As senhas não coincidem");
        } else {
          confirmaSenhaInput.setCustomValidity("");
        }
      }
    });
  }

  /**
   * Validação do formulário antes do envio
   * Verifica campos obrigatórios e formatos
   */
  const forms = document.querySelectorAll("form");

  forms.forEach((form) => {
    form.addEventListener("submit", function (event) {
      const requiredFields = form.querySelectorAll("[required]");
      let isValid = true;

      // Verifica campos obrigatórios
      requiredFields.forEach((field) => {
        if (!field.value.trim()) {
          isValid = false;
          field.classList.add("error");

          // Adiciona animação de shake em campos vazios
          field.classList.add("shake");
          setTimeout(() => {
            field.classList.remove("shake");
          }, 500);
        } else {
          field.classList.remove("error");
        }
      });

      // Validação específica para email
      const emailField = form.querySelector('input[type="email"]');
      if (emailField && emailField.value) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(emailField.value)) {
          isValid = false;
          emailField.classList.add("error");
        }
      }

      // Validação de senhas iguais
      if (senhaInput && confirmaSenhaInput) {
        if (senhaInput.value !== confirmaSenhaInput.value) {
          isValid = false;
          confirmaSenhaInput.classList.add("error");
        }
      }

      // Se houver erros, previne envio e mostra mensagem
      if (!isValid) {
        event.preventDefault();

        // Cria e exibe mensagem de erro
        const errorMessage = document.createElement("div");
        errorMessage.className = "alert error";
        errorMessage.textContent = "Por favor, verifique os campos destacados.";

        // Verifica se já existe uma mensagem de erro
        const existingError = form.querySelector(".alert.error");
        if (!existingError) {
          form.prepend(errorMessage);

          // Remove a mensagem após 5 segundos
          setTimeout(() => {
            errorMessage.remove();
          }, 5000);
        }

        // Rola para o topo do formulário
        form.scrollIntoView({ behavior: "smooth" });
      }
    });
  });

  /**
   * Auto-fechamento de alertas
   * Remove alertas automaticamente após 5 segundos
   */
  const alerts = document.querySelectorAll(".alert");

  alerts.forEach((alert) => {
    setTimeout(() => {
      alert.style.opacity = "0";
      setTimeout(() => {
        alert.remove();
      }, 500);
    }, 5000);
  });

  /**
   * Efeitos de transição nos campos
   * Adiciona classe focused para efeitos visuais
   */
  const inputFields = document.querySelectorAll("input");

  inputFields.forEach((input) => {
    // Ao focar o campo
    input.addEventListener("focus", function () {
      this.parentElement.classList.add("focused");
    });

    // Ao perder o foco
    input.addEventListener("blur", function () {
      if (!this.value) {
        this.parentElement.classList.remove("focused");
      }
    });

    // Verifica valor inicial ao carregar
    if (input.value) {
      input.parentElement.classList.add("focused");
    }
  });
});

/**
 * Estilos para animações
 * Adiciona keyframes e classes CSS para efeitos visuais
 */
const styleSheet = document.createElement("style");
styleSheet.textContent = `
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
        20%, 40%, 60%, 80% { transform: translateX(5px); }
    }
    
    .shake {
        animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
    }
    
    .error {
        border-color: var(--danger-color) !important;
    }
    
    .input-group.focused input {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 2px rgba(0, 103, 177, 0.2);
    }
    
    .alert {
        transition: opacity 0.5s ease;
    }
`;

document.head.appendChild(styleSheet);
