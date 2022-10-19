<?php
namespace Model;

class Usuario extends ActiveRecord
{
    //base de datos 
    protected static $tabla = "usuarios";
    protected static $columnasDB = ["id","nombre","apellido","email","telefono","password","admin","confirmado","token"];
    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $telefono;
    public $password;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct(array $args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? "";
        $this->apellido = $args["apellido"] ?? "";
        $this->email = $args["email"] ?? "";
        $this->telefono = $args["telefono"] ?? "";
        $this->password = $args["password"] ?? "";
        $this->admin = $args["admin"] ?? "0";
        $this->confirmado = $args["confirmado"] ?? "0";
        $this->token = $args["token"] ?? "";
    }

    //mensajes de validacion 
    public function validarNuevaCuenta() : array
    {
        if (!$this->nombre)
        {
            self::$alertas ["error"][] = "El nombre del Cliente est Obligatorio";
        }

        if (!$this->apellido)
        {
            self::$alertas ["error"][] = "El apellido del Cliente est Obligatorio";
        }

        if (!$this->email)
        {
            self::$alertas ["error"][] = "El email del Cliente est Obligatorio";
        }

        if (!$this->telefono)
        {
            self::$alertas ["error"][] = "El telefono del Cliente est Obligatorio";
        }

        if (!$this->password)
        {
            self::$alertas ["error"][] = "El password del Cliente est Obligatorio";
        }

        if (strlen($this->password) < 6)
        {
            self::$alertas ["error"][] = "El password debe contener al menos 6 caracteres";
        }

        return self::$alertas;
    }
    //mejorar esta funcion para no duplicar codigo 
    public function validarLogin()
    {
        if (!$this->email)
        {
            self::$alertas ["error"][] = "El email del Cliente est Obligatorio";
        }

        if (!$this->password)
        {
            self::$alertas ["error"][] = "El password del Cliente est Obligatorio";
        }

        return self::$alertas;
    }

    public function validarEmail()
    {
        if (!$this->email)
        {
            self::$alertas ["error"][] = "El email del Cliente est Obligatorio";
        } 

        return self::$alertas;
    }

    public function validarPassword()
    {
        if (!$this->password)
        {
            self::$alertas ["error"][] = "El password del Cliente est Obligatorio";
        }

        if (strlen($this->password) < 6)
        {
            self::$alertas ["error"][] = "El password debe contener al menos 6 caracteres";
        }

        return self::$alertas;
    }

    //revisa si el usuario ya existe
    public function existeUsuario() : object
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" .$this->email. "' LIMIT 1;";
        $resultado = self::$db->query($query);

        if ($resultado->num_rows)
        {
            self::$alertas["error"][] = "El usuario ya esta registrado";
        }

        return $resultado;
    }

    public function hashPassword()
    {
        // hashear pasword
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken()
    {
        //genera token
       $this->token = uniqid();
    }

    public function comprobarPasswordAndVerificado($password)
    {
        $resultado = password_verify($password, $this->password);

        if(!$resultado || !$this->confirmado)
        {
            self::$alertas["error"][] = "Password incorrecto o tu cuenta no ha sido confirmada";
        }
        else
        {
            return true;
        }
    }
}