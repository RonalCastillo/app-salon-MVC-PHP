<h1 class="nombre-pagina">login</h1>
<p class="descripcion-pagina">Inicia Sesion con tus datos</p>


<?php
include_once __DIR__ . "/../templates/alertas.php";

?>

<form class="formulario" method="POST" action="/">

    <div class="campo">
        <label for="email">Email</label>

        <input type="email" id="email" placeholder="Tu email" name="email" />
    </div>

    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" placeholder="tu password" name="password">
    </div>

    <input type="submit" class="boton" value="Iniciar sesion">
</form>

<div class="acciones">
    <a href="/crear-cuenta">Aun no tienes una? crear una cuenta</a>
    <a href="/olvide">olvidaste tu password?</a>
</div>