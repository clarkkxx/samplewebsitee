<?php
session_start();

include("db_conn.php");

if(isset($_SESSION['lrn'])){


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/icon.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="assets/result.css">
    <title>Result Page</title>
    <style>
        .container {
            font-family: Arial;
            font-size: 18px;
        }
    </style>
</head>
<body>
<header id="main-header">
    <!-- Header with logo and navigation links -->
    <a href="home.php">
        <h2 class="logo"></h2>
    </a>
    <nav class="navigation">
        <a href="index.html">Home </a>
        <a href="first_page.php">Enroll</a>
        <a href="contact.php">Contact Us</a>
        <a href="admin/index.php">Log In</a>
    </nav>
</header>

<div class="head" style="position:relative; top:90em">
    <header>
        <table class="center">
            <tr>
                <th>
                    <!-- Header section with school information -->
                    <p>
                        <h3><img src="assets/icon.jpeg">
                        <div class="zxc">
                        <b><center>ECLARO ACADEMY</center></b>
                        <b><center>EVER GOTESCO BRANCH</center></b>
                        </div>
                        <div class="qwe">
                        <center>The Eclaro Academy aims to be among Asia’s top academic institutions committed 
                            to nurture innovative learners and developing excellent leaders through technology-oriented, 
                            environmentally-sound, and globally-competitive education.</center></h3>
                        </div>
                    </p>
                </th>
                <th>
                    <!-- Section for admission form -->
                    <p>
                        <div class="ad">
                        <b>ADMISSION FORM</b>
                        </div>
                        <div class="fm">
                        <center>ADM 0 APRIL 2024</center>
                        </div>
                    </p>
                </th>
            </tr>
        </table>
    </header>
</div>

<?php
    // Retrieving form data from POST request
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
    $contactnum = mysqli_real_escape_string($conn, $_POST["contactnum"]);
    $mfe = mysqli_real_escape_string($conn, $_POST["mfe"]);


    // Query to fetch the course name based on the course ID
        $sql = "SELECT course_name FROM courses WHERE course_id = '$course_id'";
        $result = mysqli_query($conn, $sql);

        // Check if the query was successful
        if ($result) {
            // Fetch the course name from the result
            $row = mysqli_fetch_assoc($result);
            $course_name = $row['course_name'];
        } else {
            // Handle errors if the query was not successful
            echo "Error: " . mysqli_error($conn);
        }
    
 
   
?>

<div class="container">
    <!-- Form displaying student's personal information -->
    <form action="database.php" method="POST"  enctype="multipart/form-data" style="position: relative; top: 80em;">
        <input type="hidden" name="submission_time" value="<?php echo date('Y-m-d H:i:s'); ?>">
        <center><h3>Student's Personal Information</h3></center><br>
        <div class="picture">
            <!-- Input field for attaching photo -->
            <div>
                 <h4>Preview:</h4>
                    <img id="preview" src="#" style="display: block; position: relative; float: right; bottom: 5em; margin-right: 19em;">
            </div>
            <div>
            <h4>Please Attach Photo (1x1):<br></h4>
                <input type="file" name="pic" id="pic" onchange="previewImage()" value="<?php echo $file_name;?>" required><br><br>
            </div>
            <div class="wrapper">
            Date: <input type="text" name="date" value="<?php echo $date;?>" required><br><br>
            LRN: <input type="text" name="lrn" value="<?php echo $lrn;?>" readonly><br><br>
            Strand Applied: <input type="text" name="course_id" value="<?php echo $course_name; ?>" readonly><br><br>
            <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
            Grade Level Applied: <input type="text" name="gradeLevel" value="<?php echo $gradeLevel;?>" readonly><br><br>
            Last Name: <input type="text" name="ln" value="<?php echo $ln;?>" readonly>
            First Name: <input type="text" name="fn" value="<?php echo $fn;?>" readonly>
            Middle Name: <input type="text" name="mn" value="<?php echo $mn;?>" readonly><br><br>
            Birthday: <input type="text" name="bd" value="<?php echo $bd;?>" readonly>
            Age: <input type="text" name="age" value="<?php echo $age;?>" readonly>
            Sex: <input type="text" name="gen" value="<?php echo $gen;?>" readonly>
            Civil Status: <input type="text" name="cs" value="<?php echo $cs;?>" readonly><br><br>
            Place of Birth: <input type="text" name="pb" value="<?php echo $pb;?>" readonly>
            Nationality: <input type="text" name="ny" value="<?php echo $ny;?>" readonly>
            Religion: <input type="text" name="rn" value="<?php echo $rn;?>" readonly><br><br>
            Mobile Number: <input type="text" name="mobilenum" value="<?php echo $mobilenum;?>" readonly>
            Email: <input type="text" name="email" value="<?php echo $email;?>" readonly><br><br>
            Residence Address: <input type="text" name="resadd" value="<?php echo $resadd;?>" readonly>
            School Last Attended/Address: <input type="text" name="schadd" value="<?php echo $schadd;?>" readonly>
            Father's Name: <input type="text" name="fathername" value="<?php echo $fathername;?>" readonly>
            Father's Occupation: <input type="text" name="fatheroccu" value="<?php echo $fatheroccu;?>" readonly><br><br>
            Mother's Name: <input type="text" name="mothername" value="<?php echo $mothername;?>" readonly>
            Mother's Occupation: <input type="text" name="motheroccu" value="<?php echo $motheroccu;?>" readonly><br><br>
            Name of Guardian: <input type="text" name="ng" value="<?php echo $ng;?>" readonly>
            Contact Number: <input type="text" name="contactnum" value="<?php echo $contactnum;?>" readonly><br><br>
            Preferred Modality: <input type="text" name="mfe" value="<?php echo $mfe;?>" readonly><br><br>
            <div class="submit" style="position: relative; right: 3em;">
            <input type="submit" name="submit"><br><br>
            </div>
            <div class="back">
        <button onclick="goBack()" style="position: relative; bottom: 2.5em;">Back</button>
    </div>
        </div>
        </div>
    </form>
    
</div>

<!-- JavaScript Function to Go Back -->
<script src="assets/script.js"></script>
</body>
</html>

<?php
} else {
    // Redirecting to index.php if email and password are not set in POST request
    header("Location: first_page.php");
    exit();
}
?>
