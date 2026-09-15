<?php
require "../includes/db.php";
session_start();
if (empty($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location:../login.php");
    exit;
}
$products = $conn->query("SELECT COUNT(*) c FROM products")->fetch_assoc()['c'];
$orders = $conn->query("SELECT COUNT(*) c FROM orders")->fetch_assoc()['c'];
$customers = $conn->query("SELECT COUNT(*) c FROM users WHERE role='customer'")->fetch_assoc()['c'];
$revenue = $conn->query("SELECT COALESCE(SUM(total_amount),0) t FROM orders")->fetch_assoc()['t'];
$pageTitle = "Admin Dashboard";
require "../includes/header.php"; ?>
<section class="page-hero dark-hero">
    <p class="eyebrow">MANAGEMENT</p>
    <h1>Admin <em>Dashboard.</em></h1>
</section>
<section class="section admin-section">
    <div class="admin-grid">
        <div><span>PRODUCTS</span><b><?= $products ?></b></div>
        <div><span>ORDERS</span><b><?= $orders ?></b></div>
        <div><span>CUSTOMERS</span><b><?= $customers ?></b></div>
        <div><span>REVENUE</span><b>$<?= number_format($revenue, 2) ?></b></div>
    </div>
    <div class="admin-links"><a href="products.php">Manage Products →</a><a href="orders.php">Manage Orders →</a><a href="customers.php">Customers →</a></div>
</section><?php require "../includes/footer.php"; ?>