<?php 
session_start();
include 'functions/logaction.php';
include "config/db.php"; // Include the database connection file

// Check if the user is logged in as an admin or main admin
if (isset($_SESSION['id']) && isset($_SESSION['email']) && $_SESSION['role'] === 'admin'){

    include ('config/db.php');

    // Fetch data from student_info table
    $enrolledQuery = "SELECT COUNT(*) AS total_enrolled FROM official_enrolled WHERE status = 'enrolled'";
    $enrolledResult = mysqli_query($conn, $enrolledQuery);
    $enrolledRow = mysqli_fetch_assoc($enrolledResult);
    $totalEnrolled = $enrolledRow['total_enrolled'];

    $pendingQuery = "SELECT COUNT(*) AS total_pending FROM student_info WHERE status = 'pending'";
    $pendingResult = mysqli_query($conn, $pendingQuery);
    $pendingRow = mysqli_fetch_assoc($pendingResult);
    $totalPending = $pendingRow['total_pending'];

    // Fetch data from admin table
    $adminQuery = "SELECT COUNT(*) AS total_admins FROM admin";
    $adminResult = mysqli_query($conn, $adminQuery);
    $adminRow = mysqli_fetch_assoc($adminResult);
    $totalAdmins = $adminRow['total_admins'];

    // Fetch data from official_enrolled table for strands
    $strandQuery = "SELECT course_name, COUNT(*) AS total_students FROM official_enrolled oe JOIN courses c ON oe.course_id = c.course_id GROUP BY course_name";
    $strandResult = mysqli_query($conn, $strandQuery);
    $strandData = [];
    while ($row = mysqli_fetch_assoc($strandResult)) {
        $strandData[$row['course_name']] = $row['total_students'];
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
    <link rel="icon" href="../icon.jpeg" type="image/x-icon">
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
        <div class="row mt-5">
            <div class="col-md-6">
                <!-- Chart for strands -->
                <canvas id="strandChart"></canvas>
                <!-- Add legend -->
                <div id="chartLegend"></div>
            </div>
            <div class="col-md-6">
                <!-- Number of students enrolled -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Number of Students Enrolled</h5>
                    </div>
                    <div class="card-body">
                        <h2><?php echo $totalEnrolled; ?></h2>
                    </div>
                </div>
                <!-- Number of pending students -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title">Number of Pending Students</h5>
                    </div>
                    <div class="card-body">
                        <h2><?php echo $totalPending; ?></h2>
                    </div>
                </div>
                <!-- Number of admins -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title">Number of Admins</h5>
                    </div>
                    <div class="card-body">
                        <!-- Add anchor tag around the number of admins -->
                        <a href="admins.php" style="text-decoration: none; color: inherit;">
                            <h2><?php echo $totalAdmins; ?></h2>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
document.addEventListener("DOMContentLoaded", function() {
    // Chart data
    var strandData = <?php echo json_encode($strandData); ?>;

    // Get chart canvas element
    var ctx = document.getElementById('strandChart').getContext('2d');

    // Create chart
    var chart = new Chart(ctx, {
        type: 'pie', // Change chart type to pie
        data: {
            labels: Object.keys(strandData),
            datasets: [{
                label: 'Number of Students',
                data: Object.values(strandData),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)', // Add colors for the pie chart
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                ],
                borderColor: 'rgba(255, 255, 255, 1)', // Change border color
                borderWidth: 1
            }]
        },
        options: {
            // You can add other options here if needed
        }
    });
});

    </script>
</body>

</html>
<?php 
}else{
    header('Location = index.php');
}
?>
