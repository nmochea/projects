<?php
// Start the session
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
// Check if the user is already logged in
}else if (isset($_SESSION['user_id'])) {
    $link = 'Dashboard';
    $url = 'dashboard.php';
} else {
    $link = 'Home';
    $url = 'index.php';
}

$user_id = $_SESSION['user_id'];
$user_first_name = $_SESSION['user_first_name'];
$user_last_name = $_SESSION['user_last_name'];
$user_email = $_SESSION['user_email'];
$user_phone = $_SESSION['user_phone'];
$user_birthdate = $_SESSION['user_birthdate'];

// Connect to the database
$dbhost = 'localhost';
$dbname = 'db2';
$dbuser = 'root';
$dbpass = '';

if (isset($_POST['delete'])) {
    $password = $_POST['password'];

    // Check if the user's password is correct
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM users WHERE id='$user_id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            // Password is correct, delete user from database
            $sql = "DELETE FROM users WHERE id='$user_id'";
            if (mysqli_query($conn, $sql)) {
                session_unset();
                session_destroy();
                echo '<script>alert("Successfully deleted!");window.location.href="index.php";</script>';
                exit();
            } else {
                echo '<script>alert("Error deleting user: ' . mysqli_error($conn) . '")</script>';
            }
        } else {
            // Password is incorrect
            echo '<script>alert("Incorrect password.")</script>';
        }
    } else {
        // User not found
        echo '<script>alert("User not found.")</script>';
    }

    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Delete Account | Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <link rel="stylesheet" href="css/dashboard.css" />
    </head>
    <body onselectstart="return false;" oncontextmenu="return false;">
    <header>
      <button id="menu-toggle">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <nav>
        <ul>
          <li><a href="<?php echo $url; ?>"><?php echo $link; ?></a></li>
          <li><a href="blog.php">Blog</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
      </nav>
    </header>
        <div class="container">
            <div class="form-container">
                <h1>Delete Account</h1>
                <form method="POST">
                    <label for="firstname">First Name:</label>
                    <input type="text" id="firstname" name="first_name" value="<?php echo $user_first_name; ?>" disabled/>

                    <label for="lastname">Last Name:</label>
                    <input type="text" id="lastname" name="last_name" value="<?php echo $user_last_name; ?>" disabled />

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $user_email; ?>" disabled />

                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" value="<?php echo $user_phone; ?>" disabled />

                   <label for="birthdate">Birthdate:</label>
                   <input type="date" id="birthdate" name="birthdate" value="<?php echo $user_birthdate; ?>" disabled />

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password " required />

                    <div class="form-actions">
                        <input type="submit" name="cancel" value="Cancel" onclick="goBack()" class="form-action-cancel" />
                        <input type="submit" name="delete" value="Delete" class="form-action-delete" />
                    </div>

                </form>
            </div>
        </div>
        <script src="js/main.js" defer></script>
    </body>
</html>
