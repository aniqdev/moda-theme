<?php
 
    define("CONTACT_FORM", 'info@koeln-webstudio.de,thenav@mail.ru');
 
    function ValidateEmail($value){
        $regex = '/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i';
 
        if($value == '') { 
            return false;
        } else {
            $string = preg_replace($regex, '', $value);
        }
 
        return empty($string) ? true : false;
    }
 
    $post = (!empty($_POST)) ? true : false;
 
    if($post){
 
        $name = stripslashes($_POST['name']);
        $msg = stripslashes($_POST['msg']);
        $msg = wordwrap($msg, 70, "\r\n");
        $email = stripslashes($_POST['email']);
        $choice = stripslashes($_POST['choice']);
        $phone = stripslashes($_POST['phone']);
        
        $subject = 'Nachricht message';
        $error = '';    
        $message = '
            <html>
                    <head>
                            <title>Message</title>
                    </head>
                    <body>
                            <p>Name: '.$name.'</p>
                            <p>Nachricht: '.$msg.'</p> 
                            <p>e-Mail : '.$email.'</p>
                            <p>Choice : '.$choice.'</p>
                            <p>Phone : '.$phone.'</p>
                    </body>
            </html>';
 
        if (!ValidateEmail($email)){
            $error = 'Bitte geben Sie eine gültige eMail Adresse ein.';
        }
 
        if(!$error){
            $mail = mail(CONTACT_FORM, $subject, $message,
                 "From: ".$name." <".$email.">\r\n"
                ."Reply-To: ".$email."\r\n"
                ."Content-type: text/html; charset=utf-8 \r\n"
                ."X-Mailer: PHP/" . phpversion());
 
            if($mail){
                echo 'OK';
            }
        }else{
            echo '<div class="bg-danger">'.$error.'</div>';
        }
 
    }
?>