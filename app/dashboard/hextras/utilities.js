let ctx = undefined;
/**
 *
 */
let table = null;
let table1 = null;

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
      responsive: true,
      plugins: {
        tooltip: {
          enabled: true,
        },
      },
      scales: {
        y: {
          beginAtZero: true,
        },
      },
      onClick: (evt, element) => {
        // console.log(element);
        const button = document.getElementById("defaultButton");
        if (element.length > 0) {
          const index = element[0].index;
          const nombreEmpleado = ctx.data.labels[index];
          // const data = ctx.data.datasets[0].data;
          // const horas = data[index];

          button.setAttribute("data-bs-whatever", nombreEmpleado);
          button.click();
        }
      },
    },
  });
}

document
  .getElementById("registroHorasEmpleado")
  .addEventListener("show.bs.modal", (ev) => {
    const button = ev.relatedTarget;
    const em = button.getAttribute("data-bs-whatever");
    const dataHoras = JSON.parse(sessionStorage.getItem("hExtras"));
    const modalTitle = ev.target.querySelector(".modal-title");
    modalTitle.innerHTML = `Horas Extras Empleado: ${em}`;

    let hExtras = dataHoras.filter((el) => el.nombre.search(em) != -1);
    // hExtras = hExtras.map((el, index, array) => {
    //   array[index]["options"] = `
    //     <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#editarHorasExtras" id="editar_${el.id}">
    //       <i class="bi bi-pencil-square"></i>
    //     </button>
    //     <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#eliminarHorasExtras" id="eliminar_${el.id}">
    //       <i class="bi bi-trash3-fill"></i>
    //     </button>
    //   `;
    //   return el;
    // });

    setTimeout(function () {
      if (table1) {
        // Vaciar la tabla
        table1.clear();
        // Asignar nuevos datos
        table1.rows.add(hExtras);
        // Redibujar
        table1.draw();
      } else {
        table1 = $("#hExtrasEmpleado").DataTable({
          data: hExtras,
          // compact: true,
          responsive: true,
          dom: "lBfrtip",
          order: [[0, "desc"]], // Ordena por la tercera columna (índice 2) en orden descendente
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
            // { data: "options" },
          ],
        });
      }
    }, 200);
  });

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

/**
 *
 * @param {Event} ev
 */

function completarFormularioEditar(ev) {
  let id = ev.relatedTarget.id.split("_")[1];
  let empleados = JSON.parse(sessionStorage.getItem("empleados"));
  let hExtras = JSON.parse(sessionStorage.getItem("hExtras"));
  let hExtra = hExtras.find((h) => h.id == id);
  // console.log("hExtras", hExtras);
  console.log("id", id);
  let select = document.forms["editar-horas-extras"]["cedula"];
  select.innerHTML = "";
  empleados.forEach((em) => {
    if (em.cedula == hExtra.cedula) {
      select.innerHTML += `<option value="${em.cedula}" selected>${em.nombre}</option>`;
    } else {
      select.innerHTML += `<option value="${em.cedula}">${em.nombre}</option>`;
    }
  });

  document.forms["editar-horas-extras"]["turnoTrabajo"].value = hExtra.turno;
  document.forms["editar-horas-extras"]["fecha"].value = hExtra.fecha;
  document.forms["editar-horas-extras"]["festivo"].checked =
    hExtra.festivo == "SI" ? true : false;
  document.forms["editar-horas-extras"]["hInicio"].value = hExtra.hInicio;
  document.forms["editar-horas-extras"]["hFin"].value = hExtra.hFin;
  document.forms["editar-horas-extras"]["id"].value = hExtra.id;
}

function completarFormularioEliminar(ev) {
  let id = ev.relatedTarget.id.split("_")[1];
  formEliminar["id"].value = id;
}

const modalEditarHExtras = document.getElementById("editarHorasExtras");
modalEditarHExtras.addEventListener("show.bs.modal", completarFormularioEditar);
const modalEliminarHExtras = document.getElementById("eliminarHorasExtras");
modalEliminarHExtras.addEventListener(
  "show.bs.modal",
  completarFormularioEliminar
);

