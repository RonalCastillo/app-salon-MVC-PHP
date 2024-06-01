<h1 class="nombre-pagina">Nuevo servicio</h1>
<h1 class="descripcion-pagina">Completa todos los campos</h1>

<?php
include_once __DIR__ . '/../templates/barra.php';
include_once __DIR__ . '/../templates/alertas.php';

?>
<form class="formulario" action="/servicios/crear" method="POST">

    <?php
    include_once __DIR__ . '/formulario.php';

    ?>

    <input type="submit" class="boton" value="Guardar Servicio">

</form>