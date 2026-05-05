<?php
session_start();
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars(trim($_POST['name']));
    $email   = htmlspecialchars(trim($_POST['email']));
    $address = htmlspecialchars(trim($_POST['address']));
    $payment = htmlspecialchars(trim($_POST['pay']));

    if (!empty($name) && !empty($email) && !empty($address) && !empty($payment)) {

        // Session: store customer name after order
        $_SESSION['order_name'] = $name;

        // Cookie: remember customer name for 30 days
        setcookie('customer_name', $name, time() + (30 * 24 * 60 * 60));

        // Clear cart after order
        unset($_SESSION['cart']);

        $message = "<p style='color:green;'><strong>Order placed successfully!</strong><br>
                    Thank you, $name! Your order will be delivered to: $address.<br>
                    Payment method: $payment.</p>";
    } else {
        $message = "<p style='color:red;'>Please fill in all required fields.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us | ShopEase</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Contact & Checkout</h1>
</header>

<nav>
    <a href="index.php">Home</a> |
    <a href="cart.php">Cart</a>
</nav>

<main>

<?php echo $message; ?>

<form method="POST" action="contact.php">
    <fieldset>
        <legend>Customer Details</legend>

        Name:<br>
        <!-- Cookie: pre-fill name if returning customer -->
        <input type="text" name="name"
               value="<?php echo isset($_COOKIE['customer_name']) ? $_COOKIE['customer_name'] : ''; ?>"
               required><br><br>

        Email:<br>
        <input type="email" name="email" required><br><br>

        Address:<br>
        <textarea name="address" rows="4" required></textarea><br><br>

        Payment Method:<br>
        <input type="radio" name="pay" value="COD" required> COD
        <input type="radio" name="pay" value="UPI"> UPI<br><br>

        <input type="submit" value="Place Order">
    </fieldset>
</form>

</main>

<footer>
    <p>Customer Support: support@shopease.com</p>
</footer>

</body>
</html>
