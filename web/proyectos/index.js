const contentPage = document.getElementById("content");

contentPage.addEventListener("load", loadSections());

async function loadSections() {
  const proyectos = await getAll();
  proyectos.forEach((proyecto) => {
    proyecto.b64Images = JSON.parse(proyecto.b64Images);
    contentPage.innerHTML += section(
      proyecto.id,
      proyecto.b64Images,
      proyecto.titulo,
      proyecto.descripcion
    );
  });
}

function changeImage(id, img) {
  document.getElementById(id).src = img.src;
}
