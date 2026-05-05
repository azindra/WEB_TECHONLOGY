<?php
session_start();

// Clear cart if requested
if (isset($_GET['clear'])) {
    unset($_SESSION['cart']);
    header("Location: cart.php");
    exit;
}

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = array_sum(array_column($cart, 'price'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart | ShopEase</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Your Shopping Cart</h1>
</header>

<nav>
    <a href="index.php">Home</a> |
    <a href="contact.php">Checkout</a>
</nav>

<main>
<section>
    <?php if (!empty($cart)): ?>
    <table border="1">
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>
        <?php foreach ($cart as $item): ?>
        <tr>
            <td><?php echo $item['name']; ?></td>
            <td>₹<?php echo number_format($item['price'], 0); ?></td>
            <td>1</td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="cart.php?clear=1"
       style="padding:8px 14px; background:#e53935; color:white; border-radius:5px; text-decoration:none;">
       🗑️ Clear Cart
    </a>
    <?php else: ?>
        <p>Your cart is empty. <a href="index.php">Continue Shopping</a></p>
    <?php endif; ?>
</section>
</main>

<footer>
    <p>Total Amount: ₹<?php echo number_format($total, 0); ?></p>
</footer>

</body>
</html>