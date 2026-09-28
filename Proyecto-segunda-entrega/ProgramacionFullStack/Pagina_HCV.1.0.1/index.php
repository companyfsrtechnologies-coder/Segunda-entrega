<!doctype html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hospital - Inicio</title>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="css/index-estilos.css" />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <div class="universal-container">
      <header>
        <div class="logo-contain">
          <img src="img/logo-hc.png" alt="Logo del hospital" />
        </div>
      </header>

      <main>
        <section class="hero">
          <img class="img-hc" src="img/hc.jpg" alt="Hospital" />
          <div class="text-contain" for="img-hc">
            <span class="eyebrow">Portal interactivo del hospital</span>
            <h2 class="bien-venida">Bienvenido</h2>
            <p>
              Es traído a usted nuestro portal interactivo, diseñado para ofrecer
              una mejor experiencia de recuperación y apoyar a todos los
              funcionarios del hospital.
            </p>
          </div>
        </section>

        <section class="accesos-wrap">
          <h1 class="tit-accesarea">Área de accesos</h1>
          <div id="section-accesos">
            <article class="card access-card">
              <img src="img/acces-pacientes.jpg" class="card-img-top" alt="Pacientes" />
              <div class="card-body">
                <h5 class="card-title">Pacientes</h5>
                <p class="card-text">
                  Acceda a su información, seguimiento y recursos de atención.
                </p>
                <a href="html/pacient-regist.php" class="btn btn-primary btn-custom">Entrar</a>
              </div>
            </article>

            <article class="card access-card">
              <img src="img/acces-admin.jpg" class="card-img-top" alt="Administración" />
              <div class="card-body">
                <h5 class="card-title">Administración</h5>
                <p class="card-text">
                  Gestiona usuarios, encuestas y procesos del hospital con mayor control.
                </p>
                <a href="html/admin-ingreso.php" class="btn btn-primary btn-custom">Entrar</a>
              </div>
            </article>

            <article class="card access-card">
              <img src="img/acces-enfermeria.jpeg" class="card-img-top" alt="Enfermería" />
              <div class="card-body">
                <h5 class="card-title">Enfermería</h5>
                <p class="card-text">
                  Consulta y actualiza información clínica para una atención ágil.
                </p>
                <a href="html/enfermero-ingreso.php" class="btn btn-primary btn-custom">Entrar</a>
              </div>
            </article>
          </div>
        </section>
      </main>

      <footer>
        <div class="redes-sociales">
          <a href="#" aria-label="YouTube"><img src="img/logo-yt.png" alt="YouTube" /></a>
          <a href="#" aria-label="Instagram"><img src="img/logo-ig.png" alt="Instagram" /></a>
          <a href="#" aria-label="Twitter"><img src="img/logo-twitter.png" alt="Twitter" /></a>
        </div>
      </footer>
    </div>
  </body>
</html>
