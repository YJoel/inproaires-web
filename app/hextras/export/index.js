const form = document.forms["reporte"];

form.addEventListener("submit", bajarReporte);

async function bajarReporte(ev) {
  ev.preventDefault();
  let mes = form["mes"].value;
  const hExtras = await hExtra.getAll();

  // console.log(hExtras);
  let filtroMes = hExtras.filter((el) => {
    return el.fecha.search(mes) != -1;
  });

  // console.log(filtroMes);
  exportarXLSX(filtroMes);
}

async function exportarXLSX(data) {
  // const rows = [];
  // randomNumbers = M.generarNumerosAleatorios();
  // randomNumbers.forEach((el, i) => {
  //   rows[i] = {
  //     "#": i + 1,
  //     r: randomNumbers[i],
  //   };
  // });

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
