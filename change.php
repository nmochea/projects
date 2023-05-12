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
$user_email = $_SESSION['user_email'];

// Connect to database
$dbhost = 'localhost';
$dbname = 'db2';
$dbuser = 'root';
$dbpass = '';

// Filter inputs for XSS and SQL injection attacks :)
if (isset($_POST['confirm'])) {
    $old_password = htmlspecialchars($_POST['old_password'], ENT_QUOTES, 'UTF-8');
    $new_password = htmlspecialchars($_POST['new_password'], ENT_QUOTES, 'UTF-8');
    $confirm_password = htmlspecialchars($_POST['confirm_password'], ENT_QUOTES, 'UTF-8');

    // Check if the user's password is correct
    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $row = $stmt->fetch();

    if (password_verify($old_password, $row['password'])) {
        // Check if the new password meets the requirements
        if ($new_password != $confirm_password) {
            echo '<script>alert("New password and confirm password do not match.")</script>';
        } else {
            // Update the user's password in the database
            $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->execute([$new_password_hash, $user_id]);
            session_unset();
            session_destroy();
            echo '<script>alert("Successfully updated!");window.location.href="login.php";</script>';
            exit();
        }
    } else {
        echo '<script>alert("Incorrect password.")</script>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Change Password | Dashboard</title>
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
                <h1>Change Password</h1>
                <form method="POST">
                    
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $user_email; ?>" disabled/>

                    <label for="old_password">Old Password:</label>
                    <input type="password" id="old_password" name="old_password" placeholder="Enter your old password" required autocomplete="off"/>

                    <label for="new_password">New Password:</label>
                    <input type="password" id="new_password" name="new_password" placeholder="Enter your new password" required autocomplete="off"/>

                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your new password" required autocomplete="off"/>

                    <div class="form-actions">
                        <input type="submit" name="cancel" value="Cancel" onclick="goBack()" class="form-action-cancel" />
                        <input type="submit" name="confirm" value="Confirm" class="form-action-confirm" />
                    </div>
                </form>
            </div>
        </div>
        <script src="js/main.js" defer></script>
    </body>
</html>
