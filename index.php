<?php
// Start the session
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
  $link = 'Dashboard';
  $url = 'dashboard.php';
} else {
  $link = 'Sign In';
  $url = 'login.php';
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <title>Ocademy</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <link rel="stylesheet" href="css/home.css" />
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

        <div class="main">
            <img src="image/astronaut.png" alt="Astronaut" class="floating" />
            <h1>Let's learn from here!</h1>
            <p>
                Boost productivity, promote collaboration, and ensure security with our beloved programming language platform.
            </p>
            <a href="sign-up.php">Create a Sign Up</a>
        </div>

        <footer class="footer">
            <p>&copy; 2023 Designed with &hearts; by <a href="#">Neilmark Ochea</a>.</p>
        </footer>
        <script src="js/main.js" defer></script>
    </body>
</html>
