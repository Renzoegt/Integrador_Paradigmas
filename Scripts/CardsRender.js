// Scripts/CardsRender.js
// Definir el prefijo de ruta basado en la ubicación actual
const prefix = window.location.pathname.includes("/HTML/") ? ".." : ".";

const collections = {
  textos: [
    { link: `${prefix}/HTML/Templates/text-tem.html`, img: `${prefix}/Assets/Images/Borges.jfif`, title: "Jorge Luis Borges", items: "12,345" },
    { link: `${prefix}/HTML/Templates/text-tem.html`, img: `${prefix}/Assets/Images/Dostoevski.jfif`, title: "Fyodor Dostoyevski", items: "12,345" },
    { link: `${prefix}/HTML/Templates/text-tem.html`, img: `${prefix}/Assets/Images/Camus.jfif`, title: "Albert Camus", items: "12,345" }
  ],
  videos: [
    { link: `${prefix}/HTML/Templates/vid-tem.html`, img: `${prefix}/Assets/Images/Nosfe.jfif`, title: "Terror Clásico", items: "8,920" },
    { link: `${prefix}/HTML/Templates/vid-tem.html`, img: `${prefix}/Assets/Images/AlwaysSunny.jfif`, title: "Always Sunny In Philadelphia", items: "8,920" },
    { link: `${prefix}/HTML/Templates/vid-tem.html`, img: `${prefix}/Assets/Images/The yard.jfif`, title: "The Yard", items: "8,920" }
  ],
  imagenes: [
    { link: `${prefix}/HTML/Templates/img-tem.html`, img: `${prefix}/Assets/Images/fauna.jfif`, title: "Fauna Argentina", items: "4,501" },
    { link: `${prefix}/HTML/Templates/img-tem.html`, img: `${prefix}/Assets/Images/flora.jfif`, title: "Flora Argentina", items: "4,501" },
    { link: `${prefix}/HTML/Templates/img-tem.html`, img: `${prefix}/Assets/Images/foto.jfif`, title: "Fotografía Argentina", items: "4,501" }
  ]
};
// Función para renderizar tarjetas
function renderCards(containerId, data) {
  const container = document.getElementById(containerId);
  if (!container) return; // Si el contenedor no existe, salir

  container.innerHTML = data.map(item => `
    <div class="card">
      <a href="${item.link}">
        <img src="${item.img}" alt="${item.title}">
        <h3>${item.title}</h3>
        <p>${item.items} Items</p>
      </a>
    </div>
  `).join("");
}

// Renderizar todas las categorías mediante un bucle que recorre las claves del objeto collections
Object.keys(collections).forEach(category => {
  renderCards(category, collections[category]);
});
