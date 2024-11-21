<?php
session_start();
include 'db.php';

// Set the correct time zone
date_default_timezone_set('Asia/Kolkata');


// Redirect to login if user is not logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
$start_time = $_SESSION['start_time']; // Session start time set during login

// Update last activity time in the database
$last_activity = date("Y-m-d H:i:s");
$stmt = $conn->prepare("UPDATE session_logs SET last_activity_time = ? WHERE user = ? AND logout_time IS NULL");
$stmt->bind_param("ss", $last_activity, $user);
$stmt->execute();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h2>Dashboard</h2>
    <p>Welcome, <?php echo htmlspecialchars($user); ?>!</p>
    <p>Session started at: <?php echo htmlspecialchars($start_time); ?></p> <!-- Shows the fixed session start time -->
    <a href="logout.php">Logout</a>
</body>
</html>