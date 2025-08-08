const form = document.forms["form-login"];
form.addEventListener("submit", async (ev) => {
  ev.preventDefault();
  const email = form["email"].value;
  const password = form["password"].value;

  let usuario = {
    email: email,
    password: password,
  };
  let data = {};
  try {
    data = await usuarios.checkPassword(usuario);
    console.log(data);
  } catch (error) {
    alert("No se pudo conectar a la base de datos");
    console.log(error);
  }
  if (data.checkPassword) {
    location.assign("./../dashboard/");
  } else {
    alert("Usuario y/o contraseña incorrectos");
  }
});
