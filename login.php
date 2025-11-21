<?php 
session_start(); // Start the PHP session
include "config/db.php"; // Include the database connection file

// Check if email and password are submitted through the login form
if (isset($_POST['email']) && isset($_POST['password'])) {

    // Function to validate user input
    function validate($data){
        $data = trim($data); // Remove whitespace from the beginning and end of a string
        $data = stripslashes($data); // Remove backslashes (\) from a string
        $data = htmlspecialchars($data); // Convert special characters to HTML entities
        return $data;
    }

    // Validate and sanitize email and password
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    // Check if email or password is empty
    if (empty($email)) {
        header("Location: index.php?error=Email required"); // Redirect with error message if email is empty
        exit();
    } elseif(empty($password)){
        header("Location: index.php?error=Password is required"); // Redirect with error message if password is empty
        exit();
    } else {
        // Prepare and execute SQL statement to select email from database
        $sql = "SELECT * FROM admin WHERE email=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

            // Check if email exists
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                // Verify password
                if (password_verify($password, $row['password'])) {
                    // Set admin status to online
                    $updateStatusSql = "UPDATE admin SET status = 'Online' WHERE id = ?";
                    $updateStatusStmt = $conn->prepare($updateStatusSql);
                    $updateStatusStmt->bind_param("i", $row['id']);
                    $updateStatusStmt->execute();
                    
                    // Set session variables for the user
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['role'] = $row['role']; // Include role in session
                    
                    // Redirect to the appropriate dashboard based on role
                    if ($row['role'] === 'admin') {
                        header("Location: indexadmin.php");
                    } elseif ($row['role'] === 'main admin') {
                        header("Location: mainadmin/indexadmin.php");
                    } else {
                        header("Location: index.php?error=Invalid role");
                    }
                    exit();
                } else {
                    header("Location: index.php?error=Incorrect password"); // Redirect with error message if password is incorrect
                    exit();
                }
            } else {
                header("Location: index.php?error=User not found"); // Redirect with error message if user is not found
                exit();
            }

    }
} else {
    header("Location: index.php"); // Redirect to the login page if email and password are not submitted
    exit();
}
?>
