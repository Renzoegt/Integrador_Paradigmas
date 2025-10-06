// Scripts/ContentRender.js
const collections = {
  textos: [
    { title: "Borges - Ficciones", content: "Contenido obtenido de the Internet Archive", url: "https://dn721802.ca.archive.org/0/items/ficciones-borges/Ficciones%20-%20Borges.pdf" }
  ],
  videos: [
    { title: "Nosferatu", content: "Película clásica de terror, obtenida de the internet archive", videoUrl: "https://dn720403.ca.archive.org/0/items/videoplayback-5_202203/videoplayback%20%285%29.mp4" }
  ],
  imagenes: [
    { title: "Yaguarete argentino", content: "Fotografía de fauna", img: "../../Assets/Images/fauna.jfif" }
  ]
};

function renderContent(containerId, category) {
  const container = document.getElementById(containerId);
  if (!container) return;

  container.innerHTML = collections[category].map(item => {
    if (category === "textos") {
      return `
        <article class="content-card">
          <h3>${item.title}</h3>
          <iframe src="${item.url}" frameborder="0" width="100%" height="600px" alt="${item.title}" allowfullscreen></iframe>
          <p>${item.content}</p>
        </article>
      `;
    }
    if (category === "videos") {
      return `
        <article class="content-card">
          <h3>${item.title}</h3>
          <video controls="" autoplay="" width="100%" name=${item.title}><source src=${item.videoUrl} type="video/mp4"></video>
          <p>${item.content}</p>
        </article>
      `;
    }
    if (category === "imagenes") {
      return `
        <article class="content-card">
          <img src="${item.img}" alt="${item.title}">
          <h3>${item.title}</h3>
          <p>${item.content}</p>
        </article>
      `;
    }
  }).join("");
}
