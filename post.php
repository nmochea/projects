<?php
// Start the session
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
} elseif (isset($_SESSION['user_id'])) {
    $link_text = 'Dashboard';
    $link_url = 'dashboard.php';
} else {
    $link_text = 'Home';
    $link_url = 'index.php';
}

if (isset($_POST['post'])) {
    // Filter inputs for XSS and SQL injection attacks :)
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $link = filter_var($_POST['link'], FILTER_SANITIZE_URL);

    // Get the number of existing blog posts
    $path = 'blogs/';
    $num_files = count(glob($path . "*.txt"));

    // Create a filename using the current date and time and the next number
    date_default_timezone_set('UTC');
    $filename = date('Y-m-d_H-i-s') . '_' . ($num_files + 1) . '.txt';

    // Create the "blogs" directory if it doesn't exist
    if (!is_dir($path)) {
        mkdir($path);
    }

    // Write the form data to a text file in the "blogs" directory
    $file = fopen("blogs/$filename", "w");
    if ($file) {
        // Filter output for XSS attacks
        $title = filter_var($title, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        
        fwrite($file, "<div class='card'>\n");
        fwrite($file, "    <img src='https://via.placeholder.com/800x500.png?text=Blog+Post+" . ($num_files + 1) . "' alt='Blog Post " . ($num_files + 1) . "'>\n");
        fwrite($file, "    <div class='card-content'>\n");
        fwrite($file, "        <h2 class='card-title'>$title</h2>\n");
        fwrite($file, "        <p class='card-description'>$description</p>\n");
        fwrite($file, "        <a href='$link' target='_blank' class='card-read-more'>Read more</a>\n");
        fwrite($file, "    </div>\n");
        fwrite($file, "</div>\n");
        fclose($file);

        // Redirect the user to a blog page
        echo '<script>alert("Publishing post.");window.location.href="blog.php";</script>';
        exit();
    } else {
        // Handle the error
        echo '<script>alert("Error writing file");window.location.href="post.php";</script>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Blog Post | Dashboard</title>
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
          <li><a href="<?php echo $link_url; ?>"><?php echo $link_text; ?></a></li>
          <li><a href="blog.php">Blog</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
      </nav>
    </header>

  <div class="container">
  <div class="form-container">
    <h1>Create a Blog Post</h1>
    <form method="POST">
      <label for="title">Blog Title:</label>
      <input type="text" id="title" name="title" placeholder="Enter your blog title" maxlength="20" required autocomplete="off"/>

      <label for="description">Blog Description:</label>
      <textarea id="description" name="description" placeholder="Enter your blog description" maxlength=160" required autocomplete="off"></textarea>

      <label for="link">Blog Link:</label>
      <input type="url" id="link" name="link" placeholder="Enter your blog link" required autocomplete="off"/>

      <div class="form-actions">
      <input type="submit" name="post" value="Post" />
      </div>
    </form>
  </div>
</div>
<script src="js/main.js" defer></script>
  </body>
</html>
