<?php

$sname= "localhost"; // Server name (usually "localhost")
$unmae= "root"; // Database username
$password = ""; // Database password (if any)

$db_name = "enrollment"; // Database name

// Establish a connection to the database
$conn = mysqli_connect($sname, $unmae, $password, $db_name);

// Check if the connection is successful
if (!$conn) {
    echo "Connection failed!"; // Output an error message if connection fails
}
