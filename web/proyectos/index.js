const contentPage = document.getElementById("content");

contentPage.addEventListener("load", loadSections());

async function loadSections() {
  const proyectos = await getAll();
  proyectos.forEach((proyecto) => {
    proyecto.b64Images = JSON.parse(proyecto.b64Images);
    contentPage.innerHTML += section(
      proyecto.b64Images[0],
      proyecto.titulo,
      proyecto.descripcion
    );
  });
}
