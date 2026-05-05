<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact | Ashika</title>
    <link rel="stylesheet" href="style.css">

    <style>
        .error {
            color: red;
            font-size: 13px;
        }

        .success-msg {
            color: green;
            font-weight: bold;
            font-size: 15px;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="email"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #222;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #444;
        }

        fieldset {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
        }
    </style>
</head>

<body>

<header>
    <h1>Contact Me</h1>
</header>

<nav>
    <a href="index.html">Home</a>
    <a href="about.html">About</a>
    <a href="skills.html">Skills</a>
</nav>

<section>
    <h2>Get in Touch</h2>
    <p>You can contact me for learning discussions, collaboration, or general queries.</p>
</section>

<section>

    <?php
    // =============================================
    // PHP FORM HANDLING & VALIDATION - Exercise 1
    // =============================================

    $nameErr    = $emailErr = $phoneErr = $reasonErr = $messageErr = "";
    $name       = $email = $phone = $reason = $message = "";
    $successMsg = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // --- Name Validation ---
        if (empty($_POST["name"])) {
            $nameErr = "❌ Name is required.";
        } else {
            $name = trim($_POST["name"]);
            if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
                $nameErr = "❌ Name must contain only letters.";
            }
        }

        // --- Email Validation ---
        if (empty($_POST["email"])) {
            $emailErr = "❌ Email is required.";
        } else {
            $email = trim($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "❌ Enter a valid email (e.g. name@email.com).";
            }
        }

        // --- Phone Validation ---
        if (empty($_POST["phone"])) {
            $phoneErr = "❌ Phone number is required.";
        } else {
            $phone = trim($_POST["phone"]);
            if (!preg_match("/^\d{10}$/", $phone)) {
                $phoneErr = "❌ Phone must be exactly 10 digits.";
            }
        }

        // --- Reason Validation ---
        if (empty($_POST["reason"]) || $_POST["reason"] == "") {
            $reasonErr = "❌ Please select a reason.";
        } else {
            $reason = $_POST["reason"];
        }

        // --- Message Validation ---
        if (empty($_POST["message"])) {
            $messageErr = "❌ Message cannot be empty.";
        } else {
            $message = trim($_POST["message"]);
            if (strlen($message) > 200) {
                $messageErr = "❌ Message must be under 200 characters.";
            }
        }

        // --- If All Valid, Show Success ---
        if ($nameErr == "" && $emailErr == "" && $phoneErr == "" && $reasonErr == "" && $messageErr == "") {
            $successMsg = "✅ Thank you, " . htmlspecialchars($name) . "! Your message has been submitted successfully.";

            // Reset fields after success
            $name = $email = $phone = $reason = $message = "";
        }
    }
    ?>

    <form id="contactForm" method="POST" action="contact.php">
        <fieldset>
            <legend>Contact Form</legend>

            <!-- Name Field -->
            Name:<br>
            <input type="text" name="name" placeholder="Enter your full name"
                   value="<?php echo htmlspecialchars($name); ?>"><br>
            <span class="error"><?php echo $nameErr; ?></span><br>

            <!-- Email Field -->
            Email:<br>
            <input type="email" name="email" placeholder="Enter your email"
                   value="<?php echo htmlspecialchars($email); ?>"><br>
            <span class="error"><?php echo $emailErr; ?></span><br>

            <!-- Phone Field -->
            Phone:<br>
            <input type="text" name="phone" placeholder="Enter 10-digit phone number"
                   value="<?php echo htmlspecialchars($phone); ?>"><br>
            <span class="error"><?php echo $phoneErr; ?></span><br>

            <!-- Reason Dropdown -->
            Reason:<br>
            <select name="reason">
                <option value="">-- Select a Reason --</option>
                <option value="Learning"  <?php if($reason=="Learning")  echo "selected"; ?>>Learning</option>
                <option value="Project"   <?php if($reason=="Project")   echo "selected"; ?>>Project</option>
                <option value="Other"     <?php if($reason=="Other")     echo "selected"; ?>>Other</option>
            </select><br>
            <span class="error"><?php echo $reasonErr; ?></span><br>

            <!-- Message Field -->
            Message:<br>
            <textarea name="message" rows="4"
                      placeholder="Write your message here (max 200 characters)..."><?php echo htmlspecialchars($message); ?></textarea><br>
            <span class="error"><?php echo $messageErr; ?></span><br>

            <!-- Submit Button -->
            <input type="submit" value="Send Message">

            <!-- Success Message -->
            <?php if ($successMsg != ""): ?>
                <p class="success-msg"><?php echo $successMsg; ?></p>
            <?php endif; ?>

        </fieldset>
    </form>

</section>

<footer>
    <p>Email: ashika@example.com</p>
</footer>

</body>
</html>