function section(id = 0, backgroundImg = [], title = "", descripcion = "") {
  // console.log(title, descripcion);
  let puntosHTML = "";
  backgroundImg.forEach((img, i) => {
    if (i != 0) {
      puntosHTML += `
    <div class="punto">
      <img src="${img}" onmouseover="changeImage('background${id}', this)" onmouseout="restoreBackground('background${id}', '${backgroundImg[0]}')"/>
    </div>`;
    }
  });
  if (backgroundImg != "" || title != "" || descripcion != "") {
    return `
      <div class="row section">
        <div class="background">
          <img src="${backgroundImg[0]}" alt="" loading="lazy" id="background${id}"/>
        </div>
        <div class="content">
          <div class="title">
            <h1>${title}</h1>
          </div>
          <div class="message">
            ${descripcion}
          </div>
          <div class="puntos">
            ${puntosHTML}
          </div>
        </div>
      </div>
    `;
  } else {
    return "";
  }
}
