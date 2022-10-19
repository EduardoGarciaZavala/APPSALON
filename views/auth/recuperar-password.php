<h1 class="nombre-pagina">Reestablece tu Password</h1>

<?php if (!$error): ?>

<p class="descripcion-pagina">Coloca tu nuevo Password</p>
<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Tu nuevo password">
    </div>
    <input type="submit" value="Guardar Nuevo Password" class="boton">
</form>

<?php endif; include __DIR__ . "/../templates/alertas.php"; ?>

<div class="acciones">
    <a href="/">Iniciar Sesion</a>
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? Optener una cuenta</a>
</div>