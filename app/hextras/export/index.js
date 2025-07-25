async function exportarXLSX() {
  // const rows = [];
  // randomNumbers = M.generarNumerosAleatorios();
  // randomNumbers.forEach((el, i) => {
  //   rows[i] = {
  //     "#": i + 1,
  //     r: randomNumbers[i],
  //   };
  // });

  const hextras = await hExtra.getAll();

  /* generate worksheet and workbook */
  const worksheetEx = XLSX.utils.json_to_sheet(hextras);
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
