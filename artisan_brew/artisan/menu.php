<?php
require "includes/db.php";
$pageTitle="Café Menu | Artisan Brew Co.";
$groups = [];
$result = $conn->query("SELECT * FROM products ORDER BY FIELD(category,'Dark Roast','Medium Roast','Decaf'), name");
while ($p = $result->fetch_assoc()) {
    $groups[$p['category']][] = $p;
}
require "includes/header.php";
?>
<section class="page-hero dark-hero">
    <p class="eyebrow">CHAPTER 02</p>
    <h1>Café <em>Menu.</em></h1>
    <p>Our coffee menu uses the same products available in our ordering system.</p>
</section>
<section class="section menu-section">
    <div class="menu-intro">
        <p class="eyebrow">BREWED FOR YOUR RITUAL</p>
        <h2>Choose your <em>favorite.</em></h2>
        <p>Every item below comes directly from our coffee collection, so you can add it to your order and continue straight to checkout.</p>
    </div>
    <div class="menu-list">
        <?php foreach ($groups as $category => $items): ?>
            <div class="menu-group">
                <h3><?= htmlspecialchars($category) ?></h3>
                <?php foreach ($items as $p): ?>
                    <div class="menu-item">
                        <div class="menu-item-main">
                            <span class="menu-item-name"><?= htmlspecialchars($p['name']) ?></span>
                            <span class="menu-item-desc"><?= htmlspecialchars($p['description']) ?></span>
                        </div>
                        <div class="menu-item-side">
                            <span class="menu-item-price">$<?= number_format($p['price'], 2) ?></span>
                            <a class="menu-add" href="add_to_cart.php?id=<?= (int)$p['product_id'] ?>">Add to order +</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php require "includes/footer.php"; ?>
