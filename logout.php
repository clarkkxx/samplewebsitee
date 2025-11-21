<?php 
session_start();
include "config/db.php";

if(isset($_SESSION['id'])) {
    // Get the current timestamp with AM/PM indicator
    $currentTime = date('Y-m-d h:i:s A');
    
    // Update admin status to offline and last online timestamp
    $updateStatusSql = "UPDATE admin SET status = 'Offline', last_online = ? WHERE id = ?";
    $updateStatusStmt = $conn->prepare($updateStatusSql);
    $updateStatusStmt->bind_param("si", $currentTime, $_SESSION['id']);
    $updateStatusStmt->execute();
}

session_unset();
session_destroy();

header("Location: ../index.html");
?>
