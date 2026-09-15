<?php
require "../includes/db.php";
session_start();
if (empty($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location:../login.php");
    exit;
}
if (isset($_POST['status'])) {
    $s = $conn->prepare("UPDATE orders SET status=? WHERE order_id=?");
    $s->bind_param("si", $_POST['status'], $_POST['id']);
    $s->execute();
}
$rows = $conn->query("SELECT o.*,u.name FROM orders o JOIN users u ON u.user_id=o.user_id ORDER BY o.order_id DESC");
$pageTitle = "Manage Orders";
require "../includes/header.php"; ?>
<section class="section admin-section">
    <p class="eyebrow">ADMIN</p>
    <h2>Orders</h2>
    <div class="admin-table"><?php while ($o = $rows->fetch_assoc()): ?><div><span>#<?= $o['order_id'] ?> · <?= htmlspecialchars($o['name']) ?></span><b>$<?= number_format($o['total_amount'], 2) ?></b>
                <form method="post"><input type="hidden" name="id" value="<?= $o['order_id'] ?>"><select name="status" onchange="this.form.submit()"><?php foreach (["Pending", "Processing", "Completed", "Cancelled"] as $st): ?><option <?= $o['status'] === $st ? 'selected' : '' ?>><?= $st ?></option><?php endforeach; ?></select></form>
            </div><?php endwhile; ?></div>
</section><?php require "../includes/footer.php"; ?>