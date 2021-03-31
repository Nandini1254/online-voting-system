<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'partials\PHPMailer/src/Exception.php';
require 'partials\PHPMailer/src/PHPMailer.php';
require 'partials\PHPMailer/src/SMTP.php';

include 'partials\db_connection.php';
// making uniques

// require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
$true=false;

if(isset($_POST['email']))
{
    //$token=uniqid(true);
    $email=$_POST["email"];
    // $password=$_POST["password"];
    // echo $email;
    $contact=$_POST['contact'];
    
        try {
            //Server settings
          //  $mail->SMTPDebug = 2;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'dhanira04@gmail.com';                     // SMTP username
            $mail->Password   = 'Dhanira@1204$';                               // SMTP password   //---asnow--->this is dummy password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            
            //Recipients
            // $email
            $mail->setFrom("dhanira04@gmail.com", 'Mymail');
            $mail->addAddress("dhanira04@gmail.com", 'Nandini');     // Add a recipient
            $mail->addAddress($email);               // Name is optional
            // $mail->addReplyTo('dhanira04@gmail.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
        
            // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        
            // Content
            // "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/FORUM/partial/_request.php?token=12345";
           
            // $url="http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/_resetpassword.php?token=".$token;
            $body='<div class="contact">
            Email:'.$email.'<br>
            query:'.$contact.'
          </div>';
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Contact query';
            $mail->Body    =  $body;
            $mail->AltBody = 'please contact me';
        
            $mail->send();
            $true=true;
            
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
   
    


?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="cssfolder/homestyle.css">

    <!-- Bootstrap CSS -->
   

    <title>comments</title>
    <style>
     .container{
        width:50%;
        min-height: 400px;
        background-color:#81c644 ;
        margin: auto;
        margin-top:20px;
    }
    </style>
</head>
<body>
    <?php 
    
    $_SESSION['contact']=true;
    include 'partials\db_connection.php';
    include 'partials\_nav.php';
    ?>
    <div class="container ">
        <?php
            if($true)
            {
                echo '<div><center>We will contact you as soon as possible</center></div>';
                $_SESSION['contact']=false;
                header("location:index.php");
            }      
        ?>
        <strong class="my=4" style="font-size:34px">contact US</strong>
        <form action="<?php  $_SERVER['REQUEST_URI'] ?>" method="post" class="my-4">
            <div class="mb-3">
                <label for="Email1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="Email1" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                 <label for="query" class="form-label">query</label>
                 <textarea name="contact" class="form-control" id="" cols="30" rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Mail</button>
            <br>
        </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
     <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
   
</body>

</html>