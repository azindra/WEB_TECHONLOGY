<?php session_start();
if(!isset($_SESSION['last_visit'])){
    $_SESSION['last_visit'] = date('d-m-Y H:i:s');
    $visit_msg = "Welcome! First time visiting ShopEase.";
} else {
    $visit_msg = "Welcome back! Your last visit was: " . $_SESSION['last_visit'];
    $_SESSION['last_visit'] = date('d-m-Y H:i:s');
}
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopEase | Online Store</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>ShopEase</h1>
    <p>Your One-Stop Online Store</p>
</header>

<nav>
    <a href="index.php">Home</a> |
    <a href="cart.php">Cart
        <?php if(!empty($_SESSION['cart'])) echo "(".count($_SESSION['cart']).")"; ?>
    </a> |
    <a href="contact.php">Contact</a>
</nav>

<hr>

<p style="text-align:center; background:#e3f2fd; padding:8px;">
    🕐 <?php echo $visit_msg; ?>
</p>

<?php if(isset($_SESSION['order_name'])): ?>
<p style="text-align:center; background:#e8f5e9; padding:8px;">
    ✅ Hi <?php echo $_SESSION['order_name']; ?>! Your last order was placed successfully.
</p>
<?php endif; ?>

<main>
<section>
    <h2>Featured Products</h2>
    <?php
    $result = mysqli_query($conn, "SELECT * FROM products");
    while($row = mysqli_fetch_assoc($result)):
    ?>
    <article>
        <figure>
            <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" width="200">
            <figcaption><?php echo $row['name']; ?></figcaption>
        </figure>
        <p>Price: ₹<?php echo number_format($row['price'], 0); ?></p>
        <a href="product.php?id=<?php echo $row['id']; ?>">View Details</a>
    </article>
    <?php endwhile; mysqli_close($conn); ?>
</section>
</main>

<footer>
    <p>&copy; 2026 ShopEase</p>
</footer>

</body>
</html>