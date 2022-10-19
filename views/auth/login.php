<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesión con tus datos</p>

<form action="/" class="formulario" method="POST">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Tu Correo" value="<?=s($usuario->email)?>">
    </div>
    <div class="campo">
    <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Tu Password">
    </div>
    <input type="submit" class="boton" value="Iniciar Sesion">
</form>

<?php include __DIR__ . "/../templates/alertas.php"; ?>

<div class="acciones">
    <a href="/crear-cuenta">¿Aún no tines una cuenta? Crea una</a>
    <a href="/olvide">¿Olvidaste tu password?</a>
</div>