<?php
require_once('conect-bd.php');

$resultado = $conn->query("SELECT id_usuario, contrasena FROM usuario");

$stmt = $conn->prepare(
    "UPDATE usuario SET contrasena = ? WHERE id_usuario = ?"
);

$migradas = 0;
$omitidas = 0;

while ($usuario = $resultado->fetch_assoc()) {
    // Evita aplicar un hash sobre otro hash si se abre este archivo otra vez.
    if (password_get_info($usuario['contrasena'])['algo'] !== null) {
        $omitidas++;
        continue;
    }

    $hash = password_hash($usuario['contrasena'], PASSWORD_DEFAULT);

    $stmt->bind_param("si", $hash, $usuario['id_usuario']);
    $stmt->execute();
    $migradas++;
}

echo "Contraseñas migradas correctamente.";
