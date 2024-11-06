var limite = 10;
var map;
var D = 0;
const cargarApi = async () => {
  try {
    const response = await fetch(
      `http://localhost/PAISES/apipaises/route.php?option=list_paises&limit=${limite}&order=nombre&order_dir=desc`
    );

    const contenido = await response.json();
    console.log(contenido);

    let paisesTabl = "";

    contenido.data.forEach((element) => {
      paisesTabl =
        paisesTabl +
        "<tr><td>" +
        element.nombre +
        `</td><td><button class='btn btn-secondary mb-3' type='button' onclick='verMapa(${element.x},${element.y})'>Ver Mapa</button></td><td><button class='btn btn-secondary mb-3' type='button' onclick='mostrarProvincias(${element.idPais})'>Region</button></td></tr>`;
    });
    console.log(paisesTabl);
    document.getElementById("paises").innerHTML = paisesTabl;
  } catch (error) {
    console.log("ocurrio un error:" + error);
  }
};

const mostrarProvincias = async (idPais) => {
  try {
    document.getElementById("modalProvinciasLabel").innerHTML = "Provincias";
    const response = await fetch(
      `http://localhost/PAISES/apipaises/route.php?option=list_provincias&idPais=${idPais}&limit=10&order=nombre&order_dir=desc`
    );
    const contenido = await response.json();
    console.log(contenido);

    let tablaRegiones =
      "<table class='table table-striped'><thead><tr><th>País</th><th>Ubicacion</th><th>Región</th></tr></thead><tbody>";

    contenido.data.forEach((element) => {
      tablaRegiones =
        tablaRegiones +
        "<tr><td>" +
        element.nombre +
        `</td><td><button class='btn btn-secondary mb-3' type='button' onclick='verMapa(${element.x},${element.y})'>Ver Mapa</button></td><td><button class='btn btn-secondary mb-3' type='button' onclick='mostrarLocalidades(${element.idProvincia})'>Region</button></td></tr>`;
    });

    tablaRegiones += `</tbody>
        </table>`;
    document.getElementById("provinciasContent").innerHTML = tablaRegiones;
    $("#modalProvincias").modal("show");
  } catch (error) {
    console.log("ocurrio un error:" + error);
  }
};

const mostrarLocalidades = async (idProvincia) => {
  try {
    document.getElementById("modalProvinciasLabel").innerHTML = "Localidades";
    const response = await fetch(
      `http://localhost/PAISES/apipaises/route.php?option=list_localidades&idProvincia=${idProvincia}&limit=10&order=nombre&order_dir=desc`
    );
    const result = await response.json();
    let tablaLocalidades =
      "<h3>La Provincia Seleccionada no tiene Localidades</h3>";
    if (result.data !== null) {
      tablaLocalidades =
        "<table class='table table-striped'><thead><tr><th>País</th><th>Ubicacion</th><th>Distancia</th><th>Recorrido</th></tr></thead><tbody>";

      result.data.forEach((element) => {
        calcularDistancia(element.x, element.y);
        tablaLocalidades =
          tablaLocalidades +
          "<tr><td>" +
          element.nombre +
          `</td><td><button class='btn btn-secondary mb-3' type='button' onclick='verMapa(${element.x},${element.y})'>Ver Mapa</button></td><td>${D} Km</td><td> QSY</td></tr>`;
      });

      tablaLocalidades += `</tbody>
        </table>`;
    }

    document.getElementById("provinciasContent").innerHTML = tablaLocalidades;
  } catch (error) {
    console.log("ocurrio un error:" + error);
  }
};

const verMapa = async (lat, long) => {
  try {
    if (map !== undefined) {
      map.remove(); // Remover el mapa si ya está inicializado
    }
    map = L.map("map").setView([lat, long], 12); // Crear el mapa aquí
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
      attribution:
        '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(map);

    $("#mapModal").modal("show");
  } catch (error) {
    console.log("ocurrio un error:" + error);
  }
};

const btnAmpliar = document.getElementById("ampliar");
btnAmpliar.addEventListener("click", () => {
  limite += 10;
  cargarApi();
});

function calcularDistancia(Lat2, Lon2) {
  let Lon1 = -63.75907135;
  let Lat1 = -35.6670417786;
  let PI = 3.14159265358979323846;
  Lat1 = (Lat1 * PI) / 180;
  Lon1 = (Lon1 * PI) / 180;
  Lat2 = (Lat2 * PI) / 180;
  Lon2 = (Lon2 * PI) / 180;
  D =
    6378.137 *
    Math.acos(
      Math.cos(Lat1) * Math.cos(Lat2) * Math.cos(Lon2 - Lon1) +
        Math.sin(Lat1) * Math.sin(Lat2)
    );
  D = truncarADecimales(D, 2);
}

function truncarADecimales(numero, decimales) {
  let factor = Math.pow(10, decimales);
  return Math.trunc(numero * factor) / factor;
}

cargarApi();
