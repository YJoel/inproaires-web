function section(backgroundImg = "", title = "", descripcion = "") {
  console.log(title, descripcion);
  if (backgroundImg != "" && title != "" && descripcion != "") {
    return `
      <div class="row section">
        <div class="background">
          <img src="${backgroundImg}" alt="" loading="laxy" />
        </div>
        <div class="content">
          <div class="title">
            <h1>${title}</h1>
          </div>
          <div class="message">
            ${descripcion}
          </div>
        </div>
      </div>
    `;
  } else {
    return "";
  }
}
