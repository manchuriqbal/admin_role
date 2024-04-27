<?php include_once "includes/header.php" ?>


<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'src/Exception.php';
    require 'src/PHPMailer.php';
    require 'src/SMTP.php';

    $connection = mysqli_connect('localhost', 'root', '', 'test_practice');
    if (!$connection) {
        die('Database Not Connected.'.mysqli_error);
    }

    if (isset($_REQUEST['submit'])) {
        $id_mark = $_REQUEST['email_mark'];
        $mark_id = implode(",", $id_mark);
        
        
        $query = "SELECT * FROM user_info WHERE id IN ($mark_id)";
        $result = mysqli_query($connection, $query);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                try {
                    $db_mail = $row['email'];
    
                    $mail = new PHPMailer();
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'manchur.fiverr@gmail.com';
                    $mail->Password = 'xjpm dovq rfxp jqtc';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;
            
                    $mail->setFrom('manchur.fiverr@gmail.com', 'Mail From Database');
                    $mail->addAddress($db_mail);
            
                    //Attachments
                    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
            
                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'test mail';
                    $mail->Body    = 'This is the. for this mail i was waiting  <b>15 day\'s!</b>';
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
                    // Send the email
                    if ($mail->send()) {
                        echo "Message has been sent $db_mail";
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