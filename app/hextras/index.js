const form = document.forms["registro-horas-extras"];
const jornada = {
  Hoteles: {
    inicio: [9, 0],
    fin: [17, 0],
  },
  "Clientes Ocasionales": {
    inicio: [9, 0],
    fin: [18, 0],
  },
};
const diasSemana = [
  "Lunes",
  "Martes",
  "Miercoles",
  "Jueves",
  "Viernes",
  "Sabado",
  "Domingo",
];

async function buscarEmpleado() {
  console.log(form["cedula"].value);
  const empleado = await empleados.getById(form["cedula"].value);
  console.log(empleado);
  form["nombre"].value = empleado[0].nombre;
}

function cargarFecha() {
  const d = new Date();
  form["fecha"].value = `${d.getFullYear()}-${
    d.getMonth() + 1 >= 10 ? d.getMonth() + 1 : `0${d.getMonth() + 1}`
  }-${d.getDate() >= 10 ? d.getDate() : `0${d.getDate()}`}`;
}

document.body.addEventListener("load", cargarFecha());

async function registrarHorasExtras(ev) {
  ev.preventDefault();

  let hInicio = form["hInicio"].value;
  let hFin = form["hFin"].value;
  let turno = form["turnoTrabajo"].value;
  let festivo = form["festivo"].checked;
  let turnoCopy = turno;
  let diaSemana = new Date(form["fecha"].value).getDay();
  let extraDiurna = horasExtrasDiurnas(
    hInicio,
    hFin,
    turnoCopy,
    diaSemana,
    festivo
  );
  let extraNocturna = horasExtrasNocturna(hInicio, hFin, turnoCopy);
  let nHoras = extraDiurna + extraNocturna;

  let hextra = {
    cedula: form["cedula"].value,
    nombre: form["nombre"].value,
    fecha: form["fecha"].value,
    nHoras: nHoras,
    diaSemana: diasSemana[diaSemana],
    hNocturnas: extraNocturna,
    hDiurnas: extraDiurna,
    hInicio: hInicio,
    hFin: hFin,
    turno: turno,
    festivo: festivo == true ? "SI" : "NO",
  };

  console.log(hextra);
  const result = await hExtra.insert(hextra);
  if (result.error == 0) {
    alert("Horas extras registradas con éxito");
  } else {
    alert(
      "Error al ingresar horas extras, actualice la página e intente nuevamente"
    );
  }

  form.reset();
  cargarFecha();
}

function restarHoras(horaInicio, horaFin) {
  let val1 = horaInicio.split(":").map((el) => {
    return parseInt(el);
  });
  let val2 = horaFin.split(":").map((el) => {
    return parseInt(el);
  });

  val1 = val1[0] * 60 + val1[1];

  val2 = val2[0] * 60 + val2[1];

  let resultado = (val2 - val1) / 60;

  return Math.round(resultado);
}

function horasExtrasDiurnas(horaInicio, horaFin, turno, diaSemana, festivo) {
  let resultado = 0;
  // console.log(jornada[turno], turno);
  let dif1 = restarHoras(jornada[turno].fin.join(":"), horaInicio);
  let dif2 = restarHoras(horaFin, "19:0");
  let limInf = 0;
  let limSup = 0;

  if (diaSemana != "Domingo" && !festivo) {
    if (dif1 <= 0) {
      limInf = jornada[turno].fin.join(":");
    } else {
      limInf = horaInicio;
    }
    if (dif2 >= 0) {
      limSup = horaFin;
    } else {
      limSup = "19:00";
    }
  } else {
    limInf = horaInicio;
    if (dif2 >= 0) {
      limSup = horaFin;
    } else {
      limSup = "19:00";
    }
  }

  resultado = restarHoras(limInf, limSup);

  return resultado;
}

function horasExtrasNocturna(horaInicio, horaFin, turno) {
  let resultado = 0;
  let dif1 = restarHoras("19:0", horaInicio);
  let dif2 = restarHoras("19:0", horaFin);
  let limInf = 0;
  let limSup = 0;

  console.log(dif1, dif2, limInf, limSup);

  if (dif1 < dif2) {
    if (dif1 <= 0) {
      limInf = "19:0";
    } else {
      limInf = horaInicio;
    }
    limSup = horaFin;
    if (restarHoras(limInf, limSup) < 0) {
      return 0;
    }
  } else {
    return 0;
  }
  console.log(dif1, dif2, limInf, limSup);

  resultado = restarHoras(limInf, limSup);

  return resultado;
}

form.addEventListener("submit", registrarHorasExtras);
