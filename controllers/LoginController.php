<?php 
namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {
        $auth = new Usuario;
        $alertas = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST")
        {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();

            if (empty($alertas))
            {
                //comprobar que exista usuario
                $usuario = Usuario::where("email",$auth->email);
                if ($usuario)
                {
                    //verificar password
                    $usuario->comprobarPasswordAndVerificado($auth->password);

                    //autenticar el usuario
                    iniciarSesion();
                    $_SESSION["id"] = $usuario->id;
                    $_SESSION["nombre"] = $usuario->nombre . " " . $usuario->apellido;
                    $_SESSION["email"] = $usuario->email;
                    $_SESSION["login"] = true;

                    if ($usuario->admin === "1")
                    {
                        $_SESSION["admin"] = $usuario->admin ?? "null";
                        header("location: /admin");
                    }
                    else
                    {
                        header("location: /cita");
                    }
                }
                else
                {
                    Usuario::setAlerta("error","Usuario Incorrecto");
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render("auth/login",
        [
            "alertas" => $alertas,
            "usuario" => $auth
        ]);
    }

    public static function logout( Router $router )
    {
        iniciarSesion();

        $_SESSION = [];

        header( "location: /" );
    }

    public static function olvide ( Router $router )
    {
        $alertas = [];

        if ( $_SERVER["REQUEST_METHOD"] === "POST" )
        {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();

            if ( empty($alertas) )
            {
                $usuario = Usuario::where( "email" , $auth->email );

                if ( $usuario && $usuario->confirmado === "1")
                {
                    //generear token
                    $usuario->crearToken();
                    $usuario->guardar();
                    $email = new Email( $usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();
                    Usuario::setAlerta( "exito", "Enviamos un correo Para reestablecer tu Password" );
                }
                else
                {
                    Usuario::setAlerta( "error" , "El usuario no esta registrado" );
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render("auth/olvide-password",
        [
            "alertas" => $alertas
        ]);
    }

    public static function recuperar ( Router $router )
    {
        $alertas = [];
        $error = false;

        $token = s($_GET["token"]);
        //Buscar usuario por el token 
        $usuario = Usuario::where( "token", $token );

        if ( empty($usuario) )
        {
            Usuario::setAlerta( "error","Token no valido" );
            $error = true;
        }

        if ( $_SERVER["REQUEST_METHOD"] ==="POST" ) 
        {
            //leer el nuevo password y guardarlo
            $password = new Usuario( $_POST );
    

            if ( empty( $password->validarPassword() ) )
            {
                $usuario->password = null;
                $usuario->password = $password->password;
                $usuario->hashPassword();
                $usuario->token = "null";//resolver el tema de null
                $usuario->guardar();
                Usuario::setAlerta( "exito","El password fue actualizado Correctamente" );
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render( "auth/recuperar-password", 
        [
            "alertas" => $alertas,
            "error" => $error
        ]); 
    }

    public static function crear ( Router $router )
    {
        $alertas = [];
        $usuario = new Usuario;// crear el objeto en memoria vacio
        if( $_SERVER["REQUEST_METHOD"] === "POST" )
        {
            $usuario->sincronizar($_POST);//sincronizar el objeto en memoria con el post
            $alertas = $usuario->validarNuevaCuenta();

            //revisar que alertas este vacio
            if ( empty($alertas) )
            {
                $resultado =$usuario->existeUsuario();

                if ($resultado->num_rows)
                {
                    $alertas = Usuario::getAlertas();
                }
                else
                {
                    //hashear password
                    $usuario->hashPassword();
                    //generar un token unico 
                    $usuario->crearToken();

                    $email = new Email( $usuario->email, $usuario->nombre, $usuario->token );
                    $email->enviarConfirmacion();

                    //crear el usuario
                    $resultado = $usuario->guardar();

                    if ( $resultado )
                    {
                        header( "location: /mensaje" );   
                    }
                }
            }
        }

        $router->render( "auth/crear-cuenta",
        [
            "usuario" => $usuario,
            "alertas" => $alertas
        ]);
    }

    public static function mensaje ( Router $router )
    {
        $router->render("auth/mensaje");
    }

    public static function confirmar ( Router $router )
    {
        $alertas = [];
        $token = s($_GET["token"]);
        $usuario = Usuario::where("token",$token);

        if (empty($usuario))
        {
            //mostrar mensaje de error
            Usuario::setAlerta("error", "Token No Valido");
        }
        else{
            //modificar a usario confirmado
            $usuario->confirmado = "1";
            $usuario->token = "";// resolver para camibarlo a null y no string 
            $usuario->guardar();
            Usuario::setAlerta("exito", "Cuenta confirmada");  
        }

        $alertas = Usuario::getAlertas();

        $router->render("auth/confirmar-cuenta",
        [
            "alertas" => $alertas
        ]);
    }
}