<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name    = mysqli_real_escape_string($conn, $_POST['name']);
    $email   = mysqli_real_escape_string($conn, $_POST['email']);
    $jobrole = mysqli_real_escape_string($conn, $_POST['jobrole']);
    $file    = $_FILES['resume'];

    // Validation
    if (empty($name) || empty($email) || empty($jobrole)) {
        $_SESSION['upload_error'] = "Please fill in all fields.";
        header("Location: ../upload.php");
        exit();
    }

    if ($file['size'] == 0) {
        $_SESSION['upload_error'] = "Please upload a resume file.";
        header("Location: ../upload.php");
        exit();
    }

    // Check file type
    $allowed = ['pdf', 'doc', 'docx'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        $_SESSION['upload_error'] = "Only PDF, DOC, DOCX files are allowed.";
        header("Location: ../upload.php");
        exit();
    }

    // Check file size (max 2MB)
    if ($file['size'] > 2 * 1024 * 1024) {
        $_SESSION['upload_error'] = "File size must be under 2MB.";
        header("Location: ../upload.php");
        exit();
    }

    // Save file
    $newFileName = time() . '_' . basename($file['name']);
    $uploadPath  = '../uploads/' . $newFileName;

    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {

        // Save to database
        $sql = "INSERT INTO resumes (name, email, jobrole, filename, uploaded_at)
                VALUES ('$name', '$email', '$jobrole', '$newFileName', NOW())";

        if (mysqli_query($conn, $sql)) {
            $resume_id = mysqli_insert_id($conn);
            $_SESSION['resume_id']      = $resume_id;
            $_SESSION['resume_name']    = $name;
            $_SESSION['resume_email']   = $email;
            $_SESSION['resume_jobrole'] = $jobrole;
            $_SESSION['resume_file']    = $newFileName;
            $_SESSION['upload_success'] = "Resume uploaded successfully!";
            header("Location: ../results.php");
            exit();
        } else {
            $_SESSION['upload_error'] = "Database error: " . mysqli_error($conn);
            header("Location: ../upload.php");
            exit();
        }

    } else {
        $_SESSION['upload_error'] = "Failed to upload file. Check folder permissions.";
        header("Location: ../upload.php");
        exit();
    }

} else {
    header("Location: ../upload.php");
    exit();
}
?>