<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['email']) && $_SESSION['role'] === 'admin') {


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="icon.jpeg" type="image/x-icon">
    <title>Admin List</title>
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

<div class="container mt-5" style="background-color:white;">
    <h3 class="text-black mb-4">Admin List</h3>
    <table class="table table-bordered table-striped text-black" id="adminTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Name</th>
                <th>Role</th>
                <th>Status</th>
                <th>Last Online</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Connect to database
            $conn = mysqli_connect("localhost", "root", "", "enrollment");

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch admin data from the database
            $sql = "SELECT id, email, name, role, status, last_online FROM admin";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["role"] . "</td>";
                    echo "<td>" . $row["status"] . "</td>";
                    echo "<td>" . $row["last_online"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No admin found</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.datatables.net/2.0.3/js/dataTables.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#adminTable').DataTable();
    });
</script>

</body>
</html>
<?php 
}else{
    header('Location: ./../index.php');
}
?>
