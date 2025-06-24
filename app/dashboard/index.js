const apiUrl = "http://localhost:3000/api/proyectos/";

document.forms["form-proyectos"].addEventListener("submit", async (ev) => {
  ev.preventDefault();
  const form = ev.target;
  const titulo = form["titulo"].value;
  const descripcion = form["descripcion"].value;
  const imgs = form["file"].files;
  const date = new Date();
  const fecha = `${date.getFullYear()}-${
    date.getMonth() + 1
  }-${date.getDate()}T${date.getHours()}:${date.getMinutes()}:${date.getSeconds()}-05:00`;

  const b64Images = [];
  for (let index = 0; index < imgs.length; index++) {
    b64Images[index] = await comprimirImagen(imgs[index]);
  }

  // const response = await fetch(apiUrl, {
  //   method: "GET",
  // });

  const response = await fetch(apiUrl, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      titulo: titulo,
      descripcion: descripcion,
      b64Images: b64Images,
      fecha: fecha,
    }),
  });

  const data = await response.json();
  if (!data.error) {
    alert("PROYECTO INGRESADO");
  } else {
    alert("NO SE PUDO INGRESAR EL PROYECTO, INTENTE NUEVAMENTE");
  }
  form.reset();
  console.log(data);
});

document.forms["form-proyectos"]["file"].addEventListener(
  "change",
  async (ev) => {
    // console.log(ev.target.files);
    // const file = ev.target.files[0];
    // const imgEl = document.getElementById("upload-image");
    // try {
    //   const base64Comprimido = await comprimirImagen(file);
    //   console.log("📦 Imagen comprimida y codificada:", base64Comprimido);
    //   // Aquí podrías mostrar una vista previa o enviarla al servidor
    //   const preview = new Image();
    //   preview.src = base64Comprimido;
    //   document.body.appendChild(preview);
    // } catch (err) {
    //   alert("Hubo un problema al procesar la imagen.");
    //   console.error(err);
    // }
    // const reader = new FileReader();
    // reader.onloadend = function () {
    //   const base64String = reader.result;
    //   console.log(base64String); // Aquí tienes el string en Base64
    // };
    // reader.readAsDataURL(file);
  }
);

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
