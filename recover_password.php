<?php include_once "includes/header.php"?>
<br>
<form method="post">
    <label for="rec_pass">Recover your Password</label>
    <input type="email" name="email">
    <input type="submit" name="submit">
</form>

<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'src/Exception.php';
    require 'src/PHPMailer.php';
    require 'src/SMTP.php';

    if (isset($_POST['submit'])) {
        $email = $_POST['email'];

        $connection = mysqli_connect("localhost","root","","test_practice");
        $query = "SELECT * FROM user_info WHERE email ='$email'";
        $result = mysqli_query($connection, $query);

        $count = mysqli_num_rows($result);

        if ($count > 0) {
           while ($row = mysqli_fetch_assoc($result)) {
               
               
               try {
                $rec_email = $row['email'];
                $password = $row['password'];

                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'manchur.fiverr@gmail.com';
                $mail->Password = 'xjpm dovq rfxp jqtc';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
        
                $mail->setFrom('manchur.fiverr@gmail.com', 'Password Recovery');
                $mail->addAddress($rec_email);
        
                //Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Recover Your Password';
                $mail->Body    = 'This is your Account Password :'.$password .' </b>';

                // Send the email
                if ($mail->send()) {
                    echo "Message has been sent $rec_email";
                    echo "<br>";
                }
                else {
                    echo "Massage send field";
                }
        
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            

           }
        }
    }
?>