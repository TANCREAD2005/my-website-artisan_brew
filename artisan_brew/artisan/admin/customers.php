<?php require "../includes/db.php";
session_start();
if (empty($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location:../login.php");
    exit;
}
$rows = $conn->query("SELECT user_id,name,email,created_at FROM users WHERE role='customer' ORDER BY user_id DESC");
$pageTitle = "Customers";
require "../includes/header.php"; ?><section class="section admin-section">
    <p class="eyebrow">ADMIN</p>
    <h2>Customers</h2>
    <div class="admin-table"><?php while ($u = $rows->fetch_assoc()): ?><div><span><?= htmlspecialchars($u['name']) ?></span><b><?= htmlspecialchars($u['email']) ?></b><small><?= htmlspecialchars($u['created_at']) ?></small></div><?php endwhile; ?></div>
</section><?php require "../includes/footer.php"; ?>