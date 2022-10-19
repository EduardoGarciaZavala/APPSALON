<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente formulario para crear una cuenta</p>
<form action="/crear-cuenta" class="formulario" method="POST">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input name="nombre" id="nombre" type="text" placeholder="Tu Nombre" value="<?= s($usuario->nombre) ?>">
    </div>
    <div class="campo">
        <label for="apellido">Apellido</label>
        <input name="apellido" id="apellido" type="text" placeholder="Tu Apellido" value="<?= s($usuario->apellido) ?>">
    </div>
    <div class="campo">
        <label for="telefono">Teléfono</label>
        <input name="telefono" id="telefono" type="tel" placeholder="Tu Teléfono" value="<?= s($usuario->telefono) ?>">
    </div>
    <div class="campo">
        <label for="email">E-mail</label>
        <input name="email" id="email" type="email" placeholder="Tu Correo" value="<?= s($usuario->email) ?>">
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input name="password" id="password" type="password" placeholder="Password" value="">
    </div>

    <input class="boton" type="submit" value="Crear Cuenta">
    <?php include __DIR__ . "/../templates/alertas.php"; ?>
</form>
<div class="acciones">
    <a href="/">¿ Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/olvide">¿Olvidaste tu password?</a>
</div>