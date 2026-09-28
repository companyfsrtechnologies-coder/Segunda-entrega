<?php
session_start();



require_once('conect-bd.php');
$sql = "SELECT * FROM usuario";
$sqlEncuestas = "SELECT * FROM encuesta";
$resultadoEncuestas = $conn->execute_query($sqlEncuestas);
$resultadoUsuarios = $conn->execute_query($sql);



?>
<!doctype html>
 <html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Menú de administración</title>
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
    <div class="universal-container-men-admin">
      <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#"> Menú de administración </a>
        </div>
      </nav>
      <header class="decorado-men-admin"></header>
      
     <section class="altas-baja-mod-encuestas container py-4">
      <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
      <div
        class="card-header bg-white border-bottom d-flex flex-column flex-md-row
              align-items-md-center justify-content-between gap-3 p-4"
     >
      <div>
        <h2 class="h4 mb-1 text-dark">Encuestas registradas</h2>
        <p class="text-secondary mb-0">
          Gestiona las encuestas del sistema.
        </p>
      </div>

      <a
        href="admin-crear-encuesta.php"
        class="btn btn-success d-inline-flex align-items-center justify-content-center gap-2"
      >
        Nueva encuesta
      </a>
    </div>

    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead class="table-dark">
          <tr>
            <th scope="col" class="ps-4">titulo</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Fecha de creacion</th>
            <th scope="col" class="text-center pe-4">Acciones</th>
          </tr>
        </thead>

        <tbody>
          <?php if ($resultadoEncuestas->num_rows > 0): ?>
            <?php foreach ($resultadoEncuestas as $fila): ?>
              <tr>
                <td class="ps-4 fw-semibold text-dark">
                  <?php echo htmlspecialchars($fila['titulo']); ?>
                </td>

                <td>
                  <span class="badge text-bg-primary rounded-pill px-3 py-2">
                    <?php echo htmlspecialchars($fila['descripcion']); ?>
                  </span>
                </td>

                <td>
                  <span class="badge text-bg-success rounded-pill px-3 py-2">
                    <?php echo htmlspecialchars($fila['fecha_creacion']); ?>
                  </span>
                </td>

                <td class="text-center pe-4">
                  <div class="btn-group btn-group-sm" role="group">
                    <a
                      href="admin-crear-encuesta.php?id=<?php echo $fila['id_encuesta']; ?>"
                      class="btn btn-outline-primary"
                      aria-label="Editar encuesta"
                    >
                      <i class="fa-solid fa-pen-to-square"></i>
                      <span class="d-none d-md-inline ms-1">Editar</span>
                    </a>

                    <a
                      href="borrar.php?id=<?php echo $fila['id_encuesta']; ?>"
                      class="btn btn-outline-danger"
                      aria-label="Eliminar encuesta"
                      onclick="return confirm('¿Seguro que deseas eliminar esta encuesta?');"
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
                No hay usuarios registrados.
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
  </section>
  <section class="altas-baja-mod-users container py-4">
      <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
      <div
        class="card-header bg-white border-bottom d-flex flex-column flex-md-row
              align-items-md-center justify-content-between gap-3 p-4"
     >
      <div>
        <h2 class="h4 mb-1 text-dark">Usuarios registrados</h2>
        <p class="text-secondary mb-0">
          Gestiona las cuentas y permisos del sistema.
        </p>
      </div>

      <a
        href="admin-crearEditar-usuario.php"
        class="btn btn-success d-inline-flex align-items-center justify-content-center gap-2"
      >
        <i class="fa-solid fa-user-plus"></i>
        Nuevo usuario
      </a>
    </div>

    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead class="table-dark">
          <tr>
            <th scope="col" class="ps-4">Nombre</th>
            <th scope="col">Rol</th>
            <th scope="col">Contraseña</th>
            <th scope="col">Estado</th>
            <th scope="col" class="text-center pe-4">Acciones</th>
          </tr>
        </thead>

        <tbody>
          <?php if ($resultadoUsuarios->num_rows> 0): ?>
            <?php foreach ($resultadoUsuarios as $fila): ?>
              <tr>
                <td class="ps-4 fw-semibold text-dark">
                  <?php echo htmlspecialchars($fila['nombre']); ?>
                </td>

                <td>
                  <span class="badge text-bg-primary rounded-pill px-3 py-2">
                    <?php echo htmlspecialchars($fila['rol']); ?>
                  </span>
                </td>
                <td>
                  <span class="badge text-bg-success rounded-pill px-3 py-2">
                    <?php echo password_hash($fila['contrasena'], PASSWORD_DEFAULT); ?>
                  </span>
                </td>
                <td>
                  <span class="badge text-bg-success rounded-pill px-3 py-2">
                    <?php echo htmlspecialchars($fila['estado']); ?>
                  </span>
                </td>
                
                <td class="text-center pe-4">
                  <div class="btn-group btn-group-sm" role="group">
                    <a
                      href="admin-crearEditar-usuario.php?id=<?= urlencode($fila['id_usuario']); ?>"
                      class="btn btn-outline-primary"
                      aria-label="Editar usuario"
                    >
                      <i class="fa-solid fa-pen-to-square"></i>
                      <span class="d-none d-md-inline ms-1">Editar</span>
                    </a>

                    <a
                      href="borrar.php?id=<?= urlencode($fila['id_usuario']); ?>"
                      class="btn btn-outline-danger"
                      aria-label="Eliminar usuario"
                      onclick="return confirm('¿Seguro que deseas eliminar este usuario?');"
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
                No hay usuarios registrados.
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
  </section>
    </div>
  </body>
</html>
