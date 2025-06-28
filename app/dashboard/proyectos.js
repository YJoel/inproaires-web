/* FOR DEVELOP */
const apiUrl = "http://localhost:3000/api/proyectos/";
/* FOR DEPLOY */
// const apiUrl = "https://inproaires.com/api/proyectos/";

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
