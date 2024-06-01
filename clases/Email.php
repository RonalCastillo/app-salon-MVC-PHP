<?php

namespace Clases;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    public $email;
    public $nombre;
    public $token;
    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public final function enviarConfirmacion()
    {

        ///crear el objeto de emial

        $mail = new PHPMailer();
        $mail->isSMTP();

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@salon.com');
        $mail->addAddress('cuentas@salon.com', 'cuentas@salon.com');

        $mail->Subject = 'Confirma tu cuenta';
        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = "UTF-8";

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has Creado tu Cuenta en App Salon, solo debes confirmala presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['APP_URL'] . "/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;

        // Enviar el Email
        $mail->send();
    }

    public function enviarInstrucciones()
    {

        ///crear el objeto de emial

        $mail = new PHPMailer();
        $mail->isSMTP();

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];


        $mail->setFrom('cuentas@salon.com');
        $mail->addAddress('cuentas@salon.com', 'cuentas@salon.com');

        $mail->Subject = 'Restablece tu password';
        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = "UTF-8";

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong>Has solicitado restablecer tu password, sigue el siguiente enlace par realizarlo</p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['APP_URL'] . "/recuperar?token=" . $this->token . "'>Restablecer Cuenta</a></p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;

        // Enviar el Email
        $mail->send();
    }
}