function loadDataTable() {
  // console.log();
  let hExtras = JSON.parse(sessionStorage.getItem("hExtras"));
  hExtras = hExtras.map((el, index, array) => {
    array[index]["options"] = `
      <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#editarHorasExtras" id="editar_${el.id}">
        <i class="bi bi-pencil-square"></i>
      </button>
      <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#eliminarHorasExtras" id="eliminar_${el.id}">
        <i class="bi bi-trash3-fill"></i>
      </button>
    `;
    return el;
  });
  // console.log(hExtras);
  table = $("#hExtras").DataTable({
    data: hExtras,
    // display: ["columnControl", "searchBuilder", "buttons"],
    // compact: true,
    // columnControl: {
    //   layout: "dropdown", // o 'inline' si prefieres que aparezca directamente
    //   controls: ["searchText", "orderAsc", "orderDesc", "orderClear"],
    // },
    responsive: true, // Adaptación a dispositivos móviles
    // autoWidth: false, // Evita que calcule ancho automáticamente
    dom: "lBfrtip", // B = Buttons, C = ColumnControl, Q = SearchBuilder, etc.
    searchBuilder: true,
    columnDefs: [
      { targets: "_all", control: true },
      { targets: "_all", orderable: true },
    ],
    // buttons: ["csv", "excel"],
    // buttons: [
    //   {
    //     extend: "csvHtml5",
    //     text: "Exportar CSV",
    //     className: "btn-export-csv",
    //     exportOptions: {
    //       // columns: ":all", // Incluye todas las columnas, visibles o no
    //       modifier: {
    //         search: "applied", // Solo datos filtrados
    //         page: "all", // Ignora la paginación
    //       },
    //     },
    //   },
    //   {
    //     extend: "excelHtml5",
    //     text: "Exportar Excel",
    //     className: "btn-export-excel",
    //     exportOptions: {
    //       // columns: ":all", // Incluye todas las columnas, visibles o no
    //       modifier: {
    //         search: "applied", // Solo datos filtrados
    //         page: "all", // Ignora la paginación
    //       },
    //     },
    //   },
    // ],

    order: [[0, "desc"]], // Ordena por la tercera columna (índice 2) en orden descendente
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

  return hExtras.filter((h) => h.fecha.search(fechaStr) >= 0);
}

function actualizarGrafica(e) {
  const dataHoras = JSON.parse(sessionStorage.getItem("hExtras"));
  const empleados = JSON.parse(sessionStorage.getItem("empleados"));

  const { labels, horasValues } = horasTotales(e.value, empleados, dataHoras);

  ctx.data.datasets[0] = {
    label: "# de horas",
    data: horasValues,
    borderWidth: 1,
  };
  ctx.update();
}

function actualizarTabla(e) {
  let empleado = parseInt(e.value);
  console.log(empleado);
  let dataHoras = JSON.parse(sessionStorage.getItem("hExtras"));
  dataHoras = dataHoras.map((el, index, array) => {
    array[index]["options"] = `
      <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#editarHorasExtras" id="editar_${el.id}">
        <i class="bi bi-pencil-square"></i>
      </button>
      <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#eliminarHorasExtras" id="eliminar_${el.id}">
        <i class="bi bi-trash3-fill"></i>
      </button>
    `;
    return el;
  });
  let filtro = [];
  if (empleado) {
    console.log("If(empleado)");
    filtro = dataHoras.filter((em) => em.cedula == empleado);
  } else {
    filtro = dataHoras;
  }

  table.clear();
  table.rows.add(filtro);
  table.draw();
}

document.forms["reporte"].addEventListener("submit", bajarReporte);

async function bajarReporte(ev) {
  ev.preventDefault();
  let mes = document.forms["reporte"]["mes"].value;
  const hExtras = JSON.parse(sessionStorage.getItem("hExtras"));

  let filtroMes = hExtras.filter((el) => {
    return el.fecha.search(mes) != -1;
  });

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
