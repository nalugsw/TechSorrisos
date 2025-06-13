/**
 * home.js
 * JavaScript para funcionalidades da página principal
 *
 * Este arquivo gerencia:
 * - Funcionalidade do sidebar (menu lateral)
 * - Interações do menu mobile
 * - Navegação responsiva
 */

document.addEventListener("DOMContentLoaded", function () {
  // Elementos do DOM
  const sidebar = document.getElementById("sidebar");
  const sidebarOverlay = document.getElementById("sidebarOverlay");
  const openSidebarBtn = document.getElementById("openSidebar");
  const closeSidebarBtn = document.getElementById("closeSidebar");

  /**
   * Função para abrir o sidebar
   * - Adiciona classe open para mostrar o menu
   * - Adiciona overlay para backdrop
   * - Desabilita scroll do body
   */
  function openSidebar() {
    sidebar.classList.add("open");
    sidebarOverlay.classList.add("open");
    document.body.style.overflow = "hidden";
  }

  /**
   * Função para fechar o sidebar
   * - Remove classe open
   * - Remove overlay
   * - Reabilita scroll do body
   */
  function closeSidebar() {
    sidebar.classList.remove("open");
    sidebarOverlay.classList.remove("open");
    document.body.style.overflow = "";
  }

  // Event listener para botão de abrir
  if (openSidebarBtn) {
    openSidebarBtn.addEventListener("click", openSidebar);
  }

  /**
   * Event listeners para todos os botões que abrem o sidebar
   * Inclui botões de menu mobile e perfil
   */
  const allOpenSidebarBtns = document.querySelectorAll(
    ".menu-btn, .profile-btn"
  );
  allOpenSidebarBtns.forEach((btn) => {
    btn.addEventListener("click", openSidebar);
  });

  // Event listener para botão de fechar
  if (closeSidebarBtn) {
    closeSidebarBtn.addEventListener("click", closeSidebar);
  }

  // Event listener para fechar ao clicar no overlay
  if (sidebarOverlay) {
    sidebarOverlay.addEventListener("click", closeSidebar);
  }

  /**
   * Event listener para fechar com tecla ESC
   * Melhoria de acessibilidade
   */
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
      closeSidebar();
    }
  });
});
