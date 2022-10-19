<h1 class="nombre-pagina">Olvide Password</h1>
<p class="descripcion-pagina">Reestablece tu password escrbiendo tu email a continuacion</p>
<form action="/olvide" class="formulario" method="POST">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Tu Correo">
    </div>
    <input type="submit" class="boton" value="Reestablecer Password">
</form>

<?php include __DIR__ . "/../templates/alertas.php" ?>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesion</a>
    <a href="/crear-cuenta">¿Aún no tines una cuenta? Crea una</a>
</div>