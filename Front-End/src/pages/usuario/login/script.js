const form = document.getElementById("loginForm");
const email = document.getElementById("email");
const senha = document.getElementById("senha");
const emailErro = document.getElementById("emailErro");
const senhaErro = document.getElementById("senhaErro");
const toggleSenha = document.querySelector(".toggle-senha");

// Mostrar / esconder senha
toggleSenha.addEventListener("click", () => {
  const tipo = senha.getAttribute("type") === "password" ? "text" : "password";
  senha.setAttribute("type", tipo);
});

// Validação
form.addEventListener("submit", (e) => {
  e.preventDefault();

  let valido = true;

  // Reset erros
  emailErro.textContent = "";
  senhaErro.textContent = "";

  // Validação Email
  if (!email.value) {
    emailErro.textContent = "O email é obrigatório.";
    valido = false;
  } else if (!email.value.includes("@")) {
    emailErro.textContent = "Digite um email válido.";
    valido = false;
  }

  // Validação Senha
  if (!senha.value) {
    senhaErro.textContent = "A senha é obrigatória.";
    valido = false;
  } else if (senha.value.length < 6) {
    senhaErro.textContent = "A senha deve ter pelo menos 6 caracteres.";
    valido = false;
  }

  if (valido) {
    alert("Login realizado com sucesso! 🐾");
    form.reset();
  }
});