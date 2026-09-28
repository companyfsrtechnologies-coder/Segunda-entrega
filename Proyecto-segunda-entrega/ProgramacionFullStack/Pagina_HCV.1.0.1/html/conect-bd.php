<?php
$host = 'localhost';
$usuario = 'root';
$contrasena = ''; // en XAMPP, por defecto no hay contraseña
$base_datos = 'sigsm_hospital';
$conn = new mysqli($host, $usuario, $contrasena, $base_datos);
if ($conn->connect_error) {
die("Error de conexión: " . $conn->connect_error);
}
?>