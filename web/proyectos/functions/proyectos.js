const apiUrlDevelop = "http://localhost:3000/api/proyectos/";
const apiUrlDeploy = "https://inproaires.com/api/proyectos/";

async function getAll() {
  const response = await fetch(apiUrlDevelop, {
    method: "GET",
  });

  return await response.json();
}

async function getById(id) {
  const response = await fetch(`${apiUrlDevelop}?id=${id}`, {
    method: "GET",
  });

  return await response.json();
}

async function insert(proyecto) {
  const response = await fetch(apiUrlDevelop, {
    method: "POST",
    headers: "Content-Type: application/json",
    body: JSON.stringify(proyecto),
  });

  return await response.json();
}

async function update(proyecto) {
  const response = await fetch(apiUrlDevelop, {
    method: "PUT",
    headers: "Content-Type: application/json",
    body: JSON.stringify(proyecto),
  });
}
