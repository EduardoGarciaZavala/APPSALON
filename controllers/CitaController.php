<?php
namespace Controllers;
use MVC\Router;

class CitaController
{
    public function __construct()
    {
        
    }
    public static function index (Router $router)
    {

        iniciarSesion();
        $nombre = $_SESSION[ "nombre" ];
        isAut();
        $router->render( "cita/index",
        [
            "nombre" => $_SESSION[ "nombre" ],
            "id" => $_SESSION[ "id" ]
        ]);

    }
}