<h1 class="nombre-pagina">Servicios</h1>
<h1 class="descripcion-pagina">Administracion de Servicios</h1>

<?php
include_once __DIR__ . '/../templates/barra.php';

?>

<ul class="servicios">

    <?php foreach ($servicios as $servicio) { ?>
    <li>

        <p>Nombre: <span><?php echo $servicio->nombre ?></span></p>
        <p>Precio: <span>S/ <?php echo $servicio->precio ?></span></p>
    </li>

    <div class="acciones">

        <a class="boton" href="/servicios/actualizar?id=<?php echo $servicio->id; ?>">Actualizar</a>

        <form action="/servicios/eliminar" method="POST">

            <input type="hidden" name="id" value="<?php echo $servicio->id; ?>">

            <input type="submit" class="boton-eliminar" value="Borrar">
        </form>
    </div>

    <?php   } ?>

</ul>