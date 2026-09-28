<?php

session_start();
require_once('conect-bd.php');

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $nombre = $_POST['nombre'];
    $password = $_POST['Password'];

    $sql = "SELECT * FROM usuario WHERE nombre = '$nombre'";

    $resultado = $conn->execute_query($sql);
    $resultadoUsuario = $resultado->fetch_assoc();

    if (password_verify($password, $resultadoUsuario['contrasena'])) {
        $_SESSION['nombre'] = $resultadoUsuario['nombre'];
        $_SESSION['rol'] = $resultadoUsuario["rol"];
        

        header("Location: admin-menu.php");
        exit;
    }
}
?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ingreso de administradores | HCV</title>
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
          <p>Accedé al área de gestión con tus credenciales administrativas.</p>
        </div>
      </section>
      <section class="panel-ingreso" aria-labelledby="titulo-ingreso">
        <div class="panel-encabezado">
          <span class="panel-icono" aria-hidden="true">&#128274;</span>
          <div><p class="panel-subtitulo">Acceso seguro</p><h2 id="titulo-ingreso">Iniciar sesión</h2></div>
        </div>
        <form action="admin-ingreso.php" method="POST" id="formulario">
          <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert"><?= htmlspecialchars($error) ?></div>
          <?php endif; ?>
          <div class="campo-formulario">
            <label for="validationDefault01">Nombre y apellido</label>
            <input type="text" class="form-control" name="nombre" id="validationDefault01" autocomplete="name" required />
          </div>
          <div class="campo-formulario">
            <label for="validationDefault03">Contraseña</label>
            <input type="password" class="form-control" name="Password" id="validationDefault03" autocomplete="current-password" required />
          </div>
          <button class="btn btn-primary btn-ingresar" type="submit">Ingresar</button>
        </form>
      </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="../js/admin-verif.js"></script>
  </body>
</html>
