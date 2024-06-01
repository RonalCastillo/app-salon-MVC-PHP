<h1 class="nombre-pagina">Olvide Password</h1>
<p class="descripcion-pagina">Restablece tu password</p>


<?php
include_once __DIR__ . "/../templates/alertas.php";

?>
<form class="formulario" action="/olvide" method="POST">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Tu email">
    </div>

    <input class="boton" type="submit" value="Enviar Instrucciones">


    <div class="acciones">
        <a href="/"> Iniciar sesion</a>
        <a href="/crear-cuenta">Crear cuenta</a>
    </div>
</form>