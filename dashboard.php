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

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Account Dashboard</title>
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
                    <li>
                        <a href="<?php echo $url; ?>"><?php echo $link; ?></a>
                    </li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
        </header>

        <div class="container">
            <div class="form-container">
                <div class="dropdown">
                    <i class="fas fa-ellipsis-v"></i>
                    <div class="dropdown-content">
                        <a href="post.php">Create Blog Post</a>
                        <a href="edit.php">Edit Information</a>
                        <a href="delete.php">Delete Account</a>
                        <a href="change.php">Change Password</a>
                    </div>
                </div>
                <h1>Admin Dashboard</h1>
                <form method="POST">
                    <!-- <img src="image/avatar.png" class="avatar" /> -->

                    <label for="firstname">First Name:</label>
                    <input type="text" id="firstname" name="first_name" value="<?php echo $user_first_name; ?>" disabled />

                    <label for="lastname">Last Name:</label>
                    <input type="text" id="lastname" name="last_name" value="<?php echo $user_last_name; ?>" disabled />

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $user_email; ?>" disabled />

                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" value="<?php echo $user_phone; ?>" disabled />

                    <label for="birthdate">Birthdate:</label>
                    <input type="date" id="birthdate" name="birthdate" value="<?php echo $user_birthdate; ?>" disabled />

                    <div class="form-actions">
                        <input type="submit" name="logout" value="Log Out" />
                    </div>
                </form>
            </div>
        </div>
        <script src="js/main.js" defer></script>
    </body>
</html>
