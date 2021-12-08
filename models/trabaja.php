<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    require 'vendor/autoload.php';

    $mail = new PHPMailer(true);
     if(isset($enviar)){

        $acep = 'Mensaje enviado';
            
        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.serviciodecorreo.es;                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'fastnloud@tabwebs.com';                     // SMTP username
            $mail->Password   = 'Pantalones21';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('fastnloud@tabwebs.com', $nombre);
            $mail->addAddress('edwinorlando21@gmail.com');     // Add a recipient
            //$mail->addAddress('ellen@example.com');               // Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            $mail->AddAttachment($_FILES['datos']['tmp_name'],
                                 $_FILES['datos']['name']);

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $asunto;
            $mail->Body    = $mensaje;

            $mail->send();
            echo '<div class="alert-dismissible"></div>';
            echo '<div class="alert alert-success alert-dismissible">';
            echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
            </a>'. $acep;
            echo '</div>';
        } catch (Exception $e) {
            echo "Message could not be sent. ";
        }
    }
?>


    <div class="container">
        <div class="form-group">
            <h1 style="margin-top: 60px">Formulario</h1>
        </div>
        <hr>
        <form name="input" action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label class="label-control" for="nombre"> Nombre:</label>
                        <input class="form-control" type="text" name="nombre" placeholder="Introduzca su nombre"/>
                    </div>
                    <div class="col">
                        <label class="label-control" for="apellidos"> Apellidos:</label>
                        <input class="form-control" type="text" name="apellidos" placeholder="Introduzca sus apellidos"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label class="label-control" for="edad"> Edad:</label>
                        <input class="form-control" type="text" name="edad" placeholder="Introduzca su edad"/>
                    </div>
                    <div class="col">
                        <label class="label-control" for="apellidos"> Sexo:</label>
                        <select name="sexo"  class="form-control" required="true">
                            <option value="">Seleccione una categoria</option>
                            <option value="">Hombre</option>
                            <option value="">Mujer</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-1">
                    <label class="label-control" for="email" class="col-2"> Email:</label>
                    <input class="form-control" type="text" name="email" placeholder="ejemplo@ejemplo.com"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-1">
                    <label class="label-control" for="asunto" class="col-2"> Asunto:</label>
                    <input class="form-control" type="text" name="asunto" value= "Curriculum" placeholder="Introduzca el asunto del mensaje"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-1">
                    <label class="label-control" for="mensaje" class="col-2"> Mensaje:</label>
                    <textarea class="form-control" name="mensaje" placeholder="Introduzca el mensaje"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-1">
                    <label class="label-control" for="telefono" class="col-2"> Teléfono:</label>
                    <input class="form-control" type="text" name="telefono" placeholder="999-999-999"/>
                </div>
            </div>
            <div class="form-group">
                <input type="file" class="form-control" name="datos" title="Adjunte el curriculum" placeholder="Curriculum" required="true"/>
            </div>
            
            <button class="btn btn-submit" name="enviar" type="submit"><i class="fa fa-sign-in"></i> Enviar</button>

        </form>
        

    </div>

</body>
</html>