<?php
session_start();
include 'php/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results - Roast My Resume</title>
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

        <?php if(!isset($_SESSION['resume_id'])): ?>
            <div class="card" style="text-align:center;">
                <h2 style="color:#ff4d4d; margin-bottom:16px;">No Resume Found 😐</h2>
                <p style="color:#aaaaaa; margin-bottom:24px;">Please upload your resume first to get roasted.</p>
                <a href="upload.php" class="btn">Upload Resume →</a>
            </div>

        <?php else: ?>

            <div class="card">
                <h2 style="font-size:24px; color:#ff4d4d; margin-bottom:4px;">
                    The Roast is Ready 🔥
                </h2>
                <p style="color:#aaaaaa; font-size:14px; margin-bottom:24px;">
                    Here's what we found in your resume, <?php echo $_SESSION['resume_name']; ?>.
                </p>

                <!-- Score Section -->
                <div style="display:flex; gap:12px; flex-wrap:wrap; margin-bottom:24px;">
                    <div class="card" style="flex:1; min-width:120px; text-align:center; padding:16px;">
                        <div id="scoreFormat" style="font-size:28px; font-weight:800; color:#ff4d4d;">0</div>
                        <div style="color:#aaaaaa; font-size:12px;">Formatting</div>
                    </div>
                    <div class="card" style="flex:1; min-width:120px; text-align:center; padding:16px;">
                        <div id="scoreContent" style="font-size:28px; font-weight:800; color:#ff4d4d;">0</div>
                        <div style="color:#aaaaaa; font-size:12px;">Content</div>
                    </div>
                    <div class="card" style="flex:1; min-width:120px; text-align:center; padding:16px;">
                        <div id="scoreSkills" style="font-size:28px; font-weight:800; color:#ff4d4d;">0</div>
                        <div style="color:#aaaaaa; font-size:12px;">Skills</div>
                    </div>
                    <div class="card" style="flex:1; min-width:120px; text-align:center; padding:16px;">
                        <div id="scoreOverall" style="font-size:28px; font-weight:800; color:#ff4d4d;">0</div>
                        <div style="color:#aaaaaa; font-size:12px;">Overall</div>
                    </div>
                </div>

                <!-- Roast Messages -->
                <div id="roastBox" style="background:#1a0000; border:1px solid #ff4d4d; border-radius:8px; padding:20px; margin-bottom:24px;">
                    <h3 style="color:#ff4d4d; margin-bottom:12px;">🔥 The Roast</h3>
                    <div id="roastMessages" style="display:flex; flex-direction:column; gap:10px;"></div>
                </div>

                <!-- Tips -->
                <div id="tipsBox" style="background:#001a00; border:1px solid #4dff4d; border-radius:8px; padding:20px; margin-bottom:24px;">
                    <h3 style="color:#4dff4d; margin-bottom:12px;">💡 How to Improve</h3>
                    <div id="tipMessages" style="display:flex; flex-direction:column; gap:10px;"></div>
                </div>

                <div style="display:flex; gap:12px; flex-wrap:wrap;">
                    <a href="upload.php" class="btn">Upload Another →</a>
                    <a href="history.php" class="btn" style="background:#2a2a2a; color:#f0f0f0;">View History →</a>
                </div>
            </div>

            <!-- Pass PHP session data to JS -->
            <script>
                const resumeData = {
                    name:    "<?php echo $_SESSION['resume_name']; ?>",
                    email:   "<?php echo $_SESSION['resume_email']; ?>",
                    jobrole: "<?php echo $_SESSION['resume_jobrole']; ?>",
                    file:    "<?php echo $_SESSION['resume_file']; ?>"
                };
            </script>

        <?php endif; ?>

    </div>

    <!-- Footer -->
    <footer>
        <p>🔥 Roast My Resume &copy; 2024 | Built with HTML, CSS, JS, PHP & MySQL</p>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>