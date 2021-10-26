<?php
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
        require "config.php";  
        require 'vendor/PHPMailer/src/Exception.php';
        require 'vendor/PHPMailer/src/PHPMailer.php';
        require 'vendor/PHPMailer/src/SMTP.php';

        $email = $_POST['email'];
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $query = mysqli_query($connect,$sql);
        if(mysqli_num_rows($query) === 1){
        $mail = new PHPMailer(true); 
            
        //Server settings
        $mail->isSMTP();                                     
        $mail->Host = 'smtp.gmail.com';                      
        $mail->SMTPAuth = true;                             
        $mail->Username = 'ebayad2021@gmail.com';     
        $mail->Password = '09192523386';             
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
        );                         
        $mail->SMTPSecure = 'ssl';                           
        $mail->Port = 465;                                   

        //Send Email
        $mail->setFrom('ebayad2021@gmail.com');
        
        //Recipients
        $mail->addAddress("kitarvin23@gmail.com");              
        $mail->addReplyTo('ebayad2021@gmail.com');
        
        //Content
        $mail->isHTML(true);                     

        // $mail->Subject = $subject;
        // $mail->Body    = $message;
        $mail->Subject = "From Ebayad Applicationd";
        $mail->Body    = "You forgot your password please click this link to reset your password" ."<br>". 
        "http://192.168.254.112/loginregister/forgotpassword/resetpassword.php?key=$email";

        if(!$mail->send()){
            echo 'Message could not be sent';
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }else{
            $msg['mail'] = "send";
            echo json_encode($msg);
        }

        }else{
            echo "enter a valid email";
        }

  
 ?>
    