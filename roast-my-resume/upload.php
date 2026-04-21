<?php
session_start();
include 'php/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Resume - Roast My Resume</title>
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
        <div class="card">
            <h2 style="font-size: 24px; margin-bottom: 8px; color: #ff4d4d;">Upload Your Resume 📄</h2>
            <p style="color: #aaaaaa; font-size: 14px; margin-bottom: 24px;">We accept PDF and DOC files only. Max size: 2MB.</p>

            <!-- Error / Success Messages -->
            <?php if(isset($_SESSION['upload_error'])): ?>
                <div style="background:#2a0000; border:1px solid #ff4d4d; color:#ff4d4d; padding:12px; border-radius:6px; margin-bottom:16px;">
                    <?php echo $_SESSION['upload_error']; unset($_SESSION['upload_error']); ?>
                </div>
            <?php endif; ?>

            <?php if(isset($_SESSION['upload_success'])): ?>
                <div style="background:#002a00; border:1px solid #4dff4d; color:#4dff4d; padding:12px; border-radius:6px; margin-bottom:16px;">
                    <?php echo $_SESSION['upload_success']; unset($_SESSION['upload_success']); ?>
                </div>
            <?php endif; ?>

            <form id="uploadForm" action="php/upload_handler.php" method="POST" enctype="multipart/form-data">

                <label>Your Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your name">

                <label>Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email">

                <label>Job Role Applying For</label>
                <input type="text" id="jobrole" name="jobrole" placeholder="e.g. Software Engineer, Data Analyst">

                <label>Upload Resume (PDF or DOC)</label>
                <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx">

                <!-- Drag and drop area -->
                <div id="dropArea" style="border: 2px dashed #3a3a3a; border-radius: 8px; padding: 30px; text-align: center; margin: 8px 0 16px; cursor: pointer; transition: border-color 0.2s;">
                    <div style="font-size: 32px; margin-bottom: 8px;">📂</div>
                    <p style="color: #aaaaaa; font-size: 14px;">Drag & drop your resume here or click to browse</p>
                    <p id="fileName" style="color: #ff4d4d; font-size: 13px; margin-top: 8px;"></p>
                </div>

                <button type="submit" class="btn" style="width: 100%; font-size: 16px; padding: 14px;">
                    🔥 Roast My Resume
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