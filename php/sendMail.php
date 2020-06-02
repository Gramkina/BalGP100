<?php
    use PHPMailer\PHPMailer\PHPMailer;
    include($_SERVER['DOCUMENT_ROOT'].'/library/php/PHPMailer.php');
    include($_SERVER['DOCUMENT_ROOT'].'/library/php/SMTP.php');

    function sendMail($adress, $nameUser, $theme, $post, $altPost){
        $mail = new PHPMailer();
        
        $mail->isSMTP();
        $mail->CharSet = 'utf-8';
        $mail->Host = 'smtp.beget.ru';
        $mail->SMTPAuth = true;
        $mail->Username = 'balgp100@balgp100.pp.ua';
        $mail->Password = 'Asdfg123';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        
        $mail->setFrom('balgp100@balgp100.pp.ua', 'Балаковская городская поликлиника №100');
        $mail->isHTML(true);
        $mail->addAddress($adress, $nameUser);
        
        $mail->Subject = $theme;
        $mail->Body    = $post;
        $mail->AltBody = $altPost;
        
        return $mail->send();
    }
?>