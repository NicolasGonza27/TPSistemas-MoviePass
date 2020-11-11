<?php
    use PHPMailer\PHPMailer\PHPMailer;
    require_once('PhpMailer/Exception.php');
    require_once('PhpMailer/PHPMailer.php');
    require_once('PhpMailer/SMTP.php');
    require_once "CodigoQR/qrlib.php";
            
    $dir = VIEWS_PATH . "temp/";

    if (!file_exists($dir)) {
        mkdir($dir);
    }


    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);
    $user = $_SESSION["userLogged"];

    try {
        
        
        $tamaño = 2; //Tamaño de Pixel
        $level = 'Q'; //Precisión Baja
        $framSize = 3; //Tamaño en blanco
        //Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'moviepass28@gmail.com';                // SMTP username
        $mail->Password   = 'contraMoviePass28';                    // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('moviepass28@gmail.com', 'Administracion MoviePass');
        $mail->addAddress($user->getEmail(), $user->getNombre_usuario());        // Name is optional

        // Attachments
        foreach($arrayEntradas as $entrada) {
            $contenido = "Ticket number: " . $entrada->getNro_entrada();

            $filename = $entrada->getNro_entrada() . 'test.png';
            $ruta = $dir . $filename;

            QRcode::png($contenido, $ruta, $level, $tamaño, $framSize);
            $mail->addAttachment('Views/temp/'.$filename);         // Add attachments
        }
        

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "Purchase confirmation";
        $mail->Body = "You just paied tiket/s for a function in the Movie-Pass web page" ;

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
?>