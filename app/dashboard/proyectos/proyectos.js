let apiUrl = "";
const dominio = "www.inproaires.com.co";
const apiName = "proyectos";
if (dominio.search(location.hostname) >= 0) {
  /* FOR DEPLOY */
  apiUrl = `https://inproaires.com/api/${apiName}/`;
} else if (location.hostname == "localhost") {
  /* FOR DEVELOP */
  apiUrl = `https://inproaires.com/api/${apiName}/`;
}

async function getAll() {
  const response = await fetch(apiUrl, {
    method: "GET",
  });

  return await response.json();
}

async function getById(id) {
  const response = await fetch(`${apiUrl}?id=${id}`, {
    method: "GET",
  });

  return await response.json();
}

async function insert(proyecto) {
  const response = await fetch(apiUrl, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(proyecto),
  });

  return await response.json();
}

async function update(proyecto) {
  const response = await fetch(apiUrl, {
    method: "PUT",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(proyecto),
  });
}
