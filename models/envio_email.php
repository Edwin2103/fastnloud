<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

$email=$_GET['email'];
$ruta="http://localhost/Fast'nLoud/restablece-contraseña&".$email;

try {
  

    $mail = new PHPMailer(true);

    $mail->isSMTP();// Set mailer to use SMTP
    $mail->CharSet = "utf-8";// set charset to utf8
    $mail->SMTPAuth = true;// Enable SMTP authentication
    $mail->SMTPSecure = 'tls';// Enable TLS encryption, `ssl` also accepted

    $mail->Host = 'smtp.gmail.com';// Specify main and backup SMTP servers
    $mail->Port = 587;// TCP port to connect to
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->isHTML(true);// Set email format to HTML

    $mail->Username = 'edwindaw1dam@gmail.com';// SMTP username
    $mail->Password = 'password';// SMTP password

    $mail->setFrom('edwindaw1dam@gmail.com');//Your application NAME and EMAIL
    $mail->Subject = 'Restablecer contraseña';//Message subject
    $mail->MsgHTML('<html>
         </head>
        <title>Nueva contraseña</title>
        </head>
        <body>
        <p>Ya casi has cambiado la contraseña, solo falta añadir la nueva. Para ello solo sigue el siguiente enlace.</p>
        <br>
         <a href="'.$ruta.'">Restablecer contraseña</a>
         <br>
         </body>
        </html>');// Message body
    $mail->addAddress($email);// Target email


    
    $mail->send();
    echo '<div class="alert-dismissible"></div>';
    echo '<div class="alert alert-success alert-dismissible">';
    echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
    </a> Mensaje enviado, revise su cuenta de email';
    echo '</div>';
} catch (Exception $e) {
    echo "El mensaje no se ha podido enviar. Mailer Error: {$mail->ErrorInfo}";
}