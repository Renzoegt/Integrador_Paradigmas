// Pseudo base de datos con fines demostrativos
const users = [
  { username: "admin", password: "root" },
  { username: "renzo", password: "bomboclat" }
];

document.querySelector("form").addEventListener("submit", (e) => {
  e.preventDefault(); // Prevenir el envío del formulario para que no recargue la página
  const user = document.getElementById("Usuario").value;
  const pass = document.getElementById("Contraseña").value;

  const validUser = users.find(u => u.username === user && u.password === pass);

  if (validUser) {
    // Guardar el estado de inicio de sesión en localStorage
    localStorage.setItem("loggedInUser", user);
    alert(`Bienvenido, ${user}!`);
    window.location.href = "../index.html"; // Enviamos al usuario a la página principal
  } else {
    alert("Usuario o contraseña incorrectos");
  }
});
