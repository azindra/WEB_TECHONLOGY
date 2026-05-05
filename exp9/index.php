<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopEase | Online Store</title>
    <link rel="stylesheet" href="style.css">
    <meta name="description" content="ShopEase is a static e-commerce website built using advanced HTML.">
</head>
<body>

<header>
    <h1>ShopEase</h1>
    <p>Your One-Stop Online Store</p>
</header>

<nav>
    <a href="index.php">Home</a> |
    <a href="cart.php">Cart</a> |
    <a href="contact.php">Contact</a>
</nav>

<hr>

<main>
<section>
    <h2>Featured Products</h2>

    <?php
    $result = mysqli_query($conn, "SELECT * FROM products");

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <article>
        <figure>
            <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" style="width:200px; height:200px; object-fit:cover;">
            <figcaption><?php echo $row['name']; ?></figcaption>
        </figure>
        <p>Price: ₹<?php echo number_format($row['price'], 0); ?></p>
        <a href="product.php?id=<?php echo $row['id']; ?>">View Details</a>
    </article>
    <?php
        }
    } else {
        echo "<p>No products found. <a href='insert.php'>Click here to add products.</a></p>";
    }

    mysqli_close($conn);
    ?>

</section>
</main>

<footer>
    <p>&copy; 2026 ShopEase</p>
</footer>

</body>
</html>
