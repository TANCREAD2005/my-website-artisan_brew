<?php
require "../includes/db.php";
session_start();
if (empty($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location:../login.php");
    exit;
}
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $s = $conn->prepare("DELETE FROM products WHERE product_id=?");
    $s->bind_param("i", $id);
    $s->execute();
    header("Location:products.php");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $s = $conn->prepare("INSERT INTO products(name,category,price,description,image) VALUES(?,?,?,?,?)");
    $s->bind_param("ssdss", $_POST['name'], $_POST['category'], $_POST['price'], $_POST['description'], $_POST['image']);
    $s->execute();
    header("Location:products.php");
    exit;
}
$rows = $conn->query("SELECT * FROM products ORDER BY product_id DESC");
$pageTitle = "Manage Products";
require "../includes/header.php"; ?>
<section class="section admin-section">
    <p class="eyebrow">ADMIN</p>
    <h2>Products</h2>
    <div class="admin-form">
        <form method="post"><input name="name" placeholder="Product name" required><select name="category">
                <option>Dark Roast</option>
                <option>Medium Roast</option>
                <option>Decaf</option>
            </select><input name="price" type="number" step=".01" placeholder="Price" required><input name="image" value="hero-coffee.svg" required><textarea name="description" placeholder="Description" required></textarea><button class="btn dark">Add Product</button></form>
    </div>
    <div class="admin-table"><?php while ($p = $rows->fetch_assoc()): ?><div><span><?= htmlspecialchars($p['name']) ?></span><b>$<?= number_format($p['price'], 2) ?></b><a href="?delete=<?= $p['product_id'] ?>" onclick="return confirm('Delete this product?')">Delete</a></div><?php endwhile; ?></div>
</section><?php require "../includes/footer.php"; ?>