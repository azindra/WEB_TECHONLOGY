<?php
session_start();
include 'php/db.php';

$success = '';
$error   = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name    = mysqli_real_escape_string($conn, $_POST['name']);
    $email   = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    if (empty($name) || empty($email) || empty($message)) {
        $error = "Please fill in all fields.";
    } else {
        $sql = "INSERT INTO contacts (name, email, message, sent_at)
                VALUES ('$name', '$email', '$message', NOW())";
        if (mysqli_query($conn, $sql)) {
            $success = "Message sent successfully! We'll get back to you soon.";
        } else {
            $error = "Something went wrong. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Roast My Resume</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- Navbar -->
    <nav>
        <div class="logo">🔥 Roast My Resume</div>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="upload.php">Upload</a></li>
            <li><a href="results.php">Results</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="history.php">History</a></li>
            <li><a href="about.php">About</a></li>
        </ul>
    </nav>

    <div class="container">

        <!-- About Section -->
        <div class="card" style="margin-bottom:20px;">
            <h2 style="font-size:24px; color:#ff4d4d; margin-bottom:16px;">About This Project 🔥</h2>
            <p style="color:#aaaaaa; font-size:15px; line-height:1.8; margin-bottom:12px;">
                Roast My Resume is a web application built as a Capstone Project for the
                Web Technologies course (23CSE404). It allows users to upload their resumes
                and receive honest, rule-based feedback on formatting, content, and skills.
            </p>
            <p style="color:#aaaaaa; font-size:15px; line-height:1.8;">
                The project demonstrates the use of HTML, CSS, JavaScript, PHP, and MySQL
                working together as a full-stack web application.
            </p>
        </div>

        <!-- Technologies Used -->
        <div class="card" style="margin-bottom:20px;">
            <h2 style="font-size:20px; color:#ff4d4d; margin-bottom:16px;">Technologies Used</h2>
            <div style="display:flex; gap:12px; flex-wrap:wrap;">
                <div style="background:#2a2a2a; padding:10px 18px; border-radius:6px; font-size:14px;">HTML5</div>
                <div style="background:#2a2a2a; padding:10px 18px; border-radius:6px; font-size:14px;">CSS3</div>
                <div style="background:#2a2a2a; padding:10px 18px; border-radius:6px; font-size:14px;">JavaScript</div>
                <div style="background:#2a2a2a; padding:10px 18px; border-radius:6px; font-size:14px;">PHP</div>
                <div style="background:#2a2a2a; padding:10px 18px; border-radius:6px; font-size:14px;">MySQL</div>
                <div style="background:#2a2a2a; padding:10px 18px; border-radius:6px; font-size:14px;">GitHub</div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="card">
            <h2 style="font-size:20px; color:#ff4d4d; margin-bottom:8px;">Contact Us 📬</h2>
            <p style="color:#aaaaaa; font-size:14px; margin-bottom:20px;">
                Have feedback or questions? Drop us a message.
            </p>

            <?php if($error): ?>
                <div style="background:#2a0000; border:1px solid #ff4d4d; color:#ff4d4d;
                            padding:12px; border-radius:6px; margin-bottom:16px;">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <?php if($success): ?>
                <div style="background:#002a00; border:1px solid #4dff4d; color:#4dff4d;
                            padding:12px; border-radius:6px; margin-bottom:16px;">
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>

            <form method="POST" id="contactForm">
                <label>Your Name</label>
                <input type="text" name="name" id="contactName" placeholder="Enter your name">

                <label>Email Address</label>
                <input type="email" name="email" id="contactEmail" placeholder="Enter your email">

                <label>Message</label>
                <textarea name="message" id="contactMessage" rows="5"
                          placeholder="Write your message here..."
                          style="resize:vertical;"></textarea>

                <button type="submit" class="btn" style="width:100%; margin-top:8px;">
                    Send Message →
                </button>
            </form>
        </div>

    </div>

    <!-- Footer -->
    <footer>
        <p>🔥 Roast My Resume &copy; 2024 | Built with HTML, CSS, JS, PHP & MySQL</p>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>