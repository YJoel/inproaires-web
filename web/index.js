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
