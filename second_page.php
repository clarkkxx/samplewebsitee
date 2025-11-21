<?php
session_start();

include("db_conn.php");

// Check if required data has been posted
if(isset($_POST['lrn'])){
    // Set LRN session variable
    $lrn = $_POST['lrn'];
    $_SESSION["lrn"] = $lrn;

    if (isset($_POST["next"])) {
        // Check if LRN already exists in official_enrolled table
        $lrn = mysqli_real_escape_string($conn, $_POST['lrn']);
        $stmt = $conn->prepare("SELECT lrn FROM official_enrolled WHERE lrn = ?");
        $stmt->bind_param("s", $lrn);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // LRN found in official_enrolled table
            echo "<script>alert('You are already enrolled.'); window.location='index.html';</script>";
            exit();
        }

        // Check if LRN already exists in student_info table
        $stmt = $conn->prepare("SELECT lrn FROM student_info WHERE lrn = ?");
        $stmt->bind_param("s", $lrn);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // LRN found in student_info table
            echo "<script>alert('You have an ongoing enrollment.'); window.location='index.html';</script>";
            exit();
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/icon.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="assets/style.css">
    <title>Second Page</title>
</head>

<body>

<header id="main-header">
    <!-- Logo and navigation links -->
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

<!-- Header section -->
<div class="head">
    <header>
        <table class="center">
            <tr>
                <th>
                    <!-- Logo and school name -->
                    <p>
                        <h3><img src="assets/icon.jpeg">
                            <div class="zxc">
                                <b><center>ECLARO ACADEMY</center></b>
                                <b><center>EVER GOTESCO BRANCH</center></b>
                            </div>
                            <!-- Institution's mission statement -->
                            <div class="qwe">
                                <center>The Eclaro Academy aims to be among Asia’s top academic institutions committed 
                                    to nurture innovative learners and developing excellent leaders through technology-oriented, 
                                    environmentally-sound, and globally-competitive education.</center></h3>
                            </div>
                    </p>
                </th>
                <th>
                    <!-- Admission form header -->
                    <p>
                        <div class="ad">
                            <b>ADMISSION FORM</b>
                        </div>
                        <div class="fm">
                            <!-- Admission form details -->
                            <center>ADM 0 APRIL 2024</center>
                        </div>
                    </p>
                </th>
            </tr>
        </table>
    </header>
</div>

<?php
    // Retrieve data from the previous form submission
    $date = mysqli_real_escape_string($conn, $_POST["date"]);
    $lrn = mysqli_real_escape_string($conn, $_POST['lrn']);
    $course_id = mysqli_real_escape_string($conn, $_POST['course_id']);
    $gradeLevel = mysqli_real_escape_string($conn, $_POST['gradeLevel']);
?>
    <!-- Form for capturing student's personal information -->
    <form action="result_page.php" method="POST" id="secondpage" enctype="multipart/form-data">
        <div class="container">
            <br>
            <p><h2>Please read the questions carefully and fill in all applicable spaces. Type your answers legibly in CAPITAL letters. For items not applicable, just type N/A.</h2></p>
            <p>
                <!-- Student undertaking/data consent statement -->
                <b>The information collected on this form will be held by Eclaro Academy  in Electronic Format and will be processed in accordance with RA 10173 or Data Privacy Act  of 2012.  By continuing through this process, you understood and give consent to the collection of your personal information.
            </p>
            <br>
            <center><h3>STUDENT'S PERSONAL INFORMATION</h3></center><br>
            <!-- Hidden inputs to pass data to the next page -->
            <input type="hidden"name="date" value="<?php echo $date;?>">
            <input type="hidden"name="lrn" value="<?php echo $lrn;?>">
            <input type="hidden"name="course_id" value="<?php echo $course_id;?>">
            <input type="hidden"name="gradeLevel" value="<?php echo $gradeLevel;?>">

            <div class="name">
                <!-- Input fields for name -->
                <div class="input-container">
                    <h4>LAST NAME: <input type="text" name="ln" placeholder="Last Name" required>
                </div>
                <div class="input-container">
                    FIRST NAME: <input type="text" name="fn" placeholder="First Name" required>
                </div>
                <div class="input-container">
                    MIDDLE NAME: <input type="text" name="mn" placeholder="Middle Name" required></h4>
                </div>
            </div>
            <div class="ba">
                <!-- Input fields for birthdate, age, gender, and civil status -->
                <h4>
                    <div class="input-container">
                    Birthdate: <input type="date" id="bd" name="bd" pattern="\d{4}/\d{2}/\d{2}" onchange="calculateAge()" required>
                    </div>
                    Age: <input type="text" id="age" name="age" placeholder="Age" readonly>
                    <div class="input-container">
                        Sex:
                        <select name="gen" id="" required>
                            <option value="">-Select-</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <br> <br>  <br>
                    </div>
                    <div class="input-container">
                        Civil Status:
                        <select name="cs" id="cs" required>
                            <option value="">-Select-</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Other">Other</option>
                        </select></h4>
                    </div>

            <div class="pnr">
                <!-- Input fields for place of birth, nationality, and religion -->
                <h4>
                    <div class="input-container">
                        Place of Birth: <input type="text"name="pb" placeholder="Place of Birth" required>
                    </div>
                    <div class="input-container">
                        Nationality: <input type="text"name="ny" placeholder="Nationality" required>
                    </div>
                    <div class="input-container">
                        Religion: <input type="text"name="rn" placeholder="Religion" required>
                    </div>
                </h4>
            </div>
            <div class="me">
                <!-- Input fields for mobile phone number and email address -->
                <h4>
                    <div class="input-container">
                        Mobile Phone No.:  (+639)
                        <input type="text" name="mobilenum" placeholder="Enter the remaining digits" required>
                    </div>
                    <div class="input-container">
                        Email Address: <input type="email" name="email" placeholder="Email Address" required>
                    </div>
                </h4>
            </div>
            <div class="add">
                <!-- Input fields for residence address, school last attended/address, and honors/awards received -->
                <h4>
                    <div class="input-container">
                        Complete Residence Address: <input type="text"name="resadd" placeholder="Residence Address"required>
                    </div>
                    <div class="input-container">
                        School Last Attended/Address: <input type="text"name="schadd" placeholder="School Address" required><br><br>
                    </div>
                </h4>
            </div>
            <div class="fmn">
                <!-- Input fields for father's and mother's name and occupation, guardian's name, and contact number -->
                <h4>
                    <div class="input-container">
                        Father's Name: <input type="text"name="fathername" placeholder="Father's Full Name" required>
                    </div>
                    <div class="input-container">
                        Occupation: <input type="text"name="fatheroccu" placeholder="Occupation" required>
                    </div>
                </h4>
                <h4>
                    <div class="input-container">
                        Mother's Name: <input type="text"name="mothername" placeholder="Mother's Full Name"required>
                    </div>
                    <div class="input-container">
                        Occupation: <input type="text"name="motheroccu" placeholder="Occupation"required>
                    </div>
                </h4>
                <h4>
                    <div class="input-container">
                        Name of Guardian: <input type="text"name="ng" placeholder="Guardian's Full Name"required>
                    </div>
                    <div class="input-container">
                        Contact No.  (+639) <input type="text"name="contactnum" placeholder="Enter the remaining digits." required>
                    </div>
                    <div class="input-container">
                    Preferred Modality:
                    <select name="mfe" id="mfe" required style="position:relative; left:100px;">
                        <option value="" disabled selected>-Select-</option>
                        <option value="Online">Pure Online</option>
                        <option value="Blended Learning">BLENDED LEARNING</option>
                        <option value="Modular">Modular</option>
                    </select>
                        </div>

                </h4>
            </div>
            <!-- Buttons for submitting form and going back -->
            <div class="next">
                <input type="submit" name="next" value="Next" style="left: -22px; bottom: 1px;">
            </div>
            <button onclick="goBack()">Back</button>
        </div>
    </form>
</div>
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
