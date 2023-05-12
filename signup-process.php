<?php
// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'db2');

// Check for errors
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the form data with Injection/XSS Attack Filtered
$first_name = htmlspecialchars($_POST['first_name'], ENT_QUOTES, 'UTF-8');
$last_name = htmlspecialchars($_POST['last_name'], ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
$phone = htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8');
$birthdate = htmlspecialchars($_POST['birthdate'], ENT_QUOTES, 'UTF-8');
$password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Check if the user already exists in the database
$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // User already exists, show error alert
    echo '<script>alert("Email address already exists.");window.location.href="sign-up.php";</script>';
} else {
    // Insert the user into the database
    $sql = "INSERT INTO users (first_name, last_name, email, phone, birthdate, password) 
          VALUES ('$first_name', '$last_name', '$email', '$phone', '$birthdate', '$hashed_password')";
    if (mysqli_query($conn, $sql)) {
        // Sign up successful, redirect to login page
        header('Location: login.php');
    } else {
        // Error inserting user
        echo "Error: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);

?>
