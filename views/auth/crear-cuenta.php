<h1 class="nombre-pagina">crear cuenta</h1>

<p class="descripcion-pagina">Llena el siguiente formulario para crear tu cuenta</p>


<?php
include_once __DIR__ . "/../templates/alertas.php";

?>

<form class="formulario" action="crear-cuenta" method="POST">

    <div class="campo">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" value="<?php echo s($usuario->nombre); ?>">
    </div>
    <div class="campo">
        <label for="apellido">Apellido</label>
        <input type="text" id="apellido" name="apellido" placeholder="Tu apellido"
            value="<?php echo s($usuario->apellido); ?>">
    </div>
    <div class="campo">
        <?php

        //toma la fecha actual y le resta dos dias 
        $nueva_fecha = date('Y-m-d', strtotime('-1 days'));
        ?>
        <label for="fecha_nacimiento">Fecha de Nacimiento</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" min="1900-01-01"
            max="<?php echo $nueva_fecha; ?>" value="<?php echo s($usuario->fecha_nacimiento); ?>">
    </div>
    <div class="campo">
        <label for="telefono">Telefono</label>
        <input type="tel" id="telefono" name="telefono" placeholder="Tu telefono"
            value="<?php echo s($usuario->telefono); ?>">
    </div>
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Tu email" value="<?php echo s($usuario->email); ?>">
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Tu password">
    </div>

    <input class="boton" type="submit" value="Crear cuenta">
    <div class="acciones">
        <a href="/">Ya tienes una cuenta? Iniciar sesion</a>
        <a href="/olvide">olvidaste tu password?</a>
    </div>
</form>