<h1 class="nombre-pagina" >Panel de Administracion</h1>
<?php

use Model\Cita;

 include_once __DIR__ . "/../templates/barra.php" ;?>
<h2>Buscar Citas</h2>
<div class="busqueda" >
    <form class="formulario" action="">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input type="date"  id="fecha" name="fecha" value="<?=$fecha;?>" > 
        </div>
    </form>
</div>

<div class="citas-admin">
    <ul class="citas" >
    <?php
        if( count( $citas ) === 0 )
        {
            echo "<h2>No Hay Citas en esta Fecha</h2>";
        }
        // ni preguntes que hace esto porque a duras penas se como lo hice 
        $idCita = 0;
        foreach ( $citas as $key => $cita ){
            if($idCita !== $cita->id)
            {
                $total = 0;?>
                <h3>Datos</h3>
                <li>
                    <p>ID: <span><?= $cita->id;?></span></p>
                    <p>Hora: <span><?= $cita->hora;?></span></p>
                    <p>Cliente: <span><?= $cita->cliente;?></span></p>
                    <p>Email: <span><?= $cita->email;?></span></p>
                    <p>Telefono: <span><?= $cita->telefono;?></span></p>
                </li>
                <h3>Servicios</h3>
            <?php $idCita = $cita->id; }; // fin if
                $total += $cita->precio;                
            ?>
            <p class="servicio" ><?= $cita->servicio . " " . $cita->precio;?></p>
            <?php
            $actual = $cita->id;
            $proximo = $citas[ $key + 1 ]->id ?? 0;
            if ( esUltimo( $actual, $proximo ) )
            {
            ?>
                <p class="total">Total: <span><?=$total?></span> </p>
                <form action="/api/eliminar" method="POST" >
                    <input type="hidden" name="id" value="<?=$cita->id;?>">
                    <input type="submit" class="boton-eliminar" value="Eliminar">
                </form>
            <?php
            }
            ?>
    <?php };// fin for ?>
    </ul>
</div>
<script></script>
<?php
$script = "<script src='build/js/buscador.js' ></script>";
?>