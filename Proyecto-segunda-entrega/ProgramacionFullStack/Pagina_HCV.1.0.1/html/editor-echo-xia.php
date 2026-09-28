<?php

require_once('conect-bd.php');

?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Editar documento</title>
    <style>
      :root { --azul: #1a73e8; --azul-claro: #e8f0fe; --texto: #202124; --secundario: #5f6368; --borde: #dadce0; --lienzo: #f1f3f4; }
      * { box-sizing: border-box; }
      body { margin: 0; min-height: 100vh; color: var(--texto); font-family: Arial, Helvetica, sans-serif; background: var(--lienzo); }
      button, select, input { font: inherit; }
      .barra-superior { display: flex; align-items: center; gap: 13px; height: 65px; padding: 8px 18px; background: #fff; }
      .marca-documento { display: grid; place-items: center; flex: 0 0 37px; height: 46px; color: #fff; font-weight: bold; font-size: 1.1rem; background: #4285f4; border-radius: 3px 3px 7px 3px; box-shadow: inset -6px -6px 0 rgba(0, 0, 0, .08); }
      .datos-documento { min-width: 170px; }
      .titulo-documento { width: min(300px, 38vw); padding: 3px 7px; color: var(--texto); font-size: 1.13rem; border: 1px solid transparent; border-radius: 4px; }
      .titulo-documento:hover, .titulo-documento:focus { border-color: var(--borde); outline: none; }
      .estado-guardado { display: block; margin: 3px 0 0 7px; color: var(--secundario); font-size: .75rem; }
      .acciones-superiores { display: flex; align-items: center; gap: 8px; margin-left: auto; }
      .icono, .boton-compartir { height: 36px; border: 0; border-radius: 4px; cursor: pointer; }
      .icono { min-width: 36px; color: #4d5156; font-size: 1.1rem; background: transparent; }
      .icono:hover { background: #f1f3f4; }
      .boton-compartir { padding: 0 17px; color: #fff; font-weight: bold; background: var(--azul); }
      .boton-compartir:hover { background: #1765cc; }
      .avatar { display: grid; place-items: center; width: 32px; height: 32px; color: #fff; font-size: .8rem; font-weight: bold; background: #7b1fa2; border-radius: 50%; }
      .menu { display: flex; align-items: center; gap: 2px; height: 36px; padding: 0 17px; background: #fff; border-bottom: 1px solid var(--borde); }
      .menu button { padding: 6px 8px; color: #202124; font-size: .86rem; background: none; border: 0; border-radius: 3px; cursor: pointer; }
      .menu button:hover { background: #f1f3f4; }
      .barra-herramientas { display: flex; align-items: center; gap: 3px; min-height: 52px; padding: 8px 18px; background: #fff; border-bottom: 1px solid var(--borde); }
      .grupo { display: flex; align-items: center; gap: 2px; padding: 0 7px; border-right: 1px solid var(--borde); }
      .grupo:last-child { border-right: 0; }
      .herramienta { display: grid; place-items: center; min-width: 31px; height: 31px; padding: 0 6px; color: #3c4043; background: #fff; border: 0; border-radius: 3px; cursor: pointer; }
      .herramienta:hover, .herramienta:focus-visible { background: #f1f3f4; outline: none; }
      .herramienta strong { font-size: 1.05rem; } .herramienta em { font-family: Georgia, serif; font-size: 1.2rem; } .herramienta u { font-size: 1.05rem; }
      .herramienta.activa { color: #174ea6; background: var(--azul-claro); }
      .selector { height: 30px; padding: 0 4px; color: #3c4043; background: #fff; border: 1px solid transparent; border-radius: 3px; cursor: pointer; }
      .selector:hover { border-color: var(--borde); }
      .fuente { width: 130px; } .tamano { width: 53px; }
      .color { position: relative; width: 30px; } .color::after { position: absolute; right: 6px; bottom: 3px; left: 6px; height: 3px; content: ''; background: #1a73e8; }
      .regla { display: flex; width: min(816px, calc(100% - 40px)); height: 24px; margin: 0 auto; color: #777; font-size: .64rem; overflow: hidden; background: repeating-linear-gradient(90deg, transparent 0, transparent 39px, #c8cdd0 40px); }
      .regla span { width: 40px; padding: 9px 0 0 2px; }
      .area-trabajo { display: flex; min-height: calc(100vh - 177px); background: var(--lienzo); }
      .esquema { position: sticky; top: 0; align-self: flex-start; width: 220px; max-height: calc(100vh - 177px); padding: 26px 16px; overflow: auto; background: #fff; border-right: 1px solid var(--borde); }
      .esquema h2 { margin: 0 0 15px; font-size: .92rem; font-weight: normal; }
      .esquema-vacio { color: #6f7275; font-size: .8rem; line-height: 1.45; }
      .esquema button { display: block; width: 100%; padding: 7px 8px; overflow: hidden; color: #3c4043; font-size: .82rem; text-align: left; text-overflow: ellipsis; white-space: nowrap; background: transparent; border: 0; border-radius: 3px; cursor: pointer; }
      .esquema button:hover { background: #f1f3f4; } .esquema .subtitulo { padding-left: 20px; }
      .lienzo { flex: 1; padding: 24px 16px 100px; overflow: auto; }
      .hoja { position: relative; width: min(794px, 100%); min-height: 1028px; margin: 0 auto 24px; padding: 72px 76px; background: #fff; box-shadow: 0 1px 3px rgba(60, 64, 67, .30), 0 4px 12px rgba(60, 64, 67, .15); }
      .pagina-contenido { min-height: 880px; font-family: Arial, sans-serif; font-size: 11pt; line-height: 1.5; border: 1px solid transparent; outline: none; }
      .pagina-contenido:empty::before { color: #9aa0a6; content: attr(data-placeholder); pointer-events: none; }
      .pagina-contenido:focus { border-color: #d2e3fc; }
      .pagina-contenido h2 { margin: 1.35em 0 .5em; font-size: 1.4em; } .pagina-contenido h3 { margin: 1.2em 0 .45em; font-size: 1.16em; }
      .numero-pagina { position: absolute; right: 76px; bottom: 35px; color: #80868b; font-size: .76rem; }
      .pie { position: fixed; right: 15px; bottom: 12px; z-index: 5; display: flex; gap: 9px; align-items: center; padding: 7px 11px; color: #5f6368; font-size: .77rem; background: rgba(255, 255, 255, .94); border: 1px solid var(--borde); border-radius: 16px; box-shadow: 0 1px 3px rgba(60,64,67,.18); }
      .pie button { color: var(--azul); background: transparent; border: 0; cursor: pointer; }
      @media (max-width: 830px) { .esquema { display: none; } .lienzo { padding-left: 10px; padding-right: 10px; } .hoja { padding: 52px 48px; } .numero-pagina { right: 48px; } }
      @media (max-width: 600px) { .barra-superior { height: auto; padding: 8px 10px; } .marca-documento, .icono, .avatar { display: none; } .titulo-documento { width: 210px; } .boton-compartir { padding: 0 10px; font-size: .8rem; } .menu { padding: 0 8px; overflow-x: auto; } .barra-herramientas { padding: 7px 8px; overflow-x: auto; } .grupo { padding: 0 4px; } .fuente { width: 105px; } .regla { display: none; } .lienzo { padding: 14px 5px 70px; } .hoja { min-height: 720px; padding: 38px 24px; } .pagina-contenido { min-height: 620px; } .numero-pagina { right: 24px; bottom: 22px; } }
    </style>
  </head>
  <body>
    <main>
      <header class="barra-superior">
        <div class="datos-documento"><input id="tituloDocumento" class="titulo-documento" type="text" value="Documento sin t&iacute;tulo" aria-label="T&iacute;tulo del documento" /><span id="estadoGuardado" class="estado-guardado">Guardado localmente</span></div>
        <div class="acciones-superiores"><button class="icono" id="favorito" title="Marcar como favorito" aria-label="Marcar como favorito">&#9734;</button><button class="icono" id="guardar" title="Guardar borrador" aria-label="Guardar borrador">&#128190;</button></div>
      </header>
      <nav class="barra-herramientas" aria-label="Herramientas de formato">
        <div class="grupo"><button class="herramienta" type="button" data-comando="undo" title="Deshacer" aria-label="Deshacer">&#8630;</button><button class="herramienta" type="button" data-comando="redo" title="Rehacer" aria-label="Rehacer">&#8631;</button></div>
        <div class="grupo"><select id="estilo" class="selector" aria-label="Estilo de p&aacute;rrafo"><option value="p">Texto normal</option><option value="h2">T&iacute;tulo</option><option value="h3">Subt&iacute;tulo</option></select></div>
        <div class="grupo"><select id="fuente" class="selector fuente" aria-label="Fuente"><option value="Arial">Arial</option><option value="Georgia">Georgia</option><option value="Verdana">Verdana</option><option value="Courier New">Courier New</option></select><select id="tamano" class="selector tamano" aria-label="Tama&ntilde;o de letra"><option value="3">11</option><option value="2">10</option><option value="4">12</option><option value="5">14</option><option value="6">18</option></select></div>
        <div class="grupo"><button class="herramienta" type="button" data-comando="bold" title="Negrita" aria-label="Negrita"><strong>B</strong></button><button class="herramienta" type="button" data-comando="italic" title="Cursiva" aria-label="Cursiva"><em>I</em></button><button class="herramienta" type="button" data-comando="underline" title="Subrayado" aria-label="Subrayado"><u>U</u></button><button class="herramienta color" type="button" data-comando="foreColor" data-valor="#1a73e8" title="Color de texto" aria-label="Color de texto">A</button></div>
        <div class="grupo"><button class="herramienta" type="button" data-comando="justifyLeft" title="Alinear a la izquierda" aria-label="Alinear a la izquierda">&#9776;</button><button class="herramienta" type="button" data-comando="justifyCenter" title="Centrar" aria-label="Centrar">&#8801;</button><button class="herramienta" type="button" data-comando="justifyRight" title="Alinear a la derecha" aria-label="Alinear a la derecha">&#9776;</button></div>
        <div class="grupo"><button class="herramienta" type="button" data-comando="insertUnorderedList" title="Lista con vi&ntilde;etas" aria-label="Lista con vi&ntilde;etas">&#8226; &#8801;</button><button class="herramienta" type="button" data-comando="insertOrderedList" title="Lista numerada" aria-label="Lista numerada">1. &#8801;</button><button class="herramienta" id="nuevaPagina" type="button" title="Nueva p&aacute;gina" aria-label="Nueva p&aacute;gina">&#43; P&aacute;g.</button></div>
      </nav>
      <div class="regla" aria-hidden="true"><span>0</span><span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span><span>9</span><span>10</span><span>11</span><span>12</span><span>13</span><span>14</span><span>15</span><span>16</span><span>17</span><span>18</span></div>
      <div class="area-trabajo">
        <aside class="esquema"><h2>Esquema</h2><div id="listaEsquema"><p class="esquema-vacio">Los t&iacute;tulos que agregues aparecer&aacute;n aqu&iacute;.</p></div></aside>
        <section id="documento" class="lienzo" aria-label="P&aacute;ginas del documento"></section>
      </div>
      <footer class="pie"><span id="estado">0 palabras &middot; 1 p&aacute;gina</span><button id="nuevaPaginaPie" type="button">+ Nueva p&aacute;gina</button></footer>
    </main>
    <script>
      const documento = document.getElementById('documento');
      const titulo = document.getElementById('tituloDocumento');
      const estado = document.getElementById('estado');
      const estadoGuardado = document.getElementById('estadoGuardado');
      const claveBorrador = 'borrador-documento-enfermero';
      const limiteCaracteres = 1800;
      let editorActivo = null;

      function crearPagina(contenido = '', enfocar = false) {
        const numero = documento.querySelectorAll('.hoja').length + 1;
        const hoja = document.createElement('article');
        hoja.className = 'hoja';
        hoja.innerHTML = `<div class="pagina-contenido" contenteditable="true" role="textbox" aria-multiline="true" data-placeholder="Escrib&iacute; el contenido de la p&aacute;gina ${numero}...">${contenido}</div><span class="numero-pagina">P&aacute;gina ${numero}</span>`;
        documento.appendChild(hoja);
        const area = hoja.querySelector('.pagina-contenido');
        configurarPagina(area);
        if (enfocar) { area.focus(); hoja.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
        actualizarEstado();
        return area;
      }
      function configurarPagina(area) {
        area.addEventListener('focus', () => { editorActivo = area; });
        area.addEventListener('input', () => {
          editorActivo = area; actualizarEstado('Cambios sin guardar'); actualizarEsquema();
          if (area.closest('.hoja') === documento.lastElementChild && area.innerText.length >= limiteCaracteres) crearPagina('', true);
        });
      }
      function formato(comando, valor = null) { const area = editorActivo || documento.querySelector('.pagina-contenido'); if (!area) return; area.focus(); document.execCommand(comando, false, valor); actualizarEstado('Cambios sin guardar'); actualizarEsquema(); }
      document.querySelectorAll('[data-comando]').forEach((boton) => { boton.addEventListener('mousedown', (evento) => evento.preventDefault()); boton.addEventListener('click', () => formato(boton.dataset.comando, boton.dataset.valor || null)); });
      document.getElementById('estilo').addEventListener('change', (evento) => formato('formatBlock', evento.target.value));
      document.getElementById('fuente').addEventListener('change', (evento) => formato('fontName', evento.target.value));
      document.getElementById('tamano').addEventListener('change', (evento) => formato('fontSize', evento.target.value));
      function paginas() { return [...documento.querySelectorAll('.pagina-contenido')]; }
      function actualizarEstado(mensaje = 'Guardado localmente') { const texto = paginas().map((area) => area.innerText.trim()).join(' ').trim(); const palabras = texto ? texto.split(/\s+/).length : 0; const cantidad = paginas().length; estado.textContent = `${palabras} ${palabras === 1 ? 'palabra' : 'palabras'} \u00b7 ${cantidad} ${cantidad === 1 ? 'p\u00e1gina' : 'p\u00e1ginas'}`; estadoGuardado.textContent = mensaje; }
      function actualizarEsquema() { const lista = document.getElementById('listaEsquema'); const encabezados = [...documento.querySelectorAll('h2, h3')].filter((item) => item.innerText.trim()); if (!encabezados.length) { lista.innerHTML = '<p class="esquema-vacio">Los t&iacute;tulos que agregues aparecer&aacute;n aqu&iacute;.</p>'; return; } lista.innerHTML = ''; encabezados.forEach((encabezado) => { const boton = document.createElement('button'); boton.textContent = encabezado.innerText; if (encabezado.tagName === 'H3') boton.className = 'subtitulo'; boton.addEventListener('click', () => encabezado.scrollIntoView({ behavior: 'smooth', block: 'center' })); lista.appendChild(boton); }); }
      function guardarBorrador() { localStorage.setItem(claveBorrador, JSON.stringify({ titulo: titulo.value, paginas: paginas().map((area) => area.innerHTML) })); actualizarEstado('Guardado localmente'); }
      function cargarBorrador() { const borrador = localStorage.getItem(claveBorrador); if (!borrador) return false; try { const datos = JSON.parse(borrador); const hojas = Array.isArray(datos.paginas) ? datos.paginas : [datos.contenido || '']; titulo.value = datos.titulo || 'Documento sin t&iacute;tulo'; hojas.forEach((contenido) => crearPagina(contenido)); return hojas.length > 0; } catch (_) { localStorage.removeItem(claveBorrador); return false; } }
      titulo.addEventListener('input', () => actualizarEstado('Cambios sin guardar'));
      document.getElementById('guardar').addEventListener('click', guardarBorrador);
      document.getElementById('nuevaPagina').addEventListener('click', () => crearPagina('', true));
      document.getElementById('nuevaPaginaPie').addEventListener('click', () => crearPagina('', true));
      document.getElementById('favorito').addEventListener('click', (evento) => { const activo = evento.currentTarget.textContent === '☆'; evento.currentTarget.textContent = activo ? '★' : '☆'; evento.currentTarget.style.color = activo ? '#fbbc04' : ''; });
      document.addEventListener('keydown', (evento) => { if ((evento.ctrlKey || evento.metaKey) && evento.key.toLowerCase() === 's') { evento.preventDefault(); guardarBorrador(); } });
      if (!cargarBorrador()) crearPagina(); actualizarEsquema(); actualizarEstado();
    </script>
  </body>
</html>
