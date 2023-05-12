<?php
// Start the session
session_start();
if (isset($_SESSION['user_id'])) {
    $link = 'Dashboard';
    $url = 'dashboard.php';
} else {
    $link = 'Home';
    $url = 'index.php';
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Sign In | Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
                <img src="image/avatar.png" class="avatar" />
                <h1>Sign In</h1>
                <form action="login-process.php" method="POST">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required autocomplete="off"/>

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required autocomplete="off"/>

                    <div class="form-actions">
                        <input type="submit" value="Login" />
                    </div>
                </form>
            </div>
        </div>
        <script src="js/main.js" defer></script>
    </body>
</html>
