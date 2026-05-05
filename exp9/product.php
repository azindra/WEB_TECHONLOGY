
<?php
include 'db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = mysqli_prepare($conn, "SELECT * FROM products WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "<p>Product not found. <a href='index.php'>Go back</a></p>";
    exit;
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
    <a href="cart.php?id=<?php echo $row['id']; ?>">Add to Cart</a>
</nav>

<main>
<section>
    <figure>
        <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" style="width:250px; height:250px; object-fit:cover;">
        <figcaption><?php echo $row['name']; ?> - Latest Model</figcaption>
    </figure>

    <p><strong>Price:</strong> ₹<?php echo number_format($row['price'], 0); ?></p>
    <p><strong>Description:</strong> <?php echo $row['description']; ?></p>
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

<footer>
    <p>Free Delivery Available</p>
</footer>

<?php mysqli_close($conn); ?>
</body>
</html>