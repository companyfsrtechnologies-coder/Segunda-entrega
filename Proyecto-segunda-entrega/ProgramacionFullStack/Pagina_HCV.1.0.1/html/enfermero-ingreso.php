<?php

session_start();
require_once('conect-bd.php');

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $password = $_POST['Password'] ?? '';

    $consulta = $conn->prepare(
        "SELECT id_usuario, nombre, contrasena, rol, estado FROM usuario WHERE nombre = ? LIMIT 1"
    );
    $consulta->bind_param('s', $nombre);
    $consulta->execute();
    $resultadoUsuario = $consulta->get_result()->fetch_assoc();

    if (
        $resultadoUsuario &&
        $resultadoUsuario['rol'] === 'enfermero' &&
        $resultadoUsuario['estado'] === 'Activo' &&
        password_verify($password, $resultadoUsuario['contrasena'])
    ) {
        session_regenerate_id(true);
        $_SESSION['id_usuario'] = (int)$resultadoUsuario['id_usuario'];
        $_SESSION['nombre'] = $resultadoUsuario['nombre'];
        $_SESSION['rol'] = $resultadoUsuario['rol'];

        header("Location: enfermero-menu.php");
        exit;
    }

    $error = 'Las credenciales no son válidas o no pertenecen a un usuario de enfermería activo.';
}
?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ingreso de enfermería | HCV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/admin-and-enfermeros-estilos.css" />
  </head>
  <body class="pagina-ingreso-admin">
    <main class="ingreso-admin">
      <section class="bienvenida" aria-labelledby="titulo-bienvenida">
        <div class="marca-hcv"><img src="../img/logo-hc.png" class="logo-hc" alt="Logo de HCV" /></div>
        <div class="bienvenida-contenido">
          <span class="bienvenida-etiqueta">Portal HCV</span>
          <h1 id="titulo-bienvenida">Bienvenido al portal</h1>
          <p>Accedé al área de enfermería con tus credenciales institucionales.</p>
        </div>
      </section>
      <section class="panel-ingreso" aria-labelledby="titulo-ingreso">
        <div class="panel-encabezado">
          <span class="panel-icono" aria-hidden="true">&#128138;</span>
          <div><p class="panel-subtitulo">Acceso seguro</p><h2 id="titulo-ingreso">Ingresar a enfermería</h2></div>
        </div>
        <form action="enfermero-ingreso.php" method="POST" id="formulario">
          <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert"><?= htmlspecialchars($error) ?></div>
          <?php endif; ?>
          <div class="campo-formulario">
            <label for="validationDefaultUsername">Nombre y apellido</label>
            <input type="text" name="nombre" class="form-control" id="validationDefaultUsername" autocomplete="name" required />
          </div>
          <div class="campo-formulario">
            <label for="validationDefault03">Contraseña</label>
            <input type="password" name="Password" class="form-control" id="validationDefault03" autocomplete="current-password" required />
          </div>
          <button class="btn btn-primary btn-ingresar" type="submit">Ingresar</button>
        </form>
      </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="../js/enfermero-verif.js"></script>
  </body>
</html>
