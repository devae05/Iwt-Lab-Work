<?php
session_start();
include 'db.php';

// Set the correct time zone to India Standard Time (IST)
date_default_timezone_set('Asia/Kolkata'); // Set to Indian Standard Time (IST)

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $logout_time = date("Y-m-d H:i:s"); // Get the current time in IST

    // Update the logout time in the database
    $stmt = $conn->prepare("UPDATE session_logs SET logout_time = ? WHERE user = ? AND logout_time IS NULL");
    $stmt->bind_param("ss", $logout_time, $user);
    $stmt->execute();
    $stmt->close();

    // Destroy session
    session_unset();
    session_destroy();

    // Redirect to login page
    header("Location: login.php");
    exit();
}
?>