<?php 

// Include database connection file
include_once('config/db.php');

// Include PHPMailer classes
require __DIR__ . '/../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Check if form is submitted
if(isset($_POST['submit'])){
    // Sanitize and validate user input
    $user_email = mysqli_real_escape_string($conn, $_POST["email"]);
    
    // Check if the email exists in the database    
    $check_email = mysqli_query($conn, "SELECT * FROM admin WHERE email='$user_email'");
    $res = mysqli_fetch_array($check_email);
    
    if(empty($res)) {
        // Display error message if account does not exist
        echo "<script>alert('Account does not exist.')</script>";
    } else {
        // Generate a random password reset link
        $reset_link = 'http://localhost:3000/res/admin/config/passwordreset.php?secret='.base64_encode($user_email);
        $message = '<p>You are receiving this email because we received a password reset request for your account.</p>
                    <p><a href="'.$reset_link.'" class="btn btn-primary">Reset Password</a></p>
                    <p>If you did not request a password reset, no further action is required.</p>';

        // Initialize PHPMailer
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->Username = 'your @ email . com'; // email
        $mail->Password = 'app password'; // app password
        $mail->FromName = "Admin";
        $mail->AddAddress($user_email);
        $mail->Subject = "Reset Your Password";
        $mail->isHTML(true);
        $mail->Body = $message;

        // Send email
        if($mail->send()) {
            $msg = "We have emailed your password reset link!";
        } else {
            // Display error message if unable to send email
            $msg = "Unable to send password reset link. Please try again later.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" href="icon.jpeg" type="image/x-icon">
</head>
<body>
<header id="main-header">
    <a href="../index.html">
        <h2 class="logo"></h2>
    </a>
    <nav class="navigation">
        <a href="../index.html">Home</a>
        <a href="login.php">Log In</a>
    </nav>
</header>

<form action="forgot.php" method="post">
    <h2>Forgot Password</h2>
    <?php if (isset($msg)) { ?>
        <!-- Display success or error message -->
        <p class="message"><?php echo $msg; ?></p>
    <?php } ?>
    <label>Email</label>
    <input type="email" name="email" placeholder="Email" required><br> <!-- Changed type to "email" for better input validation -->

    <button type="submit" name="submit">Send Password Reset Link</button>
    <a href="../index.php">Already Have Account?</a>
</form>
</body>
</html>
