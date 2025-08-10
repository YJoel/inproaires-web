const usuarios = {
  apiUrl: "",
  apiName: "usuarios",
  getAll: async function () {
    const response = await fetch(this.apiUrl, {
      method: "GET",
    });

    return await response.json();
  },

  /**
   *
   * @param {string{}} usuario
   * @returns
   */
  checkPassword: async function ({ email, password }) {
    const response = await fetch(`${this.apiUrl}`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      credentials: "include", // 🔥 Esto permite que el navegador guarde la cookie
      body: JSON.stringify({ email, password }),
    });

    return await response.json();
  },

  insert: async function (hextra) {
    const response = await fetch(this.apiUrl, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(hextra),
    });

    return await response.json();
  },

  update: async function (hextra) {
    const response = await fetch(this.apiUrl, {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(hextra),
    });
  },
};

if (dominio.search(location.hostname) >= 0) {
  /* FOR DEPLOY */
  usuarios.apiUrl = `https://inproaires.com.co/api/${usuarios.apiName}/`;
} else {
  /* FOR DEVELOP */
  // apiUrl = `http://localhost:3000/api/${apiName}/`;
  usuarios.apiUrl = `./../../../api/${usuarios.apiName}/`;
}
