const form = document.forms["registro-horas-extras"];

const diasSemana = [
  "Lunes",
  "Martes",
  "Miercoles",
  "Jueves",
  "Viernes",
  "Sabado",
  "Domingo",
];

const toastTrigger = document.getElementById("registrar");
const toastLiveExample = document.getElementById("liveToast");
let toastBootstrap = "";
if (toastTrigger) {
  toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
}

async function calcularHorasExtras(ev) {
  ev.preventDefault();

  const convertirTiempo = (fecha, str) => {
    const [hora, minuto] = str.split(":").map(Number);
    const f = new Date(fecha);
    f.setHours(hora, minuto, 0, 0);
    return f;
  };

  try {
    const fechaStr = form["fecha"].value; // formato esperado: "YYYY-MM-DD"
    const diaSemana = new Date(fechaStr).getDay(); // 0 = domingo, 6 = sábado

    let entradaStr = form["hInicio"].value;
    let salidaStr = form["hFin"].value;
    let tipoJornada = form["turnoTrabajo"].value;
    let festivo = form["festivo"].checked;
    const entrada = convertirTiempo(fechaStr, entradaStr);
    const salida = convertirTiempo(fechaStr, salidaStr);

    let jornada;

    if (entrada > salida) {
      salida.setDate(salida.getDate() + 1);
      // fechaStr2.s]etDate(fechaStr2.getDate() + 1);
      jornada = [
        [
          convertirTiempo(fechaStr, "00:00"),
          convertirTiempo(fechaStr, "00:00"),
        ],
      ];
    } else {
      if (diaSemana === 5) {
        // Sábado
        jornada = [
          [
            convertirTiempo(fechaStr, "08:00"),
            convertirTiempo(fechaStr, "13:00"),
          ],
        ];
      } else if (diaSemana === 6 || festivo) {
        // console.log("Domingo | festivo");
        jornada = [
          [
            convertirTiempo(fechaStr, "00:00"),
            convertirTiempo(fechaStr, "00:00"),
          ],
        ];
      } else if (diaSemana < 5) {
        if (tipoJornada === "Hoteles") {
          jornada = [
            [
              convertirTiempo(fechaStr, "08:00"),
              convertirTiempo(fechaStr, "12:00"),
            ],
            [
              convertirTiempo(fechaStr, "13:00"),
              convertirTiempo(fechaStr, "17:00"),
            ],
          ];
        } else if (tipoJornada === "Clientes Ocasionales") {
          jornada = [
            [
              convertirTiempo(fechaStr, "08:00"),
              convertirTiempo(fechaStr, "12:00"),
            ],
            [
              convertirTiempo(fechaStr, "14:00"),
              convertirTiempo(fechaStr, "18:00"),
            ],
          ];
        }
      } else {
        throw new Error("Tipo de jornada no válida");
      }
    }

    let minutosExtrasDiurna = 0;
    let minutosExtrasNocturna = 0;
    let jorndaDiurna = {
      inicio: new Date(fechaStr),
      fin: new Date(fechaStr),
    };
    jorndaDiurna.inicio.setHours(6, 0);
    jorndaDiurna.fin.setHours(19, 0);

    for (
      let actual = new Date(entrada);
      actual < salida;
      actual.setMinutes(actual.getMinutes() + 1)
    ) {
      const estaDentro = jornada.some(
        ([inicio, fin]) => actual >= inicio && actual < fin
      );
      if (!estaDentro) {
        if (actual >= jorndaDiurna.inicio && actual < jorndaDiurna.fin) {
          minutosExtrasDiurna++;
        } else {
          minutosExtrasNocturna++;
        }
      }
    }

    let extraNocturna = Math.round(minutosExtrasNocturna / 60);
    let extraDiurna = Math.round(minutosExtrasDiurna / 60);
    let empleados = JSON.parse(sessionStorage.getItem("empleados"));
    let empleado = "";
    try {
      empleado = empleados.find((em) => {
        return em.cedula == form["cedula"].value;
      });
    } catch (error) {}
    let hextra = {
      cedula: form["cedula"].value,
      nombre: empleado.nombre,
      fecha: form["fecha"].value,
      nHoras: extraNocturna + extraDiurna,
      diaSemana: diasSemana[diaSemana],
      hNocturnas: extraNocturna,
      hDiurnas: extraDiurna,
      hInicio: entradaStr,
      hFin: salidaStr,
      turno: tipoJornada,
      festivo: festivo == true ? "SI" : "NO",
    };

    // console.log(hextra);
    const result = await hExtra.insert(hextra);
    if (result.error == 0) {
      toastLiveExample.classList = "toast bg-success";
      toastLiveExample.innerHTML = `
        <div class="toast-body text-white">
          <i class="bi bi-check-circle-fill"></i> Horas extras registradas
        </div>
      `;
      // alert("Horas extras registradas");
    } else {
      throw new Error(
        "Error al ingresar horas extras, actualice la página e intente nuevamente"
      );
    }
  } catch (error) {
    toastLiveExample.classList = "toast bg-danger";
    toastLiveExample.innerHTML = `
      <div class="toast-body text-white">
        <i class="bi bi-x-circle-fill"></i> Error al ingresar horas extras, actualice la página e intente nuevamente
      </div>
    `;
    // alert(error);
    console.log(error);
  }

  toastBootstrap.show();
  const dataHoras = await hExtra.getAll();
  sessionStorage.setItem("hExtras", JSON.stringify(dataHoras));
  form.reset();
  cargarFecha();
}

form.addEventListener("submit", calcularHorasExtras);

async function cargarEmpleados() {
  try {
    const select = document.getElementById("cedula");
    const select2 = document.getElementById("cedula2");
    const arrayEmpleados = await empleados.getAll();
    sessionStorage.setItem("empleados", JSON.stringify(arrayEmpleados));

    arrayEmpleados.forEach((em) => {
      select.innerHTML += `<option value="${em.cedula}">${em.nombre}</option>`;
      // select2.innerHTML += `<option value="${em.cedula}">${em.nombre}</option>`;
    });
  } catch (error) {
    toastLiveExample.classList = "toast bg-danger";
    toastLiveExample.innerHTML = `
      <div class="toast-body text-white">
        <i class="bi bi-x-circle-fill"></i> No se pudo conectar a la base de datos
      </div>
    `;
    toastBootstrap.show();
  }
}

function cargarFecha() {
  const d = new Date();
  form["fecha"].value = `${d.getFullYear()}-${
    d.getMonth() + 1 >= 10 ? d.getMonth() + 1 : `0${d.getMonth() + 1}`
  }-${d.getDate() >= 10 ? d.getDate() : `0${d.getDate()}`}`;
}

async function cargarUI() {
  // console.log("Event", this);
  try {
    cargarEmpleados();
    cargarFecha();
    runGraphics();
    loadDataTable();
  } catch (error) {
    console.log(error);
  }
}

document.body.addEventListener("load", cargarUI());

function cerrarSesion() {
  location.assign("?logout");
}
