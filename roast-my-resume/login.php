<?php
session_start();
include 'php/db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $action   = $_POST['action'];
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    if ($action == 'login') {

        $sql    = "SELECT * FROM users WHERE email='$email' LIMIT 1";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id']   = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email']= $user['email'];

                // Set cookie for 7 days
                setcookie('user_email', $email, time() + (7 * 24 * 60 * 60), '/');

                header("Location: history.php");
                exit();
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "No account found with that email.";
        }

    } elseif ($action == 'register') {

        $name            = mysqli_real_escape_string($conn, $_POST['name']);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
        if (mysqli_num_rows($check) > 0) {
            $error = "Email already registered. Please login.";
        } else {
            $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
            if (mysqli_query($conn, $sql)) {
                $success = "Account created! You can now login.";
            } else {
                $error = "Registration failed. Try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Roast My Resume</title>
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
        <div class="card" style="max-width:480px; margin:0 auto;">

            <!-- Tabs -->
            <div style="display:flex; gap:0; margin-bottom:24px; border-bottom:1px solid #2a2a2a;">
                <button id="tabLogin" onclick="switchTab('login')"
                    style="flex:1; padding:12px; background:none; border:none; color:#ff4d4d;
                           font-size:15px; cursor:pointer; border-bottom:2px solid #ff4d4d;">
                    Login
                </button>
                <button id="tabRegister" onclick="switchTab('register')"
                    style="flex:1; padding:12px; background:none; border:none; color:#aaaaaa;
                           font-size:15px; cursor:pointer; border-bottom:2px solid transparent;">
                    Register
                </button>
            </div>

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

            <!-- Login Form -->
            <div id="loginForm">
                <form method="POST">
                    <input type="hidden" name="action" value="login">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Enter your email"
                           value="<?php echo isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : ''; ?>">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter your password">
                    <button type="submit" class="btn" style="width:100%; margin-top:8px;">
                        Login →
                    </button>
                </form>
            </div>

            <!-- Register Form -->
            <div id="registerForm" style="display:none;">
                <form method="POST">
                    <input type="hidden" name="action" value="register">
                    <label>Full Name</label>
                    <input type="text" name="name" placeholder="Enter your full name">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Enter your email">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Create a password">
                    <button type="submit" class="btn" style="width:100%; margin-top:8px;">
                        Create Account →
                    </button>
                </form>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>🔥 Roast My Resume &copy; 2024 | Built with HTML, CSS, JS, PHP & MySQL</p>
    </footer>

    <script>
        function switchTab(tab) {
            if (tab === 'login') {
                document.getElementById('loginForm').style.display    = 'block';
                document.getElementById('registerForm').style.display = 'none';
                document.getElementById('tabLogin').style.color       = '#ff4d4d';
                document.getElementById('tabLogin').style.borderBottom= '2px solid #ff4d4d';
                document.getElementById('tabRegister').style.color    = '#aaaaaa';
                document.getElementById('tabRegister').style.borderBottom = '2px solid transparent';
            } else {
                document.getElementById('loginForm').style.display    = 'none';
                document.getElementById('registerForm').style.display = 'block';
                document.getElementById('tabRegister').style.color    = '#ff4d4d';
                document.getElementById('tabRegister').style.borderBottom = '2px solid #ff4d4d';
                document.getElementById('tabLogin').style.color       = '#aaaaaa';
                document.getElementById('tabLogin').style.borderBottom= '2px solid transparent';
            }
        }
    </script>

</body>
</html>