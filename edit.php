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


// Connect to database
$dbhost = 'localhost';
$dbname = 'db2';
$dbuser = 'root';
$dbpass = '';

if (isset($_POST['confirm'])) {
    // Filter inputs for XSS and SQL injection attacks
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

    // Check if the user's password is correct
    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $row = $stmt->fetch();

    if (password_verify($password, $row['password'])) {
        // Update the user's information in the database
        // Filter inputs for XSS and SQL injection attacks
        $first_name = htmlspecialchars($_POST['first_name'], ENT_QUOTES, 'UTF-8');
        $last_name = htmlspecialchars($_POST['last_name'], ENT_QUOTES, 'UTF-8');
        //$email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
        $phone = htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8');
        $birthdate = htmlspecialchars($_POST['birthdate'], ENT_QUOTES, 'UTF-8');
        
        $stmt = $pdo->prepare("UPDATE users SET first_name = ?, last_name = ?,/* email = ?,*/ phone = ?, birthdate = ? WHERE id = ?");
        $stmt->execute([$first_name, $last_name, /*$email,*/ $phone, $birthdate, $user_id]);

        // Update session variables with new information
        // $_SESSION['user_email'] = $email;
        $_SESSION['user_first_name'] = $first_name;
        $_SESSION['user_last_name'] = $last_name;
        $_SESSION['user_phone'] = $phone;
        $_SESSION['user_birthdate'] = $birthdate;

        session_unset();
        session_destroy();
        echo '<script>alert("Successfully updated!");window.location.href="login.php";</script>';
        exit();
    } else {
        echo '<script>alert("Incorrect password.")</script>';
    }
}
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Account | Dashboard</title>
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
                <h1>Edit Account</h1>
                <form method="POST">
                    <label for="firstname">First Name:</label>
                    <input type="text" id="firstname" name="first_name" value="<?php echo $user_first_name; ?>" autocomplete="off"/>

                    <label for="lastname">Last Name:</label>
                    <input type="text" id="lastname" name="last_name" value="<?php echo $user_last_name; ?>" autocomplete="off"/>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $user_email; ?>" disabled/>

                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" value="<?php echo $user_phone; ?>" autocomplete="off"/>

                   <label for="birthdate">Birthdate:</label>
                   <input type="date" id="birthdate" name="birthdate" value="<?php echo $user_birthdate; ?>" autocomplete="off"/>

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password " required autocomplete="off"/>

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
