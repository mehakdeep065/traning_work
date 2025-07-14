<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

include '../connect.php';
if(isset($_POST['submit'])){
    $emails = [];
    $sql = "SELECT email FROM subscriber";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $emails[] = $row['email'];
    }

    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $headers="From:comany123@gmail.com";

    $success =0;
    $fail =0;
    foreach($emails as $to){
     $mail = new PHPMailer(true);
    try{
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'user@example.com';                     //SMTP username
    $mail->Password   = 'secret';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
    //Recipients
    $mail ->setFrom('mk76269464@gmail.com');
    $mail->addAddress($to); //Add a recipient
    
    //contant
    $mail->isHTML(false);
    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->send();
    $success++;
        
    }
    catch(Exception $e){
        $fail++;
    }
        
    }
    if($success > 0){
        echo "$success Emails sent successfully.<br>";
    }
    if($fail > 0){
        echo "$fail Emails failed to send.<br>";
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sendemail</title>
</head>
<body>
    <div>
        <form method="post">
            <label for="subject">Subject:</label>
            <input type="text" name="subject"><br>
            <label for="message">Message:</label><br>
           <textarea name="message" id="message" rows="4" cols="40"></textarea>
           <input type="submit" name="submit" value="submit">
        </form>
    </div>
</body>
</html>