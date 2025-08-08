const empleados = {
  apiUrl: "",
  apiName: "empleados",
  getAll: async function () {
    const response = await fetch(this.apiUrl, {
      method: "GET",
    });

    return await response.json();
  },

  getById: async function (id) {
    const response = await fetch(`${this.apiUrl}?id=${id}`, {
      method: "GET",
    });

    return await response.json();
  },

  insert: async function (empleado) {
    const response = await fetch(this.apiUrl, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(empleado),
    });

    return await response.json();
  },

  update: async function (empleado) {
    const response = await fetch(this.apiUrl, {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(empleado),
    });
  },
};

if (dominio.search(location.hostname) >= 0) {
  /* FOR DEPLOY */
  empleados.apiUrl = `https://inproaires.com.co/api/${empleados.apiName}/`;
} else {
  /* FOR DEVELOP */
  // apiUrl = `http://localhost:3000/api/${apiName}/`;
  empleados.apiUrl = `./../../../api/${empleados.apiName}/`;
}
