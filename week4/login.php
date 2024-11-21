<?php
session_start();
include 'db.php';

// Set the correct time zone
date_default_timezone_set('Asia/Kolkata');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];

    if (!empty($username)) {
        $_SESSION['user'] = $username;
        $_SESSION['start_time'] = date("Y-m-d H:i:s"); // Set session start time with date and time

        // Log the login time in the database
        $login_time = $_SESSION['start_time'];
        $stmt = $conn->prepare("INSERT INTO session_logs (user, login_time, last_activity_time) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $login_time, $login_time);
        $stmt->execute();
        $stmt->close();

        // Redirect to dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        $error_message = "Please enter a username.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($error_message)) echo "<p style='color:red;'>$error_message</p>"; ?>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>