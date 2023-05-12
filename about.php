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
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>About Us</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <link rel="stylesheet" href="css/about.css" />
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
            <div class="title">
                <h1>About Us</h1>
            </div>
            <div class="content">
                <p>
                    Ocademy is a comprehensive website that serves as a one-stop-shop for individuals interested in learning about programming languages and web development technologies. It offers a vast collection of tutorials, articles,
                    and video guides that cater to both experienced developers and beginners. The website covers a variety of web development technologies, including HTML, CSS, JavaScript, PHP, SQL, and more.<br />
                    <br />

                    One of the primary advantages of Ocademy is its comprehensive coverage of various programming languages, making it a trusted source for developers who want to create websites, web applications, and mobile apps.
                    Additionally, Ocademy offers a program that provides a platform for developers to showcase their web development skills and expertise. Although not officially associated with W3C, Ocademy remains a valuable resource for
                    many in the web development community.<br />
                    <br />

                    By providing access to a wealth of information and resources, Ocademy can help developers improve their coding skills, expand their knowledge base, and stay up-to-date with the latest web development trends and
                    technologies. Whether you are an experienced developer or a beginner looking to learn more about web development, Ocademy is a valuable resource that you should not overlook
                </p>

                <a href="#team" class="next"><i class="fas fa-angle-down"></i></a>
            </div>
        </div>

        <div id="team" class="container">
            <div class="title">
                <h1>Our Team</h1>
            </div>
            <div class="content">
                <div class="card">
                    <img src="image/nmo.jpg" alt="Neilmark Ochea" />
                    <h2>Neilmark Ochea</h2>
                    <h3>Frontend Developer</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed gravida ante vitae mi ullamcorper faucibus.</p>
                    <div class="contact email">
                        <span>Email:</span>
                        <a href="mailto:ocheaneilmark1@gmail.com">
                            <i class="fas fa-envelope"></i>
                            ocheaneilmark1@gmail.com
                        </a>
                    </div>
                    <div class="contact phone">
                        <span>Phone:</span>
                        <a href="tel:+639071184837">
                            <i class="fas fa-phone"></i>
                            +639 (304) 887-909
                        </a>
                    </div>
                </div>

                <div class="card">
                    <img src="image/nmo.jpg" alt="Neilmark Ochea" />
                    <h2>Neilmark Ochea</h2>
                    <h3>Mobile Developer</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed gravida ante vitae mi ullamcorper faucibus.</p>
                    <div class="contact email">
                        <span>Email:</span>
                        <a href="mailto:ocheaneilmark1@gmail.com">
                            <i class="fas fa-envelope"></i>
                            ocheaneilmark1@gmail.com
                        </a>
                    </div>
                    <div class="contact phone">
                        <span>Phone:</span>
                        <a href="tel:+639071184837">
                            <i class="fas fa-phone"></i>
                            +639 (304) 887-909
                        </a>
                    </div>
                </div>

                <div class="card">
                    <img src="image/nmo.jpg" alt="Neilmark Ochea" />
                    <h2>Neilmark Ochea</h2>
                    <h3>Backend Developer</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed gravida ante vitae mi ullamcorper faucibus.</p>
                    <div class="contact email">
                        <span>Email:</span>
                        <a href="mailto:ocheaneilmark1@gmail.com">
                            <i class="fas fa-envelope"></i>
                            ocheaneilmark1@gmail.com
                        </a>
                    </div>
                    <div class="contact phone">
                        <span>Phone:</span>
                        <a href="tel:+639071184837">
                            <i class="fas fa-phone"></i>
                            +639 (304) 887-909
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <p>&copy; 2023 Designed with &hearts; by <a href="#">Neilmark Ochea</a>.</p>
        </footer>
        <script src="js/main.js" defer></script>
    </body>
</html>
