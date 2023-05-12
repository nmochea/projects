<?php
// Start the session
session_start();
// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
  $link = 'Dashboard';
  $url = 'dashboard.php';
} else {
  $link = 'Home';
  $url = 'index.php';
}

if (isset($_POST['send'])) {
  // Validate and sanitize inputs for XSS and SQL injection attacks
  $full_name = filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
  $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
  $feedback = filter_input(INPUT_POST, 'feedback', FILTER_SANITIZE_STRING);

  if (!$full_name || !$email || !$phone || !$feedback) {
    // Handle the error
    echo '<script>alert("Please fill in all required fields.");window.location.href="contact.php";</script>';
    exit();
  }

  // Create a filename using the current date and time
  date_default_timezone_set('UTC');
  $filename = date('Y-m-d_H-i-s') . '.txt';

  $path = 'emails/';

  // Create the "emails" directory if it doesn't exist
  if (!is_dir($path)) {
    mkdir($path);
  }

  // Write the form data to a text file in the "emails" directory
  $file = fopen("emails/$filename", "w");
  if ($file) {
    fwrite($file, "Full Name: $full_name\n");
    fwrite($file, "Email: $email\n");
    fwrite($file, "Phone Number: $phone\n");
    fwrite($file, "Feedback: $feedback\n");
    fclose($file);
    // Redirect the user to a thank-you page
    echo '<script>alert("Thank you for contacting us.");window.location.href="thank-you.php";</script>';
    // header('Location: thank-you.php');
    exit();
  } else {
    // Handle the error
    echo '<script>alert("Error writing file");window.location.href="contact.php";</script>';
  }
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
          <li><a href="<?php echo $url; ?>"><?php echo $link; ?></a></li>
          <li><a href="blog.php">Blog</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
      </nav>
    </header>

  <div class="container">
  <div class="form-container">
    <h1>Contact</h1>
    <form method="POST">
      <label for="fullname">Full Name:</label>
      <input type="text" id="fullname" name="full_name" placeholder="Enter your full name" required autocomplete="off"/>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" placeholder="Enter your email" required autocomplete="off"/>

      <label for="phone">Phone Number:</label>
      <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required autocomplete="off"/>

      <label for="feedback">Feedback:</label>
      <textarea id="feedback" name="feedback" placeholder="Enter your Feedback here" required autocomplete="off"></textarea>


      <div class="form-actions">
      <input type="submit" name="send" value="Submit" />
      </div>
    </form>
  </div>
</div>
<script src="js/main.js" defer></script>
  </body>
</html>
