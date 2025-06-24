function app() {
  const links = document.querySelectorAll(".nav-item>a.nav-link");
  const pageContent = document.querySelector(".row#content");

  document.body.addEventListener("load", cargarPagina());
  window.addEventListener("popstate", cargarPagina);

  function prevenirCargaDeEnlaces() {
    links.forEach((a, index, link) => {
      a.addEventListener("click", (ev) => {
        ev.preventDefault();
        history.pushState({ page: index + 1 }, `pagina ${index + 1}`, a.href);
        cargarPagina();
      });
    });
  }
  prevenirCargaDeEnlaces();

  async function cargarPagina() {
    console.log("cargarPagina() running...");
    const params = new URLSearchParams(location.search);
    const BRAND = "Inproaires";
    const pages = {
      home: `${BRAND}`,
      nosotros: `Nosotros - ${BRAND}`,
      ventilacion: `Ventilacion - ${BRAND}`,
      aireacondicionado: `Aire Acondicionado - ${BRAND}`,
      servicios: `Servicios - ${BRAND}`,
      proyectos: `Proyectos - ${BRAND}`,
      contactanos: `Contactanos - ${BRAND}`,
    };

    if (params.size == 0) {
      location.assign("?page=home");
    }
    const baseUrl = location.origin + location.pathname;

    if (links[0].parentElement.parentElement.querySelector(".active")) {
      links[0].parentElement.parentElement
        .querySelector(".active")
        .classList.remove("active");
    }

    links.forEach((a) => {
      // console.log(a.href.indexOf(params.get("page"), a.href.indexOf("page")));
      if (a.href.indexOf(params.get("page"), a.href.indexOf("page")) != -1) {
        a.parentElement.classList.add("active");
      }
    });

    document.title =
      pages[params.get("page")] == undefined
        ? BRAND
        : pages[params.get("page")];
    const res = await fetch(`${baseUrl}pages/${params.get("page")}.html`);
    pageContent.innerHTML = await res.text();
  }

  function formWhatsappEvents() {
    let form = document.forms["wa-message"];
    // console.log(form);

    function actualizarextArea() {
      form["mensaje"].innerHTML = `Hola, soy *${
        form["nombre"].value + " " + form["apellido"].value
      }* estoy interesado en sus servicios`;
    }
    form["nombre"].addEventListener("keyup", actualizarextArea);
    form["apellido"].addEventListener("keyup", actualizarextArea);

    form.addEventListener("submit", function enviarMensajeWhatsapp(ev) {
      console.log("Evento, prevenido");
      ev.preventDefault();

      const mensaje = form["mensaje"].value;
      window.open(`https://wa.me/573218051386?text=${mensaje}`, "_blank");
    });
  }
  formWhatsappEvents();
}

app();
