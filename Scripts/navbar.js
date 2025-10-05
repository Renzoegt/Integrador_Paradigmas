// Seleccionamos el botón y el menú
const toggleBtn = document.getElementById("menu-toggle");
const navLinks = document.getElementById("nav-links");

// Evento para mostrar/ocultar menú
toggleBtn.addEventListener("click", () => {
  navLinks.classList.toggle("active");
});