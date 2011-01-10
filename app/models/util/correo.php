<?php

/**
 * KBlog - KumbiaPHP Blog
 * PHP version 5
 * LICENSE
 *
 * This source file is subject to the GNU/GPL that is bundled
 * with this package in the file docs/LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to deivinsontejeda@gmail.com so we can send you a copy immediately.
 *
 * @author Deivinson Tejeda <deivinsontejeda@gmail.com>
 */
class Correo {    
    
    public static function send($para_correo, $para_nombre, $asunto, $cuerpo, $de_correo=null, $de_nombre=null) {
        //Carga las librería PHPMailer
        Load::lib('phpmailer');        
        //instancia de PHPMailer
        $mail = new PHPMailer(true);        

        $mail->IsSMTP();
        $mail->SMTPAuth = true; // enable SMTP authentication
        $mail->SMTPSecure = 'ssl'; // sets the prefix to the servier
        $mail->Host = Config::get('config.correo.host');
        $mail->Port = Config::get('config.correo.port');
        $mail->Username = Config::get('config.correo.username');
        $mail->Password = Config::get('config.correo.password');
        
        if($de_correo != null && $de_nombre != null){
            $mail->AddReplyTo($de_correo, $de_nombre);
            $mail->From = $de_correo;
            $mail->FromName = $de_nombre;
        }else{
            $mail->AddReplyTo(Config::get('config.correo.from_mail'), Config::get('config.correo.from_name'));
            $mail->From = Config::get('config.correo.from_mail');
            $mail->FromName = Config::get('config.correo.from_name');
        }
        
        $mail->Subject = $asunto;
        $mail->Body = $cuerpo;
        $mail->WordWrap = 50; // set word wrap
        $mail->MsgHTML($cuerpo);
        $mail->AddAddress($para_correo, $para_nombre);
        $mail->IsHTML(true); // send as HTML
        $mail->SetLanguage('es');
        //Enviamos el correo
        $exito = $mail->Send();
        $intentos = 2;
        //esto se realizara siempre y cuando la variable $exito contenga como valor false
        while ((!$exito) && $intentos < 1) {
            sleep(5);
            $exito = $mail->Send();
            $intentos = $intentos + 1;
        }

        $mail->SmtpClose();
        return $exito;
    }

    /**
     * Envia un correo
     *
     * @param $mail
     * @param $pass
     * @param $body
     */
    public static function sendContact($correo, $person, $body) {
        //Cargamos las librería PHPMailer
        Load::lib('phpmailer');
        //instancia de PHPMailer
        $mail = new PHPMailer();

        $mail->IsSMTP();
        $mail->SMTPAuth = true; // enable SMTP authentication
        $mail->SMTPSecure = 'ssl'; // sets the prefix to the servier
        $mail->Host = self::$_host; // sets GMAIL as the SMTP server
        $mail->Port = self::$_port; // set the SMTP port for the GMAIL server
        $mail->Username = self::$_userName;
        $mail->Password = self::$_password;
        $mail->AddReplyTo($correo, $person);
        $mail->From = $correo;
        $mail->FromName = $person;
        $mail->Subject = 'Contacto desde la web';
        $mail->Body = $body;
        $mail->WordWrap = 50; // set word wrap
        $mail->MsgHTML($body);
        $mail->AddAddress('maxter2024@gmail.com', 'Henry Stivens');
        $mail->IsHTML(true); // send as HTML
        //Enviamos el correo
        $exito = $mail->Send();
        $intentos = 1;
        //esto se realizara siempre y cuando la variable $exito contenga como valor false
        while ((!$exito) && $intentos < 1) {
            sleep(5);
            $exito = $mail->Send();
            $intentos = $intentos + 1;
        }
        return $exito;
    }

}

?>