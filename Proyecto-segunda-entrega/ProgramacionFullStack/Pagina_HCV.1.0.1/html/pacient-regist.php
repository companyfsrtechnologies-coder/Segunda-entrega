<!doctype html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Acceso del paciente</title>
  </head>

  <body>
    <main class="contenedor">
      <section class="login">
        <h1>Acceso del paciente</h1>

        <p>Ingresa tus datos para acceder al sistema.</p>

        <form id="formAcceso" method="POST" action="../html/pacient-encuest.html">
          <!-- Cédula -->
          <div class="campo">
            <label for="cedula"> Cédula </label>

            <input
              type="text"
              id="cedula"
              name="cedula"
              placeholder="Ej: 12345678"
              required
            />
          </div>

          <!-- Fecha de nacimiento -->
          <div class="campo">
            <label for="fecha"> Fecha de nacimiento </label>

            <input type="date" id="fecha" name="fecha" required />
          </div>

          <!-- Botón -->
          <button type="submit">Ingresar</button>
         
        </form>
         
      </section>

      <div class="acciones">
        <a href="../index.php" class="boton-link">Volver al inicio</a>
        <a href="../html/pacient-pp.php" class="boton-link boton-link-secondary">Ver documentos</a>
      </div>
    </main>

    <!-- JavaScript -->
    <script>
      const formulario = document.getElementById("formAcceso");

      formulario.addEventListener("submit", function (event) {
        // Evita que la página se recargue
        event.preventDefault();

        // Obtiene los valores introducidos
        const cedula = document.getElementById("cedula").value;
        const fecha = document.getElementById("fecha").value;

        // Comprueba que los campos no estén vacíos
        if (cedula !== "" && fecha !== "") {
          // Lleva al paciente a la encuesta
          window.location.href = "../html/pacient-encuest.html";
        } else {
          alert("Debes completar todos los campos.");
        }
      });
    </script>
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        min-height: 100vh;

        font-family: Arial, sans-serif;

        background-color: #f2f5f8;

        display: flex;
        justify-content: center;
        align-items: center;
      }

      .contenedor {
        width: 100%;
        max-width: 450px;

        padding: 20px;
      }

      .login {
        background-color: white;

        padding: 35px;

        border-radius: 12px;

        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
      }

      .login h1 {
        text-align: center;

        margin-bottom: 10px;
      }

      .login p {
        text-align: center;

        color: #666;

        margin-bottom: 25px;
      }

      .campo {
        margin-bottom: 20px;
      }

      .campo label {
        display: block;

        margin-bottom: 7px;

        font-weight: bold;
      }

      .campo input {
        width: 100%;

        padding: 12px;

        border: 1px solid #ccc;

        border-radius: 6px;

        font-size: 16px;
      }

      .campo input:focus {
        outline: none;

        border-color: #0d6efd;
      }

      .acciones {
        width: 100%;
        max-width: 450px;
        margin: 18px auto 0;
        display: flex;
        gap: 12px;
        justify-content: center;
        flex-wrap: wrap;
      }

      .boton-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 180px;
        padding: 12px 18px;
        border-radius: 999px;
        background: linear-gradient(135deg, #0d6efd, #3d8bfd);
        color: white;
        text-decoration: none;
        font-weight: 700;
        box-shadow: 0 8px 18px rgba(13, 110, 253, 0.22);
        transition: transform 0.2s ease, box-shadow 0.2s ease, opacity 0.2s ease;
      }

      .boton-link:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 20px rgba(13, 110, 253, 0.25);
      }

      .boton-link-secondary {
        background: linear-gradient(135deg, #495057, #6c757d);
        box-shadow: 0 8px 18px rgba(73, 80, 87, 0.18);
      }

      .boton-link-secondary:hover {
        box-shadow: 0 12px 20px rgba(73, 80, 87, 0.25);
      }

      button {
        width: 100%;

        padding: 12px;

        border: none;

        border-radius: 6px;

        background-color: #0d6efd;

        color: white;

        font-size: 16px;

        cursor: pointer;
      }

      button:hover {
        background-color: #0b5ed7;
      }
    </style>
  </body>
</html>
