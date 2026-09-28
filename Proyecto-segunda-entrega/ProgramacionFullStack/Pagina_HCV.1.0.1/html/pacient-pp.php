<!doctype html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Documentación para pacientes</title>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
      crossorigin="anonymous"
    />

    <link rel="stylesheet" href="../css/paciente-estilos.css" />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
      crossorigin="anonymous"
    ></script>
  </head>

  <body class="body-docsconsulta">
    <div class="universal-container-pacient-dc">
      <nav class="navbar navbar-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="../index.php">Documentación de consulta</a>
        </div>
      </nav>

      <header class="header-docsconsulta">
        <div class="cabecera-texto">
          <div class="titulo-hospital">HOSPITAL DE CLÍNICAS</div>
          <div class="subtitulo-hospital">Dr. Manuel Quintela</div>
        </div>
        <a href="pacient-help.php" class="btn btn-primary btn-help">Ayuda</a>
        <a href="pacient-regist.php" class="btn btn-primary btn-help">Encuestas</a>
        <a href="index.php" class="btn btn-primary btn-help">Volver al inicio</a>
      </header>

      <main class="categorias-documentos">
        <div class="btn-group">
          <div class="doc-header">
            <img src="../img/logo-laboratorio.png" class="img-consulta" alt="Laboratorio" />
            <span>Labratorio</span>
          </div>
          <details class="especialidad-panel">
            <summary>Ver especialidades</summary>
            <ul class="especialidad-menu">
              <li><a href="hematologia.php">Hematología</a></li>
              <li><a href="bioquimica.php">Bioquímica</a></li>
              <li><a href="microbiologia.php">Microbiología</a></li>
            </ul>
          </details>
        </div>

        <div class="btn-group">
          <div class="doc-header">
            <img src="../img/salud-mental.png" class="img-consulta" alt="Salud mental" />
            <span>Salud Mental</span>
          </div>
          <details class="especialidad-panel">
            <summary>Ver especialidades</summary>
            <ul class="especialidad-menu">
              <li><a href="#">Psicología</a></li>
              <li><a href="#">Psiquiatría</a></li>
            </ul>
          </details>
        </div>

        <div class="btn-group">
          <div class="doc-header">
            <img src="../img/enfermedad-del-corazon.png" class="img-consulta" alt="Enfermedades cardiovasculares" />
            <span>Cardiovascular</span>
          </div>
          <details class="especialidad-panel">
            <summary>Ver especialidades</summary>
            <ul class="especialidad-menu">
              <li><a href="#">Cardiología</a></li>
              <li><a href="#">Cirugía cardiovascular</a></li>
            </ul>
          </details>
        </div>

        <section class="pantallas-secundarias">
          <span class="eyebrow">Revisa tus documentos</span>
          <h2>Documentos de consulta</h2>
          <p>
            Selecciona la categoría que corresponde a tu atención para acceder a la
            información y documentos disponibles.
          </p>
        </section>
      </main>
    </div>
  </body>
</html>
