<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Check if the form has been submitted
if(isset($_POST['submit'])) { 
    // Sanitize form inputs to prevent SQL injection and other attacks
    $name= htmlentities($_POST['name']);
    $subject= htmlentities($_POST['subject']);
    $email= htmlentities($_POST['email']);
    $phone= htmlentities($_POST['phone']);
    $message= htmlentities($_POST['message']);

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    // Set mailer to use SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'your @ email . com'; // email
    $mail->Password = 'app password'; // app password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    // Enable HTML emails
    $mail->isHTML(true);

    // Set sender and recipient email addresses
    $mail->setFrom($email, $name);
    $mail->addAddress('your @ email . com'); //email that will receive the message.

    // Set email subject and body
    $mail->Subject = "$email ($subject)";
    $mail->Body = "<html><body>
<h4>$subject</h4>
<p>Name: $name</p>
<p>Phone: $phone</p>
<p>Message:</p>
<p>$message</p>
</body></html>";

    // Send the email
    if ($mail->send()) {
        echo "<script>alert('Send Successfully');document.location.href = 'contact.php';</script>";
    } else {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
}
?>
