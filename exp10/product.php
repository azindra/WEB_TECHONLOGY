<?php
session_start();
include 'db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$result = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "<p>Product not found. <a href='index.php'>Go back</a></p>";
    exit;
}

// Cookie: store last viewed product name (expires in 1 day)
setcookie('last_viewed', $row['name'], time() + 86400);

// Session: Add to cart when button clicked
if (isset($_POST['add_to_cart'])) {
    $_SESSION['cart'][] = [
        'id'    => $row['id'],
        'name'  => $row['name'],
        'price' => $row['price']
    ];
    $cart_msg = "✅ " . $row['name'] . " added to cart!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $row['name']; ?> | ShopEase</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1><?php echo $row['name']; ?></h1>
</header>

<nav>
    <a href="index.php">Home</a> |
    <a href="cart.php">Cart
        <?php if (!empty($_SESSION['cart'])) echo "(" . count($_SESSION['cart']) . ")"; ?>
    </a>
</nav>

<main>
<section>

    <?php if (isset($cart_msg)): ?>
        <p style="color:green; text-align:center;"><?php echo $cart_msg; ?></p>
    <?php endif; ?>

    <!-- Cookie: Show last viewed -->
    <?php if (isset($_COOKIE['last_viewed']) && $_COOKIE['last_viewed'] != $row['name']): ?>
        <p style="background:#fff9c4; padding:8px; text-align:center;">
            👁️ You last viewed: <strong><?php echo $_COOKIE['last_viewed']; ?></strong>
        </p>
    <?php endif; ?>

    <figure>
        <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" width="250">
        <figcaption><?php echo $row['name']; ?> - Latest Model</figcaption>
    </figure>

    <p><strong>Price:</strong> ₹<?php echo number_format($row['price'], 0); ?></p>
    <p><strong>Description:</strong> <?php echo $row['description']; ?></p>

    <!-- Add to Cart Form -->
    <form method="POST">
        <input type="submit" name="add_to_cart" value="Add to Cart 🛒"
               style="padding:10px 20px; background:#1e88e5; color:white; border:none; border-radius:5px; cursor:pointer;">
    </form>

</section>

<section>
    <details>
        <summary>Product Specifications</summary>
        <ul>
            <li>RAM: <?php echo $row['ram']; ?></li>
            <li>Storage: <?php echo $row['storage']; ?></li>
            <li>Battery: <?php echo $row['battery']; ?></li>
        </ul>
    </details>
</section>
</main>

<footer><p>Free Delivery Available</p></footer>

<?php mysqli_close($conn); ?>
</body>
</html>