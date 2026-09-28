<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'enfermero') {
    header("Location: prohibido.php");
    exit;
}
require_once('conect-bd.php');
$sqldocs = "SELECT * FROM documento";;
$resultadoDocs = $conn->execute_query($sqldocs);
$sqlpagina = "SELECT * FROM pagina_doc";;
$resultadoPaginas = $conn->execute_query($sqlpagina);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>menú enfermero</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css"
      integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
      crossorigin="anonymous"
    />

    <link rel="stylesheet" href="../css/admin-and-enfermeros-estilos.css" />

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <div class="universal-container-men-enf">
      <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#"> Menú de enfermeria </a>

          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasDarkNavbar"
            aria-controls="offcanvasDarkNavbar"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>

          <div
            class="offcanvas offcanvas-end text-bg-dark"
            tabindex="-1"
            id="offcanvasDarkNavbar"
            aria-labelledby="offcanvasDarkNavbarLabel"
          >
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">
                Menú de opciones
              </h5>

              <button
                type="button"
                class="btn-close btn-close-white"
                data-bs-dismiss="offcanvas"
                aria-label="Close"
              ></button>
            </div>

            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item">
                  <a
                    class="nav-link active"
                    aria-current="page"
                    href="../index.html"
                  >
                    Inicio
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="#"> lista de documentos creados </a>
                </li>
              </ul>

              <form class="d-flex mt-3" role="search">
                <input
                  class="form-control me-2"
                  type="search"
                  placeholder="Buscar"
                  aria-label="Search"
                />

                <button class="btn btn-success" type="submit">Buscar</button>
              </form>
            </div>
          </div>
        </div>
      </nav>
      <header class="decorado-men-admin"></header>
      <div class="alta-baja-mod-docs">
        <section class="altas-baja-mod-encuestas container py-4">
      <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
      <div
        class="card-header bg-white border-bottom d-flex flex-column flex-md-row
              align-items-md-center justify-content-between gap-3 p-4"
     >
      <div>
        <h2 class="h4 mb-1 text-dark">Documentos registrados</h2>
        <p class="text-secondary mb-0">
          Gestiona los documentos del sistema.
        </p>
      </div>

      <a
        href="enfermero-edit-text.php"
        class="btn btn-success d-inline-flex align-items-center justify-content-center gap-2"
      >
        Nuevo documento
      </a>
    </div>

    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead class="table-dark">
          <tr>
            <th scope="col" class="ps-4">titulo</th>
            <th scope="col">especialidad</th>
            <th scope="col">categoria</th>
            <th scope="col">fecha de actualizacion</th>
            <th scope="col" class="text-center pe-4">Acciones</th>
          </tr>
        </thead>

        <tbody>
          <?php if ($resultadoDocs->num_rows > 0): ?>
            <?php foreach ($resultadoDocs as $fila): ?>
              <?php
              $idPagina = 0;

              if ($resultadoPaginas && $resultadoPaginas->num_rows > 0) {
                foreach ($resultadoPaginas as $filaPagina) {
                  if ((int)$fila['id_documento'] === (int)$filaPagina['id_documento']) {
                    $idPagina = (int)$filaPagina['id_pagina'];
                    break;
                  }
                }
              }
              ?>
              <tr>
                <td class="ps-4 fw-semibold text-dark" style="display: none;">
                  <?php echo htmlspecialchars($fila['id_documento']); ?>
                </td>

                <td class="ps-4 fw-semibold text-dark">
                  <?php echo htmlspecialchars($fila['titulo']); ?>
                </td>

                <td>
                  <span class="badge text-bg-primary rounded-pill px-3 py-2">
                    <?php echo htmlspecialchars($fila['especialidad']); ?>
                  </span>
                </td>

                <td>
                  <span class="badge text-bg-success rounded-pill px-3 py-2">
                    <?php echo htmlspecialchars($fila['categoria']); ?>
                  </span>
                </td>
                
                <td>
                  <span class="badge text-bg-info rounded-pill px-3 py-2">
                    <?php echo htmlspecialchars($fila['fecha_act']); ?>
                  </span>
                </td>
                <td class="text-center pe-4">
                  <div class="btn-group btn-group-sm" role="group">
                    <a href="enfermero-edit-text.php?id=<?php echo (int)$fila['id_documento']; ?>" class="btn btn-outline-primary">
                      <i class="fa-solid fa-edit"></i> <span>Editar</span>
                    </a>
                    
                    <a
                      href="borrar.php?id_documento=<?php echo $fila['id_documento']; ?>"
                      class="btn btn-outline-danger"
                      aria-label="Eliminar documento"
                      onclick="return confirm('¿Seguro que deseas eliminar este documento?');"
                    >
                      <i class="fa-solid fa-trash"></i>
                      <span class="d-none d-md-inline ms-1">Eliminar</span>
                    </a>
                  </div>
                </td>
              </tr>
              
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="5" class="text-center py-5 text-secondary">
                <i class="fa-solid fa-users-slash fs-3 d-block mb-3"></i>
                No hay documentos registrados.
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
  </section>
      </div>
      </div>
    </div>
  </body>
</html>
