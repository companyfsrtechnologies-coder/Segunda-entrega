<?php
require_once('conect-bd.php');

$idDocumento = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$documento = null;

if ($idDocumento > 0) {
    $resultadoDocumento = $conn->execute_query(
        "SELECT * FROM documento
         WHERE id_documento = $idDocumento
         AND categoria = 'Laboratorio'
         AND especialidad = 'Hematología'"
    );
    $documento = $resultadoDocumento->fetch_assoc();

    if ($documento) {
        $resultadoPaginas = $conn->execute_query(
            "SELECT * FROM pagina_doc
             WHERE id_documento = $idDocumento
             ORDER BY numero_pagina ASC"
        );
    }
}

$resultadoDocs = $conn->execute_query(
    "SELECT * FROM documento
     WHERE categoria = 'Laboratorio' AND especialidad = 'Hematología'
     ORDER BY titulo ASC"
);
?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Documentos de Hematología</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/admin-and-enfermeros-estilos.css" />
  </head>
  <body>
    <div class="universal-container-men-enf">
      <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="pacient-pp.php">Documentación de consulta</a>
          <a class="btn btn-outline-light btn-sm" href="pacient-pp.php">Volver</a>
        </div>
      </nav>

      <main class="container py-4">
        <?php if ($documento): ?>
          <section class="card border-0 shadow-sm">
            <div class="card-header bg-white">
              <a href="hematologia.php" class="btn btn-outline-secondary btn-sm">Volver a documentos</a>
              <h1 class="h4 mt-3"><?php echo htmlspecialchars($documento['titulo']); ?></h1>
            </div>
            <div class="card-body">
              <?php if ($resultadoPaginas->num_rows > 0): ?>
                <?php while ($pagina = $resultadoPaginas->fetch_assoc()): ?>
                  <h2 class="h6 text-secondary">Página <?php echo (int)$pagina['numero_pagina']; ?></h2>
                  <p><?php echo nl2br(htmlspecialchars($pagina['contenido'])); ?></p>
                <?php endwhile; ?>
              <?php else: ?>
                <p class="text-secondary mb-0">Este documento todavía no tiene contenido.</p>
              <?php endif; ?>
            </div>
          </section>
        <?php elseif ($idDocumento > 0): ?>
          <div class="alert alert-warning">No se encontró ese documento de Hematología.</div>
          <a href="hematologia.php" class="btn btn-outline-secondary">Volver a documentos</a>
        <?php else: ?>
          <section class="card border-0 shadow-sm">
            <div class="card-header bg-white">
              <h1 class="h4 mb-0">Documentos de Hematología</h1>
            </div>
            <div class="table-responsive">
              <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                  <tr>
                    <th class="ps-4">Título</th>
                    <th>Categoría</th>
                    <th>Fecha de actualización</th>
                    <th class="text-end pe-4">Documento</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if ($resultadoDocs->num_rows > 0): ?>
                    <?php while ($fila = $resultadoDocs->fetch_assoc()): ?>
                      <tr>
                        <td class="ps-4 fw-semibold"><?php echo htmlspecialchars($fila['titulo']); ?></td>
                        <td><?php echo htmlspecialchars($fila['categoria']); ?></td>
                        <td><?php echo htmlspecialchars($fila['fecha_act'] ?? ''); ?></td>
                        <td class="text-end pe-4">
                          <a class="btn btn-outline-primary btn-sm" href="hematologia.php?id=<?php echo (int)$fila['id_documento']; ?>">Leer</a>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                  <?php else: ?>
                    <tr><td colspan="4" class="text-center py-4">No hay documentos de Hematología disponibles.</td></tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </section>
        <?php endif; ?>
      </main>
    </div>
  </body>
</html>
