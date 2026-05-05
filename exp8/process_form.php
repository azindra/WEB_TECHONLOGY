<?php
// =============================================
// process_form.php
// Handles form data after submission
// =============================================

// Only run if form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $errors = [];

    // --- Sanitize & Validate Name ---
    $name = trim($_POST["name"]);
    if (empty($name)) {
        $errors[] = "Name is required.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        $errors[] = "Name must contain only letters.";
    }

    // --- Sanitize & Validate Email ---
    $email = trim($_POST["email"]);
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // --- Sanitize & Validate Phone ---
    $phone = trim($_POST["phone"]);
    if (empty($phone)) {
        $errors[] = "Phone number is required.";
    } elseif (!preg_match("/^\d{10}$/", $phone)) {
        $errors[] = "Phone must be exactly 10 digits.";
    }

    // --- Validate Reason ---
    $reason = $_POST["reason"];
    if (empty($reason)) {
        $errors[] = "Please select a reason.";
    }

    // --- Sanitize & Validate Message ---
    $message = trim($_POST["message"]);
    if (empty($message)) {
        $errors[] = "Message cannot be empty.";
    } elseif (strlen($message) > 200) {
        $errors[] = "Message must be under 200 characters.";
    }

    // --- Show Result ---
    if (!empty($errors)) {
        echo "<h2 style='color:red;'>Form Errors:</h2>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li style='color:red;'>❌ " . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
        echo "<a href='contact.php'>Go Back</a>";
    } else {
        echo "<h2 style='color:green;'>✅ Form Submitted Successfully!</h2>";
        echo "<p><strong>Name:</strong> "    . htmlspecialchars($name)    . "</p>";
        echo "<p><strong>Email:</strong> "   . htmlspecialchars($email)   . "</p>";
        echo "<p><strong>Phone:</strong> "   . htmlspecialchars($phone)   . "</p>";
        echo "<p><strong>Reason:</strong> "  . htmlspecialchars($reason)  . "</p>";
        echo "<p><strong>Message:</strong> " . htmlspecialchars($message) . "</p>";
        echo "<a href='contact.php'>Go Back</a>";
    }

} else {
    // If someone opens process_form.php directly
    header("Location: contact.php");
    exit();
}
?>