<?php
// Start the session
session_start();

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'db2');

// Check for errors
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the form data with Injection/XSS Attack Filtered
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

// Find the user in the database
$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $sql);

// Check if user exists and verify password
if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['password'])) {
        // Login successful
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_email'] = $row['email'];
        $_SESSION['user_first_name'] = $row['first_name'];
        $_SESSION['user_last_name'] = $row['last_name'];
        $_SESSION['user_phone'] = $row['phone'];
        $_SESSION['user_birthdate'] = $row['birthdate'];
        header('Location: dashboard.php');
    } else {
        // Invalid password
        echo '<script>alert("Invalid email or password");window.location.href="login.php";</script>';
    }
} else {
    // User not found
    echo '<script>alert("Invalid email or password");window.location.href="login.php";</script>';
}

// Close the database connection
mysqli_close($conn);
?>
