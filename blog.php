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

// Read the files in the blogs/ directory
$blog_files = glob('blogs/*.txt');

usort($blog_files, function($a, $b) {
    return filemtime($a) - filemtime($b);
  });
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Blog</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <link rel="stylesheet" href="css/blog.css" />
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
            <div class="title-container">
                <h1>Blog</h1>
            </div>
            <div class="card-container">
                <?php
          // Loop through each blog file and output as a card
          foreach ($blog_files as $blog_file) {
            $blog_content = file_get_contents($blog_file); // Get the content from the file

            echo $blog_content;

          }
          ?>
            </div>
        </div>

        <footer class="footer">
            <p>&copy; 2023 Designed with &hearts; by <a href="#">Neilmark Ochea</a>.</p>
        </footer>
        <script src="js/main.js" defer></script>
    </body>
</html>
