const hExtra = {
  apiUrl: "./../../../api/hextras/",
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
