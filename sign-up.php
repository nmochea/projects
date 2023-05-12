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
        <title>Sign Up | Create</title>
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
                <h1>Create a Sign Up</h1>
                <form action="signup-process.php" method="POST">
                    <label for="firstname">First Name:</label>
                    <input type="text" id="firstname" name="first_name" placeholder="Enter your first name" required autocomplete="off"/>

                    <label for="lastname">Last Name:</label>
                    <input type="text" id="lastname" name="last_name" placeholder="Enter your last name" required autocomplete="off"/>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required autocomplete="off"/>

                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required autocomplete="off"/>

                    <label for="birthdate">Birthdate:</label>
                    <input type="date" id="birthdate" name="birthdate" placeholder="Enter your birthdate" required autocomplete="off"/>

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required autocomplete="off"/>

                    <div class="form-actions">
                        <input type="submit" value="Sign Up" />
                    </div>
                </form>
            </div>
        </div>
        <script src="js/main.js" defer></script>
    </body>
</html>
