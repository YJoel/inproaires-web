let ctx = undefined;
/**
 *
 */
let table = {};

function runGraphics() {
  const empleados = JSON.parse(sessionStorage.getItem("empleados"));
  const dataHoras = JSON.parse(sessionStorage.getItem("hExtras"));
  // console.log(dataHoras, empleados);

  const { labels, horasValues } = horasTotales("", empleados, dataHoras);
  // console.log(labels, horasValues);

  ctx = new Chart("horasTotales", {
    type: "bar",
    data: {
      labels: labels,
      datasets: [
        {
          label: "# de horas",
          data: horasValues,
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
}

function horasTotales(mes = "", empleados, dataHoras) {
  let horasValues = [];
  let labels = [];
  let filtroHoras = filtrarPorMes(mes, dataHoras);
  empleados.forEach((e, i) => {
    labels[i] = `${e.nombre.split(" ")[0]} ${e.nombre.split(" ")[1]}`;
    try {
      horasValues[i] = filtroHoras
        .filter((h) => h.nombre == e.nombre)
        .map((el) => el.nHoras)
        .reduce((t, e, i, arr) => (t += e));
      // console.log(horasValues);
    } catch (error) {}
  });

  return { labels, horasValues };
}

function loadDataTable() {
  // console.log();
  let hExtras = JSON.parse(sessionStorage.getItem("hExtras"));
  hExtras = hExtras.map((el, index, array) => {
    array[index]["options"] = `
      <button type="button" class="btn btn-outline-info"data-bs-toggle="modal" data-bs-target="#editarHorasExtras">
        <i class="bi bi-pencil-square" onclick="completarFormularioEditar(${el.id})"></i>
      </button>
      <button type="button" class="btn btn-outline-danger"data-bs-toggle="modal" data-bs-target="#eliminarHorasExtras">
        <i class="bi bi-trash3-fill" onclick="completarFormularioEliminar(${el.id})"></i>
      </button>
    `;
    return el;
  });
  // console.log(hExtras);
  table = $("#hExtras").DataTable({
    // display: ["stripe"],
    // compact: true,
    data: hExtras,
    order: [[3, "desc"]], // Ordena por la tercera columna (índice 2) en orden descendente
    columns: [
      { data: "id" },
      { data: "nombre" },
      { data: "cedula" },
      { data: "fecha" },
      { data: "diaSemana" },
      {
        data: "nHoras",
        render: (data, type, row) => {
          return `${data}h`;
        },
      },
      {
        data: "hDiurnas",
        render: (data, type, row) => {
          return `${data}h`;
        },
      },
      {
        data: "hNocturnas",
        render: (data, type, row) => {
          return `${data}h`;
        },
      },
      { data: "festivo" },
      { data: "options" },
    ],
  });
}

/**
 *
 * @param {String} fechaStr
 * @param {Object[]} hExtras
 * @returns {Object[]}
 */

function filtrarPorMes(fechaStr = "", hExtras) {
  const date = new Date();
  if (fechaStr == "") {
    fechaStr = `${date.getFullYear()}-${
      date.getMonth() >= 10 ? date.getMonth() : "0" + (date.getMonth() + 1)
    }`;
  }

  // consolelog()
  // console.log(fechaStr, hExtras);
  return hExtras.filter((h) => h.fecha.search(fechaStr) >= 0);
}

function actualizarTabla(e) {
  const dataHoras = JSON.parse(sessionStorage.getItem("hExtras"));
  const empleados = JSON.parse(sessionStorage.getItem("empleados"));
  // console.log(e.value);
  // const filtroHoras = filtrarPorMes(e.value, dataHoras);
  const { labels, horasValues } = horasTotales(e.value, empleados, dataHoras);
  // console.log(filtroMes);
  // console.log(horasValues);
  ctx.data.datasets[0] = {
    label: "# de horas",
    data: horasValues,
    borderWidth: 1,
  };
  ctx.update();
}

document.forms["reporte"].addEventListener("submit", bajarReporte);

async function bajarReporte(ev) {
  ev.preventDefault();
  let mes = document.forms["reporte"]["mes"].value;
  const hExtras = JSON.parse(sessionStorage.getItem("hExtras"));

  // console.log(hExtras);
  let filtroMes = hExtras.filter((el) => {
    return el.fecha.search(mes) != -1;
  });

  // console.log(filtroMes);
  exportarXLSX(filtroMes);
}

async function exportarXLSX(data) {
  /* generate worksheet and workbook */
  const worksheetEx = XLSX.utils.json_to_sheet(data);
  const workbookEx = XLSX.utils.book_new();
  XLSX.utils.book_append_sheet(workbookEx, worksheetEx, "Horas Extras");

  /* fix headers */
  XLSX.utils.sheet_add_aoa(
    worksheetEx,
    [
      [
        "Cedula",
        "Nombre",
        "Fecha",
        "Horas Trabajadas",
        "Dia",
        "Horas Nocturnas",
        "Horas Diurnas",
        "Hora de Inicio",
        "Hora Final",
        "Turno",
      ],
    ],
    {
      origin: "A1",
    }
  );

  /* create an XLSX file and try to save to Presidents.xlsx */
  XLSX.writeFile(workbookEx, "horasExtras.xlsx", {
    compression: true,
  });
}
