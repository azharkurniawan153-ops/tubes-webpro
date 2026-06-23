document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("form");
  const username = document.querySelector('input[type="text"]');
  const password = document.querySelector('input[type="password"]');

  // SUBMIT LOGIN
  form.addEventListener("submit", (e) => {
    e.preventDefault();

    if (username.value.trim() === "" || password.value.trim() === "") {
      showMessage("Username dan Password wajib diisi!", "error");
      return;
    }

    // Simulasi login berhasil
    showMessage("Login berhasil! Selamat datang di TOUGAR 🌿", "success");

    setTimeout(() => {
      window.location.href = "TUBES.html";
    }, 1500);
  });
});

/* NOTIFIKASI */
function showMessage(text, type) {
  let msg = document.createElement("div");
  msg.className = `message ${type}`;
  msg.innerText = text;

  document.body.appendChild(msg);

  setTimeout(() => {
    msg.remove();
  }, 3000);
}

document.addEventListener("DOMContentLoaded", () => {
  const loginButton = document.querySelector("button");

  loginButton.addEventListener("click", () => {
    window.location.href = "Beranda.html";
  });
});
