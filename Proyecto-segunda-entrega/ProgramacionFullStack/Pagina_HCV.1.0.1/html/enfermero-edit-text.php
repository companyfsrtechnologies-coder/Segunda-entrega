<?php
session_start();
require_once('conect-bd.php');

$idUsuarioActual = isset($_SESSION['id_usuario']) ? (int)$_SESSION['id_usuario'] : null;

if ($idUsuarioActual === null) {
    header("Location: enfermero-ingreso.php");
    exit;
}

$datosDocumento = [
    'titulo' => '',
    'categoria' => '',
    'especialidad' => ''
];
$resultadoPaginas = null;

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $idDocumento = isset($_POST['id_documento']) && $_POST['id_documento'] !== '' ? (int)$_POST['id_documento'] : null;
    $titulo = trim($_POST['titulo'] ?? '');
    $categoria = trim($_POST['categoria'] ?? '');
    $especialidad = trim($_POST['especialidad'] ?? '');
    $contenidos = $_POST['contenido'] ?? [];
    $idPaginas = $_POST['id_pagina'] ?? [];

    if ($idDocumento) {
        $sqlUpdateDocumento = "UPDATE documento SET titulo = ?, categoria = ?, especialidad = ? WHERE id_documento = ?";
        $stmtUpdateDocumento = $conn->prepare($sqlUpdateDocumento);
        $stmtUpdateDocumento->bind_param("sssi", $titulo, $categoria, $especialidad, $idDocumento);
        $stmtUpdateDocumento->execute();
    } else {
        $sqlInsertDocumento = "INSERT INTO documento (titulo, categoria, especialidad, id_usuario) VALUES (?, ?, ?, ?)";
        $stmtInsertDocumento = $conn->prepare($sqlInsertDocumento);
        $stmtInsertDocumento->bind_param("sssi", $titulo, $categoria, $especialidad, $idUsuarioActual);
        $stmtInsertDocumento->execute();
        $idDocumento = $conn->insert_id;
    }

    foreach ($contenidos as $index => $contenido) {
        $textoPagina = trim((string)$contenido);
        $idPagina = isset($idPaginas[$index]) && $idPaginas[$index] !== '' ? (int)$idPaginas[$index] : 0;

        if ($idPagina > 0) {
            if ($textoPagina !== '') {
                $sqlUpdatePagina = "UPDATE pagina_doc SET contenido = ? WHERE id_pagina = ? AND id_documento = ?";
                $stmtUpdatePagina = $conn->prepare($sqlUpdatePagina);
                $stmtUpdatePagina->bind_param("sii", $textoPagina, $idPagina, $idDocumento);
                $stmtUpdatePagina->execute();
            }
        } else {
            if ($textoPagina !== '') {
                $sqlUltimaPagina = "SELECT COALESCE(MAX(numero_pagina), 0) AS ultimo FROM pagina_doc WHERE id_documento = ?";
                $stmtUltimaPagina = $conn->prepare($sqlUltimaPagina);
                $stmtUltimaPagina->bind_param("i", $idDocumento);
                $stmtUltimaPagina->execute();
                $ultimoNumero = (int)($stmtUltimaPagina->get_result()->fetch_assoc()['ultimo'] ?? 0);

                $numeroPagina = $ultimoNumero + 1;

                $sqlInsertPagina = "INSERT INTO pagina_doc (id_documento, numero_pagina, contenido) VALUES (?, ?, ?)";
                $stmtInsertPagina = $conn->prepare($sqlInsertPagina);
                $stmtInsertPagina->bind_param("iis", $idDocumento, $numeroPagina, $textoPagina);
                $stmtInsertPagina->execute();
            }
        }
    }

    header("Location: enfermero-edit-text.php?id=" . $idDocumento);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    $idDocumento = isset($_GET['id']) && $_GET['id'] !== '' ? (int)$_GET['id'] : null;

    if ($idDocumento) {
        $sqlDocumento = "SELECT * FROM documento WHERE id_documento = ?";
        $stmtDocumento = $conn->prepare($sqlDocumento);
        $stmtDocumento->bind_param("i", $idDocumento);
        $stmtDocumento->execute();
        $resultadoDocumento = $stmtDocumento->get_result();
        $datosDocumento = $resultadoDocumento->fetch_assoc() ?: $datosDocumento;

        $sqlPaginas = "SELECT * FROM pagina_doc WHERE id_documento = ? ORDER BY numero_pagina ASC";
        $stmtPaginas = $conn->prepare($sqlPaginas);
        $stmtPaginas->bind_param("i", $idDocumento);
        $stmtPaginas->execute();
        $resultadoPaginas = $stmtPaginas->get_result();
        header("Location: enfermero-menu.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Editar documento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, #f4f7fb 0%, #eaf2ff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .card-custom {
            width: min(900px, 100%);
            border: 0;
            border-radius: 1.25rem;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.12);
        }

        .card-header-custom {
            background: linear-gradient(90deg, #0d6efd 0%, #0b5ed7 100%);
            color: white;
            border-radius: 1.25rem 1.25rem 0 0 !important;
            padding: 1.25rem 1.5rem;
        }

        .form-control, .form-select {
            border-radius: 0.8rem;
            padding: 0.8rem 1rem;
            border-color: #dfe7f1;
        }

        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
            border-color: #86b7fe;
        }

        textarea.form-control {
            min-height: 180px;
            resize: vertical;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card card-custom">
            <div class="card-header-custom">
                <h1 class="h3 mb-0">Editar documento</h1>
            </div>
            <div class="card-body p-4 p-md-5">
                <form action="" method="POST">
                    <?php if (!empty($idDocumento)): ?>
                        <input type="hidden" name="id_documento" value="<?php echo (int)$idDocumento; ?>">
                    <?php endif; ?>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="titulo" class="form-label fw-semibold">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo isset($datosDocumento['titulo']) ? htmlspecialchars($datosDocumento['titulo']) : ''; ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label for="categoria" class="form-label fw-semibold">Categoría</label>
                            <input type="text" class="form-control" id="categoria" name="categoria" value="<?php echo isset($datosDocumento['categoria']) ? htmlspecialchars($datosDocumento['categoria']) : ''; ?>" required>
                        </div>

                        <div class="col-12">
                            <label for="especialidad" class="form-label fw-semibold">Especialidad</label>
                            <input type="text" class="form-control" id="especialidad" name="especialidad" value="<?php echo isset($datosDocumento['especialidad']) ? htmlspecialchars($datosDocumento['especialidad']) : ''; ?>" required>
                        </div>
                        <div id="paginas-container">
                            <?php if ($resultadoPaginas && $resultadoPaginas->num_rows > 0): ?>
                                <?php while ($pagina = $resultadoPaginas->fetch_assoc()): ?>
                                    <div class="col-12 pagina-item">
                                        <div class="card shadow-sm border-0">
                                            <div class="card-header bg-light">
                                                <strong>Página <?php echo (int)$pagina['numero_pagina']; ?></strong>
                                            </div>
                                            <div class="card-body">
                                                <textarea
                                                    class="form-control"
                                                    name="contenido[]"
                                                    rows="6"
                                                ><?php echo htmlspecialchars($pagina['contenido']); ?></textarea>

                                                <input
                                                    type="hidden"
                                                    name="id_pagina[]"
                                                    value="<?php echo (int)$pagina['id_pagina']; ?>"
                                                >
                                                <a
                                                href="borrar.php?id_pagina=<?php echo (int)$pagina['id_pagina']; ?>"
                                                class="btn btn-outline-danger mt-3"
                                                aria-label="Eliminar página"
                                                onclick="return confirm('¿Seguro que deseas eliminar esta página?');"
                                                >
                                                    <i class="fa-solid fa-trash"></i>
                                                    <span class="d-none d-md-inline ms-1">Eliminar</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <div class="col-12" id="alerta-vacio">
                                    <div class="alert alert-warning mb-0">No hay páginas registradas para este documento.</div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                            <div class="d-flex gap-2">
                                <button type="button" id="agregar-pagina" class="btn btn-outline-primary">
                                    <i class="fa-solid fa-plus"></i> Agregar página
                                </button>
                                <a href="enfermero-menu.php" class="btn btn-outline-secondary">Volver</a>
                            </div>
                            <button type="submit" class="btn btn-primary px-4">Guardar cambios</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <template id="pagina-template">
        <div class="col-12 pagina-item">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light">
                    <strong class="numero-pagina">Página 1</strong>
                </div>
                <div class="card-body">
                    <textarea class="form-control" name="contenido[]" rows="6" placeholder="Escribe el contenido de la página..."></textarea>
                    <input type="hidden" name="id_pagina[]" value="">
                    <button type="button" class="btn btn-outline-danger mt-3 eliminar-pagina">
                        <i class="fa-solid fa-trash"></i>
                        <span class="d-none d-md-inline ms-1">Eliminar</span>
                    </button>
                </div>
            </div>
        </div>
    </template>

    <script>
        const paginasContainer = document.getElementById('paginas-container');
        const agregarPaginaBtn = document.getElementById('agregar-pagina');
        const alertaVacio = document.getElementById('alerta-vacio');
        const paginaTemplate = document.getElementById('pagina-template');

        function actualizarNumeracion() {
            const items = paginasContainer.querySelectorAll('.pagina-item');
            items.forEach((item, index) => {
                const numero = item.querySelector('.numero-pagina');
                if (numero) {
                    numero.textContent = 'Página ' + (index + 1);
                }
            });
        }

        if (agregarPaginaBtn) {
            agregarPaginaBtn.addEventListener('click', function () {
                if (alertaVacio) {
                    alertaVacio.remove();
                }

                const clone = paginaTemplate.content.cloneNode(true);
                const item = clone.querySelector('.pagina-item');
                const items = paginasContainer.querySelectorAll('.pagina-item');
                const numero = items.length + 1;

                item.querySelector('.numero-pagina').textContent = 'Página ' + numero;
                paginasContainer.appendChild(clone);
            });
        }

        if (paginasContainer) {
            paginasContainer.addEventListener('click', function (event) {
                const boton = event.target.closest('.eliminar-pagina');
                if (!boton) return;

                const item = boton.closest('.pagina-item');
                if (!item) return;

                item.remove();
                actualizarNumeracion();

                const remaining = paginasContainer.querySelectorAll('.pagina-item').length;
                if (remaining === 0) {
                    const alerta = document.createElement('div');
                    alerta.className = 'col-12';
                    alerta.id = 'alerta-vacio';
                    alerta.innerHTML = '<div class="alert alert-warning mb-0">No hay páginas registradas para este documento.</div>';
                    paginasContainer.appendChild(alerta);
                }
            });
        }
    </script>
</body>
</html>