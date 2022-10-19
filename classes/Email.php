<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{

    public $email;
    public $nombre;
    public $token;

    public function __construct(string $email, string $nombre, string $token)
    {
        $this->email = $email;
        $this->token = $token;
        $this->nombre = $nombre;
    }

    public function enviarConfirmacion()
    {
        //crear el objeto de email
        $mail = new PHPMailer(true);
        $mail->isSMTP(); 

        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '95a87001a1bc7d';
        $mail->Password = '8af8b6a97afb00';

        $mail->setFrom("cuentas@appsalon.com", "appsalon");
        $mail->addAddress("cuenta@appsalon.com");
        $mail->Subject  = "Confirma tu cuenta";

        //set HTML
        $mail->isHTML(true);
        $mail->CharSet = "UTF-8";

        $contenido = "<thml>";
        $contenido .= "<p><strong>Hola " . $this->nombre . " </strong>Has creado tu cuenta en appsalon,Solo debes de confirmar tu cuenta en el siguinte enlace</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/confirmar-cuenta?token=".$this->token."'>Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si no soliciatastes esta cuetna, Puedes ignorar el mensaje</p>";
        $contenido .= "</thml>";

        $mail->Body = $contenido;

        //enviar mail
        $mail->send();
    }

    public function enviarInstrucciones()
    {
        //crear el objeto de email
        $mail = new PHPMailer(true);
        $mail->isSMTP(); 

        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '95a87001a1bc7d';
        $mail->Password = '8af8b6a97afb00';

        $mail->setFrom("cuentas@appsalon.com", "appsalon");
        $mail->addAddress("cuenta@appsalon.com");
        $mail->Subject  = "Reestablece tu Password";

        //set HTML
        $mail->isHTML(true);
        $mail->CharSet = "UTF-8";

        $contenido = "<thml>";
        $contenido .= "<p><strong>Hola " . $this->nombre . " </strong>Has solicitado reestablecer tu password, sigue el siguiente enlace para hacelo.</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/recuperar?token=".$this->token."'>Reestablecer Password</a></p>";
        $contenido .= "<p>Si no soliciatastes esta cuetna, Puedes ignorar el mensaje</p>";
        $contenido .= "</thml>";

        $mail->Body = $contenido;

        //enviar mail
        $mail->send();

    }
}