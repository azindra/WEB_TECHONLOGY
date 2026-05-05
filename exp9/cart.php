<?php
include 'db.php';

// For this exercise, cart shows the first product (id=1) as a demo
$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$result = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");
$row = mysqli_fetch_assoc($result);
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
    <?php if ($row): ?>
    <table border="1">
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td>₹<?php echo number_format($row['price'], 0); ?></td>
            <td>1</td>
        </tr>
    </table>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</section>
</main>

<footer>
    <?php if ($row): ?>
    <p>Total Amount: ₹<?php echo number_format($row['price'], 0); ?></p>
    <?php endif; ?>
</footer>

<?php mysqli_close($conn); ?>
</body>
</html>
