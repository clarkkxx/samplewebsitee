<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['email']) && $_SESSION['role'] === 'admin'){

    if (isset($_GET['delete_cancel'])) {
        // Display alert message if deletion is cancelled
        echo "<script>alert('Deletion cancelled.');</script>";
    } elseif (isset($_GET['delete_success'])) {
        // Display alert message if record is successfully deleted
        echo "<script>alert('Record deleted successfully.');</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Admin</title>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="icon.jpeg" type="image/x-icon">
</head>

<body class="bg-dark">
<header id="main-header">
    <a href="indexadmin.php">
        <h2 class="logo"></h2>
    </a>
    <nav class="navigation">
        <a href="indexadmin.php">Home</a> 
        <a href="dashboard.php">Dashboard</a>
        <a href="config/setting.php">Setting</a>
        <a href="logout.php">Log Out</a>
    </nav>
</header>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h2 class="display-6 text-center">Admin</h2>
                    <!-- Search form -->
                    <div class="search">
                        <form name="search" method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <input type="text" name="search" placeholder="Search..." value="<?php if(isset($_GET['search'])){echo $_GET['search'];} ?>">
                            <input type="submit" value="Search">
                            <a href="./functions/approve.php" name="approve" class="btn btn-secondary">Approve Students</a>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <?php
                    include ('config/db.php');
                    
                    // Define the SQL query
                    $query = "SELECT oe.student_id, oe.*, courses.course_name
                    FROM official_enrolled oe
                    INNER JOIN courses ON oe.course_id = courses.course_id";
          
                    // If search query is present, modify the query to filter results
                    if(isset($_GET['search'])){
                        $filtervalues = $_GET['search'];
                        $query .= " WHERE CONCAT(oe.lrn, oe.email, oe.fn, oe.mn, oe.ln, courses.course_name) LIKE '%$filtervalues%' ";
                    }

                    // If strand filter is selected, modify the query accordingly
                    if(isset($_GET['fetchval'])){
                        $strandFilter = $_GET['fetchval'];
                        $query .= " AND courses.course_id = $strandFilter";
                    }
                    // If sex filter is selected, modify the query accordingly
                    if(isset($_GET['sexFilter'])){
                        $sexFilter = $_GET['sexFilter'];
                        // Add condition to filter by sex
                        $query .= " AND oe.gen = '$sexFilter'";
                    }
                    // If grade level filter is selected, modify the query accordingly
                        if(isset($_GET['gradeLevelFilter'])){
                            $gradeLevelFilter = $_GET['gradeLevelFilter'];
                            // Add condition to filter by grade level
                            $query .= " AND oe.gradeLevel = '$gradeLevelFilter'";
                        }


                    // Execute the query
                    $result = mysqli_query($conn, $query);

                    // Check if the query is successful
                    if (!$result) {
                        die("Query failed: " . mysqli_error($conn));
                    }

                    // Display the table
                    echo '<table class="table table-bordered">
                    <thead>
                        <tr class="bg-dark text-white">
                            <th>Sequence Number</th>
                            <th>Submission Time</th>
                            <th>LRN</th>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Civil Status</th>
                            <th>Mobile Number</th>
                            <th>Email</th>
                            <th>Grade Level</th>
                            <th>Sex</th>
                            <th>Nationality</th>
                            <th>Religion</th>
                            <th>Place of Birth</th>
                            <th>Residence Address</th>
                            <th>Last School Address</th>
                            <th>Birth Date</th>
                            <th>Father Name</th>
                            <th>Father Occupation</th>
                            <th>Mother Name</th>
                            <th>Mother Occupation</th>
                            <th>Guardian Name</th>
                            <th>Guardian Contact Number</th>
                            <th>Admission Date</th>
                            <th>Strand</th>
                            <th>Image</th>
                            <th>Preferred Modality</th>
                            <th>Status</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>';

                    $counter = 1;
                    // Loop through the query results
                    while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>
                            <td>'. $counter .'</td>
                            <td>' . $row['submission_time'] . '</td>
                            <td>' . $row['lrn'] . '</td>
                            <td>' . $row['student_id'] . '</td>
                            <td>' . $row['ln'] . ', ' . $row['fn'] . ', ' . $row['mn'] . '</td>
                            <td>' . $row['fn'] . '</td>
                            <td>' . $row['mn'] . '</td>
                            <td>' . $row['ln'] . '</td>
                            <td>' . $row['cs'] . '</td>
                            <td>' . $row['mobilenum'] . '</td>
                            <td>' . $row['email'] . '</td>
                            <td>' . $row['gradeLevel'] . '</td>
                            <td>' . $row['gen'] . '</td>
                            <td>' . $row['ny'] . '</td>
                            <td>' . $row['rn'] . '</td>
                            <td>' . $row['pb'] . '</td>
                            <td>' . $row['resadd'] . '</td>
                            <td>' . $row['schadd'] . '</td>
                            <td>' . $row['bd'] . '</td>
                            <td>' . $row['fathername'] . '</td>
                            <td>' . $row['fatheroccu'] . '</td>
                            <td>' . $row['mothername'] . '</td>
                            <td>' . $row['motheroccu'] . '</td>
                            <td>' . $row['ng'] . '</td>
                            <td>' . $row['contactnum'] . '</td>
                            <td>' . $row['admission_date'] . '</td>
                            <td>' . $row['course_name'] . '</td>
                            <td><img width="100px" src="uploads/' . $row['image_url'] . '"></td>
                            <td>' . $row['mfe'] . '</td>
                            <td>' . $row['status'] . '</td>
                            <td><a href="functions/update_page.php?id=' . $row['student_id'] . '" class="btn btn-success">Update</a></td>
                            <td><a href="functions/delete_page.php?id=' . $row['student_id'] . '" class="btn btn-danger">Delete</a></td>
                            </tr>';
                            $counter++;
                    }

                    // Close the table
                    echo '</tbody></table>';


                    ?>
                    
                </div>
                <!-- Filter section -->
                <!-- Strand filter form -->
                <div class="filter">
                    <!-- Filter section -->
                    <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <!-- Strand filter -->
                        <div class="strand">
                            <select class="form-select" name="fetchval">
                                <option selected disabled>Select Strand</option>
                                <option value="1">Science, Technology, Engineering and Mathematics</option>
                                <option value="2">Humanities and Social Science</option>
                                <option value="3">General Academic Strand</option>
                                <option value="4">Accountancy, Business and Management</option>
                                <option value="5">Information Communication and Technology</option>
                                <option value="6">Home Economics</option>
                            </select>
                        </div>

                        <!-- Sex filter -->
                        <div class="sex">
                            <select class="form-select" name="sexFilter">
                                <option selected disabled>Select Sex</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <!-- Grade level filter -->
                        <div class="gradelevel">
                            <select class="form-select" name="gradeLevelFilter">
                                <option selected disabled>Select Grade Level</option>
                                <option value="11">Grade 11</option>
                                <option value="12">Grade 12</option>
                            </select>
                        </div>

                        <!-- Submit button -->
                        <input type="submit" class="btn btn-primary" value="Apply">
                    </form>

                </div>

                <!-- Export button -->
                <div class="print">
                    <a href="config/export.php?action=export<?php if(isset($_GET['search'])) echo '&search=' . $_GET['search']; ?><?php if(isset($_GET['fetchval'])) echo '&fetchval=' . $_GET['fetchval']; ?>" class="btn btn-outline-dark">Export</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>

<?php 
} else {
    // Redirect to login page if session is not set
    header("Location: index.php");
    exit();
}
?>
