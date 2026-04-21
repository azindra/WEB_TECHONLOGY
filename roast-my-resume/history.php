<?php
session_start();
include 'php/db.php';

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch resumes for logged in user
$email = $_SESSION['user_email'];
$sql   = "SELECT * FROM resumes WHERE email='$email' ORDER BY uploaded_at DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History - Roast My Resume</title>
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

        <!-- Header -->
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
            <div>
                <h2 style="font-size:24px; color:#ff4d4d;">Your Resume History 📋</h2>
                <p style="color:#aaaaaa; font-size:14px;">
                    Welcome back, <?php echo $_SESSION['user_name']; ?>
                </p>
            </div>
            <a href="php/logout.php" class="btn" style="background:#2a2a2a; color:#f0f0f0;">
                Logout
            </a>
        </div>

        <?php if (mysqli_num_rows($result) == 0): ?>
            <div class="card" style="text-align:center;">
                <div style="font-size:48px; margin-bottom:16px;">📭</div>
                <h3 style="margin-bottom:8px;">No resumes yet</h3>
                <p style="color:#aaaaaa; margin-bottom:24px;">
                    You haven't uploaded any resumes yet.
                </p>
                <a href="upload.php" class="btn">Upload Now →</a>
            </div>

        <?php else: ?>
            <div class="card" style="padding:0; overflow:hidden;">
                <table style="width:100%; border-collapse:collapse;">
                    <thead>
                        <tr style="background:#2a2a2a;">
                            <th style="padding:14px 16px; text-align:left; font-size:13px; color:#aaaaaa;">#</th>
                            <th style="padding:14px 16px; text-align:left; font-size:13px; color:#aaaaaa;">Name</th>
                            <th style="padding:14px 16px; text-align:left; font-size:13px; color:#aaaaaa;">Job Role</th>
                            <th style="padding:14px 16px; text-align:left; font-size:13px; color:#aaaaaa;">File</th>
                            <th style="padding:14px 16px; text-align:left; font-size:13px; color:#aaaaaa;">Uploaded</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        while ($row = mysqli_fetch_assoc($result)):
                        ?>
                        <tr style="border-top:1px solid #2a2a2a;">
                            <td style="padding:14px 16px; font-size:14px; color:#aaaaaa;">
                                <?php echo $count++; ?>
                            </td>
                            <td style="padding:14px 16px; font-size:14px;">
                                <?php echo $row['name']; ?>
                            </td>
                            <td style="padding:14px 16px; font-size:14px; color:#aaaaaa;">
                                <?php echo $row['jobrole']; ?>
                            </td>
                            <td style="padding:14px 16px; font-size:14px;">
                                <a href="uploads/<?php echo $row['filename']; ?>"
                                   target="_blank"
                                   style="color:#ff4d4d; text-decoration:none;">
                                    View File →
                                </a>
                            </td>
                            <td style="padding:14px 16px; font-size:14px; color:#aaaaaa;">
                                <?php echo date('d M Y', strtotime($row['uploaded_at'])); ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

    </div>

    <!-- Footer -->
    <footer>
        <p>🔥 Roast My Resume &copy; 2024 | Built with HTML, CSS, JS, PHP & MySQL</p>
    </footer>

</body>
</html>