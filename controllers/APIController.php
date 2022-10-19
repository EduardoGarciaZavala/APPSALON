<?php

namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class APIController
{
    public static function index ()
    {
        $servicios = Servicio::all();

        echo json_encode($servicios);
    }

    public static function guardar ()
    {
        //almacena la cita y debuelve al ID
        $cita = new Cita( $_POST );
        $resultado = $cita->guardar();

        $id = $resultado[ "id" ];

        //almacena las citas y el servicio

        $idServicios = explode( ",", $_POST[ "servicios" ] );

        //almacena los servicios con el id de la cita
        foreach( $idServicios as $idServicio )
        {
            $idServicio = intval($idServicio);
            $args =
            [
                "citaId" => $id,
                "serviciId" => $idServicio
            ];

            $citaServicio = new CitaServicio( $args );
            $citaServicio->guardar();
        }

        echo json_encode( ["resultado" => $resultado] );
    }

    public static function eliminar()
    {
        if( $_SERVER["REQUEST_METHOD"] === "POST" )
        {
            $id = $_POST["id"];

            $cita = Cita::find( $id );
            $cita->eliminar();
            header( "location:" . $_SERVER["HTTP_REFERER"] );
        }
    }
}