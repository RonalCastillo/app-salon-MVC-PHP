<h1 class="nombre-pagina">Actualizar Servicio</h1>
<h1 class="descripcion-pagina">Modifica los valores de los servicios</h1>

<?php
include_once __DIR__ . '/../templates/barra.php';
include_once __DIR__ . '/../templates/alertas.php';

?>
<form class="formulario" method="POST">

    <?php
    include_once __DIR__ . '/formulario.php';

    ?>

    <input type="submit" class="boton" value="Actualizar Servicio">

</form>