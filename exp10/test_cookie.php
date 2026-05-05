<?php
// Test if cookies work
setcookie('test_cookie', 'hello', time() + 3600);
?>
<!DOCTYPE html>
<html>
<body>

<?php
if (isset($_COOKIE['test_cookie'])) {
    echo "<p style='color:green;'>✅ Cookie is WORKING! Value: " . $_COOKIE['test_cookie'] . "</p>";
} else {
    echo "<p style='color:red;'>❌ Cookie NOT working yet. Refresh the page once.</p>";
}
?>

</body>
</html>