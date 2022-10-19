<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function esUltimo (  $actual,  $proximo ) : bool
{
    if ( $actual !== $proximo)
    {
        return true;
    }
    return false;
}

//funcion que revisa que el usuario este autenticado
function isAut(): void
{
    if ( !isset( $_SESSION[ "login" ] ) )
    {
        header( "location: /" );
    }
}

function isAdmin() : void
{
    if( !isset( $_SESSION["admin"] ) )
    {
        header( "location: /" );
    }
}

function iniciarSesion()
{
    if ( !isset( $_SESSION ) )
    {
        session_start();
    }
}