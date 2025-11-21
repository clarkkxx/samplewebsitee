<?php
// Start the PHP session and establish a connection to the database
session_start();
$sname = "localhost"; // Server name (usually "localhost")
$uname = "root"; // Database username
$password = ""; // Database password (if any)
$db_name = "enrollment"; // Database name

// Establish a connection to the database
$conn = mysqli_connect($sname, $uname, $password, $db_name);

// Check if the connection is successful
if (!$conn) {
    echo "Connection failed!"; // Output an error message if connection fails
}

// Query to select all courses
$result = mysqli_query($conn, "SELECT * FROM courses");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/icon.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="assets/style1.css">
</head>

<header id="main-header">
    <a href="index.html">
        <h2 class="logo"></h2>
    </a>
    <nav class="navigation">
        <a href="index.html">Home </a>
        <a href="first_page.php">Enroll</a>
        <a href="contact.php">Contact Us</a>
        <a href="admin/index.php">Log In</a>
    </nav>
</header>

<div class="head">
    <header>
        <table class="center">
            <tr>
                <th>
                    <p>
                        <h3><img src="assets/icon.jpeg">
                            <div class="zxc">
                                <b><center>ECLARO ACADEMY</center></b>
                                <b><center>EVER GOTESCO BRANCH</center></b>
                            </div>
                            <div class="qwe">
                                <center>The Eclaro Academy aims to be among Asia’s top academic institutions committed
                                    to nurture innovative learners and developing excellent leaders through
                                    technology-oriented,
                                    environmentally-sound, and globally-competitive education.</center></h3>
                            </div>
                    </p>
                </th>
                <th>
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

<body>
    <div class="container">
        <center>
            <h4>REGISTRATION & ADMISSION SECTION</h4>
            <h3>NOTICE OF ADMISSION</h3>
        </center>
        <form action="second_page.php" method="POST" id="formission" enctype="multipart/form-data">
            <div class="date">
                <h4>Date: <input type="date" name="date" required><br></h4>
            </div>
            <div class="na">
                <h4>LRN:<input type="text" name="lrn" required></h4>
            </div>
            <div class="course_id">
                <h4>Strand You Wish to Enroll: <select name="course_id">
                <option value="" disabled selected>Select Strand</option>
                        <?php
                        // Loop through the results of the SQL query and display each course as an option
                        while ($row = mysqli_fetch_assoc($result)) {
                            $course_id = $row['course_id'];
                            $course_name = $row['course_name'];
                            echo "<option value=\"$course_id\"";
                            // Check if $database_course_value is defined before using it
                            if (isset($database_course_value) && $database_course_value == $course_id) {
                                echo " selected";
                            }
                            echo ">$course_name</option>";
                        }
                        ?>
                    </select>
            </div>
            <h3>Grade Level Applying:</h3>
            <select name="gradeLevel" id="" required>
                <option value="">-Select-</option>
                <option value="11">Grade 11</option>
                <option value="12">Grade 12</option>
            </select>
            <div class="ca">

            </div>
            <p style="text-indent:50px;">
                Please be informed that you are considered as Qualified applicant for Admission this SY 2024-2025
                in the strand you applied or to the strand where you are qualified to enroll based from the
                evaluation and ranking of your Gen. Weighted Average in the HS Grade 10.<br><br>
            </p>
            <p style="text-indent:50px;">
                If you are interested to enroll in this School and avail the <b>FREE TUITION FEE</b>, you may fill out
                this Admission Form and the attached Student’s Health Declaration and Interview questionnaire. Submit
                it to Eclaro Academy Ever Gotetsco Branch together with other requirements mentioned below. Incomplete
                requirements shall not be entertained. <br><br>


                <i><b>Note: Failure to submit this form and the requirements on the specified date could mean
                        forfeiture of your right to enroll in your chosen strand or to the course strand you are
                        considered to enroll. However, you may opt to choose another strand if it is still open or
                        if there is/are still slots available.</b></i>
            </p><br>
            <div class="next">
                <input type="submit" name="next" value="Next" style="left: -22px; bottom: 1px;">
            </div>
        </form>
    </div>
    <script src="assets/script.js"></script>
</body>

</html>
