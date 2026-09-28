<!doctype html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Creador de encuestas</title>

    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 30px;
      }

      .contenedor {
        max-width: 800px;
        margin: auto;
        background-color: white;
        padding: 25px;
        border-radius: 10px;
      }

      input,
      select {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        margin-bottom: 15px;
        box-sizing: border-box;
      }

      .pregunta {
        border: 1px solid #ccc;
        padding: 20px;
        margin-top: 20px;
        border-radius: 8px;
      }

      button {
        padding: 10px 15px;
        margin-top: 10px;
        cursor: pointer;
      }

      .agregar {
        background-color: #0d6efd;
        color: white;
        border: none;
      }

      .publicar {
        background-color: #198754;
        color: white;
        border: none;
      }

      .eliminar {
        background-color: #dc3545;
        color: white;
        border: none;
      }
    </style>
  </head>

  <body>
    <div class="contenedor">
      <h1>Crear encuesta</h1>

      <label> Título de la encuesta </label>

      <input
        type="text"
        id="titulo"
        placeholder="Ej: Encuesta de satisfacción"
      />

      <div id="preguntas"></div>

      <button class="agregar" onclick="agregarPregunta()">
        + Agregar pregunta
      </button>

      <br />

      <button class="publicar" onclick="crearEncuesta()">Crear encuesta</button>
    </div>

    <script>
      let numeroPregunta = 0;

      function agregarPregunta() {
        numeroPregunta++;

        const preguntas = document.getElementById("preguntas");

        const pregunta = document.createElement("div");

        pregunta.classList.add("pregunta");

        pregunta.innerHTML = `

                <h3>Pregunta ${numeroPregunta}</h3>

                <label>
                    Pregunta:
                </label>

                <input
                    type="text"
                    class="textoPregunta"
                    placeholder="Escribí la pregunta">


                <label>
                    Tipo de respuesta:
                </label>

                <select
                    class="tipoRespuesta"
                    onchange="cambiarTipo(this)">

                    <option value="texto">
                        Respuesta de texto
                    </option>

                    <option value="multiple">
                        Opción múltiple
                    </option>

                    <option value="unica">
                        Una sola opción
                    </option>

                </select>


                <div class="opciones">

                </div>


                <button
                    class="eliminar"
                    onclick="this.parentElement.remove()">

                    Eliminar pregunta

                </button>

            `;

        preguntas.appendChild(pregunta);
      }

      function cambiarTipo(select) {
        const pregunta = select.parentElement;

        const opciones = pregunta.querySelector(".opciones");

        if (select.value === "multiple" || select.value === "unica") {
          opciones.innerHTML = `

                    <label>
                        Opciones:
                    </label>

                    <input
                        type="text"
                        placeholder="Ej: Excelente, Buena, Regular">

                `;
        } else {
          opciones.innerHTML = "";
        }
      }

      function crearEncuesta() {
        const titulo = document.getElementById("titulo").value;

        if (titulo === "") {
          alert("Escribí un título para la encuesta.");

          return;
        }

        const preguntas = document.querySelectorAll(".pregunta");

        if (preguntas.length === 0) {
          alert("Agregá al menos una pregunta.");

          return;
        }

        alert("¡Encuesta creada correctamente!");
      }
    </script>
  </body>
</html>
