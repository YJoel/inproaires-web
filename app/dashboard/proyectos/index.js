// const apiUrl = "http://localhost:3000/api/proyectos/";

document.forms["form-proyectos"].addEventListener("submit", async (ev) => {
  ev.preventDefault();
  const form = ev.target;
  const titulo = form["titulo"].value;
  const descripcion = form["descripcion"].value;
  const backgroundImg = form["backgroundImg"].files;
  const imgs = form["evidences"].files;
  // console.log(backgroundImg);
  // console.log(imgs);
  const date = new Date();
  const fecha = `${date.getFullYear()}-${
    date.getMonth() + 1
  }-${date.getDate()}T${date.getHours()}:${date.getMinutes()}:${date.getSeconds()}-05:00`;

  const b64Images = [];
  // for (let index = 0; index < imgs.length + 1; index++) {
  //   if (index == 0) {
  //     console.log(backgroundImg[index]);
  //   }
  //   console.log(imgs[index]);
  // }
  for (let index = 0; index < imgs.length + 1; index++) {
    // console.log(index);
    if (index == 0) {
      b64Images[index] = await comprimirImagen(backgroundImg[index]);
    } else {
      b64Images[index] = await comprimirImagen(imgs[index - 1]);
    }
  }

  // const response = await fetch(apiUrl, {
  //   method: "GET",
  // });

  // const response = await fetch(apiUrl, {
  //   method: "POST",
  //   headers: {
  //     "Content-Type": "application/json",
  //   },
  //   body: JSON.stringify({
  //     titulo: titulo,
  //     descripcion: descripcion,
  //     b64Images: b64Images,
  //     fecha: fecha,
  //   }),
  // });

  const data = await insert({
    titulo: titulo,
    descripcion: descripcion,
    b64Images: b64Images,
    fecha: fecha,
  });

  if (!data.error) {
    alert("PROYECTO INGRESADO");
  } else {
    alert("NO SE PUDO INGRESAR EL PROYECTO, INTENTE NUEVAMENTE");
  }
  form.reset();
  // console.log(data);
});

function comprimirImagen(file, maxWidth = 1920, calidad = 0.7) {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();

    reader.onload = function (e) {
      const img = new Image();
      img.onload = function () {
        // Redimensionar si es necesario
        const scale = Math.min(maxWidth / img.width, 1);
        const canvas = document.createElement("canvas");
        canvas.width = img.width * scale;
        canvas.height = img.height * scale;

        const ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

        // Exportar como JPEG comprimido
        canvas.toBlob(
          (blob) => {
            const reader2 = new FileReader();
            reader2.onloadend = () => resolve(reader2.result); // Base64 final
            reader2.readAsDataURL(blob);
          },
          "image/png",
          calidad // entre 0 y 1
        );
      };
      img.onerror = reject;
      img.src = e.target.result;
    };

    reader.onerror = reject;
    reader.readAsDataURL(file);
  });
}

async function proyectosToHTML() {
  let proyectos = await getAll();
  // console.log(proyectos);
  const table = document.createElement("table");
  table.classList.add("table", "table-hover");
  table.innerHTML = `
    <tr>
      <th>ID</th>
      <th>Titulo</th>
      <th>Descripcion</th>
      <th>Imagen de Fondo</th>
      <th>Evidencias</th>
      <th>Acciones</th>
    </tr>
  `;
  proyectos.forEach((proyecto) => {
    proyecto.b64Images = JSON.parse(proyecto.b64Images);
    let imgs = ``;
    proyecto.b64Images.forEach((img, i) => {
      if (i != 0) {
        imgs += `<img src="${img}" width="100px" class="d-inline-block py-1" />`;
      }
    });
    table.innerHTML += `
    <tr>
      <td>
        ${proyecto.id}
      </td>
      <td>
        ${proyecto.titulo}
      </td>
      <td>
        ${proyecto.descripcion}
      </td>
      <td>
        <img src="${proyecto.b64Images[0]}" width="120px" style="display: block" />
      </td>
      <td>
        ${imgs}
      </td>
      <td>
        <button type="button" class="btn btn-success d-inline-block p-1" onclick="dataToFormHTML(${proyecto.id})">
          <i class="bi bi-pencil-square" data-bs-toggle="modal" data-bs-target="#editarProyecto"></i>
        </button>
        <button type="button" class="btn btn-danger d-inline-block p-1">
          <i class="bi bi-trash"></i>
        </button>
      </td>
    </tr>
    `;
  });

  document.querySelector("#verProyectos .modal-body").innerHTML = "";
  document.querySelector("#verProyectos .modal-body").append(table);

  // localStorage.setItem(
  //   "proyectos",
  //   LZString.compress(JSON.stringify(proyectos))
  // );
}

async function dataToFormHTML(id) {
  const proyecto = await getById(id);
  const form = document.forms["editarProyecto"];
  form["titulo"].value = proyecto[0].titulo;
  form["descripcion"].value = proyecto[0].descripcion;
  // console.log(proyecto[0]);
}

function cerrarSesion() {
  location.assign("?logout");
}
