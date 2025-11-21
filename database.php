<?php
// Start the PHP session and include the database connection file
session_start();
include("db_conn.php");

// Check if required data has been posted
if(isset($_SESSION['lrn'])){
    // Retrieve data from the POST request
    $date = mysqli_real_escape_string($conn, $_POST["date"]);
    $gradeLevel = mysqli_real_escape_string($conn, $_POST["gradeLevel"]);
    $lrn = mysqli_real_escape_string($conn, $_POST["lrn"]);
    $course_id = mysqli_real_escape_string($conn, $_POST["course_id"]);
    $ln = mysqli_real_escape_string($conn, $_POST["ln"]);
    $fn = mysqli_real_escape_string($conn, $_POST["fn"]);
    $mn = mysqli_real_escape_string($conn, $_POST["mn"]);
    $bd = mysqli_real_escape_string($conn, $_POST["bd"]);
    $age = mysqli_real_escape_string($conn, $_POST["age"]);
    $gen = mysqli_real_escape_string($conn, $_POST["gen"]);
    $cs = mysqli_real_escape_string($conn, $_POST["cs"]);
    $pb = mysqli_real_escape_string($conn, $_POST["pb"]);
    $ny = mysqli_real_escape_string($conn, $_POST["ny"]);
    $rn = mysqli_real_escape_string($conn, $_POST["rn"]);
    $mobilenum = mysqli_real_escape_string($conn, $_POST["mobilenum"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $resadd = mysqli_real_escape_string($conn, $_POST["resadd"]);
    $schadd = mysqli_real_escape_string($conn, $_POST["schadd"]);
    $fathername = mysqli_real_escape_string($conn, $_POST["fathername"]);
    $fatheroccu = mysqli_real_escape_string($conn, $_POST["fatheroccu"]);
    $mothername = mysqli_real_escape_string($conn, $_POST["mothername"]);
    $motheroccu = mysqli_real_escape_string($conn, $_POST["motheroccu"]);
    $ng = mysqli_real_escape_string($conn, $_POST["ng"]);
    $mfe = mysqli_real_escape_string($conn, $_POST["mfe"]);
    $contactnum = mysqli_real_escape_string($conn, $_POST["contactnum"]);
    $submission_time = mysqli_real_escape_string($conn, $_POST['submission_time']);

    // Check if 'submit' button is clicked and an image is uploaded
    if (isset($_POST['submit']) && isset($_FILES['pic'])) {
        // Include the database connection file
        include "db_conn.php";
    
        // Retrieve image details
        $img_name = $_FILES['pic']['name'];
        $img_size = $_FILES['pic']['size'];
        $tmp_name = $_FILES['pic']['tmp_name'];
        $error = $_FILES['pic']['error'];
    
        // Process uploaded image
        if ($error === 0) {
            // Check if image size exceeds the limit
            if ($img_size > 26214400) { // 25 MB in bytes
                $em = "Sorry, your file is too large.";
                header("Location: result_page.php?error=$em");
            } else {
                // Process allowed image types
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
                $allowed_exs = array("jpg", "jpeg", "png"); 
    
                if (in_array($img_ex_lc, $allowed_exs)) {
                    // Generate unique image name and move it to the upload directory
                    $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                    $img_upload_path = 'admin/uploads/'.$new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);
    
                    // Insert data into database
                    $sql = "INSERT INTO student_info 
                    (student_id, ln, fn, mn, bd, age, gen, cs, pb, ny, rn, mobilenum, email, resadd, schadd, fathername, fatheroccu, mothername, motheroccu, ng, contactnum, date, lrn, course_id, submission_time, grade_level, status, image_url, mfe)
                    VALUES ('', '$ln','$fn', '$mn', '$bd', '$age', '$gen', '$cs', '$pb', '$ny', 
                            '$rn', '$mobilenum', '$email', '$resadd', '$schadd', '$fathername',
                            '$fatheroccu','$mothername','$motheroccu','$ng','$contactnum','$date',
                            '$lrn', '$course_id', '$submission_time', $gradeLevel, 'pending', '$new_img_name', '$mfe')";
     
                   // Execute SQL query
                    if ($conn->query($sql) === TRUE) {
                        // Success message
                        echo "<script>alert('You\'re now enrolled. Please wait for the school email if you are officially enrolled.'); window.location='index.html';</script>";
                        // Unset the LRN session variable
                        unset($_SESSION['lrn']);
                    } else {
                        // Error message
                        echo "Error inserting student record: " . $conn->error;
                    }
                } else {
                    $em = "You can't upload files of this type";
                       header("Location: result_page.php?error=$em");
                }
            }
        } else {
            $em = "Unknown error occurred!";
            header("Location: result_page.php?error=$em");
        }
    }
    
    // Close the database connection
    $conn->close();
} else {
    // Redirect to enrollment page if LRN session variable is not set
    header("Location: first_page.php");
    exit();
}