<?php

require_once('conect-bd.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $contrasena = $_POST['contrasena'] ?? '';
    $rol = $_POST['rol'] ?? '';
    $rolesPermitidos = ['paciente', 'administrador', 'enfermero'];

    if ($nombre === '' || $contrasena === '' || !in_array($rol, $rolesPermitidos, true)) {
        $error = 'Completá todos los campos con valores válidos.';
    } else {
        $contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);
        $consulta = $conn->prepare(
            'INSERT INTO usuario (nombre, contrasena, rol) VALUES (?, ?, ?)'
        );
        $consulta->bind_param('sss', $nombre, $contrasenaHash, $rol);
        $consulta->execute();

        header('Location: admin-menu.php');
        exit;
    }
}
if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    if (isset($_GET['id'])) {
        $idUsuario = $_GET['id'];
        $sqlUsuario = "SELECT * FROM usuario WHERE id_usuario ='$idUsuario';";
        $resultadoUsuario = $conn->execute_query($sqlUsuario);
        $datosUsuario = $resultadoUsuario->fetch_assoc();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
</head>
<body>
    <form method="POST" class="container mt-5">

    <?php if (isset($error)): ?>
        <div class="alert alert-danger" role="alert">
            <?= htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($datosUsuario['id_usuario'])): ?>
        <input type="hidden" name="id_usuario"
            value="<?= htmlspecialchars($datosUsuario['id_usuario']); ?>">
    <?php endif; ?>

    <div class="mb-4">
        <label for="nombre" class="form-label">Nombre y apellido</label>
        <input
            type="text"
            class="form-control"
            id="nombre"
            name="nombre"
            value="<?= htmlspecialchars($datosUsuario['nombre'] ?? ''); ?>"
            required
        >
    </div>

    <div class="mb-3">
        <label for="rol" class="form-label">Rol</label>
        <select class="form-select" id="rol" name="rol" required>
            <option value="paciente"
                <?= (($datosUsuario['rol'] ?? '') === 'paciente') ? 'selected' : ''; ?>>
                Paciente
            </option>

            <option value="administrador"
                <?= (($datosUsuario['rol'] ?? '') === 'administrador') ? 'selected' : ''; ?>>
                Administrador
            </option>

            <option value="enfermero"
                <?= (($datosUsuario['rol'] ?? '') === 'enfermero') ? 'selected' : ''; ?>>
                Enfermero
            </option>
        </select>
    </div>

    <div class="mb-3">
        <label for="contrasena" class="form-label">Password</label>
        <input
            type="password"
            class="form-control"
            id="contrasena"
            name="contrasena"
            value=""
            <?= isset($datosUsuario['contrasena']) ? '' : 'required'; ?>
        >
        <?php if (isset($datosUsuario)): ?>
            <div class="form-text">Dejá este campo vacío para conservar la contraseña actual.</div>
        <?php endif; ?>
    </div>

    <button type="submit" class="btn btn-primary">
        <?= isset($datosUsuario) ? 'Guardar cambios' : 'Crear usuario'; ?>
    </button>
</form>
</body>
</html>
