<?php

namespace Model;

class Cita extends ActiveRecord
{
    // configuracion de la base de datos
    protected static $tabla = "citas";
    protected static $columnasDB = [ "id", "fecha", "hora", "usuarioId" ];

    public $id;
    public $fecha;
    public $hora;
    public $usuarioId;

    public function __construct( array $args = [] )
    {
        $this->id = $args[ "id" ] ?? null;
        $this->fecha = $args[ "fecha" ] ?? "";
        $this->hora = $args[ "hora" ] ?? "";
        $this->usuarioId = $args[ "usuarioId" ] ?? "";
    }
}