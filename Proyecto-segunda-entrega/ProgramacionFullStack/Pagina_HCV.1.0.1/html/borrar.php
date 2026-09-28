<?php

require_once('conect-bd.php');

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    if (isset($_GET['id'])) {
        $idUsuario = $_GET['id'];
        $sqlUsuario = "DELETE FROM usuario WHERE id_usuario ='$idUsuario';";
        $resultadoUsuario = $conn->execute_query($sqlUsuario);
        header("Location: admin-menu.php");
        exit;
    }
}
if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    if (isset($_GET['id'])) {
        $idEncuesta = $_GET['id'];
        $sqlEncuesta = "DELETE FROM encuesta WHERE id_encuesta ='$idEncuesta';";
        $resultadoEncuesta = $conn->execute_query($sqlEncuesta);
        header("Location: admin-menu.php");
        exit;
    }
}
if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    if (isset($_GET['id_documento'])) {
        $idDocumento = $_GET['id_documento'];
        $sqlDocumento = "DELETE FROM documento WHERE id_documento ='$idDocumento';";
        $resultadoDocumento = $conn->execute_query($sqlDocumento);
        header("Location: enfermero-menu.php");
        exit;
    }
}
if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    if (isset($_GET['id_pagina'])) {
        $idPagina = $_GET['id_pagina'];
        $sqlPagina = "DELETE FROM pagina_doc WHERE id_pagina ='$idPagina';";
        $resultadoPagina = $conn->execute_query($sqlPagina);
        header("Location: enfermero-menu.php");
        exit;
    }
}


