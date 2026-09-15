<?php
$pageTitle="Artisan Brew Co. | Brew Coffee";
require "includes/header.php";
require "includes/db.php";
$featured=$conn->query("SELECT * FROM products ORDER BY product_id LIMIT 3");
?>
<section class="hero">
    <div class="hero-copy">
        <p class="eyebrow">ARTISAN BREW CO. · EST. 1998</p>
        <h1>Brew<br><em>Coffee.</em></h1>
        <p class="lead">Premium roasts, carefully sourced beans, and crafted coffee for slow, memorable moments.</p>
        <div class="actions">
            <a class="btn dark" href="products.php">Explore Our Coffee</a>
            <a class="text-link" href="menu.php">View Café Menu →</a>
        </div>
    </div>
    <div class="hero-image"><img src="assets/images/hero-coffee.svg" alt="Freshly brewed artisan coffee"></div>
</section>

<section class="section intro">
    <div><p class="eyebrow">CRAFTING THE PERFECT CUP</p><h2>Good coffee starts<br>with good care.</h2></div>
    <p class="muted">Every bean is roasted with purpose. From ethical sourcing to small-batch roasting, we keep the process thoughtful so every cup tastes rich, balanced, and distinctly ours.</p>
</section>

<section class="roast-strip">
    <div><span>01</span><strong>Light Roast</strong><small>Floral · Citrus · Bright</small></div>
    <div class="selected"><span>02</span><strong>Medium Roast</strong><small>Balanced · Sweet · Smooth</small></div>
    <div><span>03</span><strong>Dark Roast</strong><small>Bold · Smoky · Deep</small></div>
</section>

<section class="section">
    <div class="section-heading">
        <div><p class="eyebrow">CHAPTER 01</p><h2>Our Premium Beans</h2></div>
        <p class="muted">Fresh coffee selected for different roast preferences and daily rituals.</p>
    </div>
    <div class="product-grid">
        <?php while($p=$featured->fetch_assoc()): ?>
        <article class="product-card">
            <div class="product-photo"><img src="assets/images/<?=htmlspecialchars($p['image'])?>" alt="<?=htmlspecialchars($p['name'])?>"></div>
            <div class="product-info">
                <span class="tag"><?=htmlspecialchars(strtoupper($p['category']))?></span>
                <h3><?=htmlspecialchars($p['name'])?></h3>
                <p><?=htmlspecialchars($p['description'])?></p>
                <div class="product-bottom"><strong>$<?=number_format($p['price'],2)?></strong><a class="add-link" href="add_to_cart.php?id=<?=$p['product_id']?>">Add to order</a></div>
            </div>
        </article>
        <?php endwhile; ?>
    </div>
</section>

<section class="section story" id="story">
    <div class="story-image"><img src="assets/images/hero-coffee.svg" alt="Coffee craft"></div>
    <div><p class="eyebrow">FROM FARM TO CUP</p><h2>The art is in every step.</h2><p class="muted">We choose beans with character and freshness, then roast them in small batches to bring out the qualities that make every origin special.</p><div class="stats"><div><b>25+</b><span>Origins explored</span></div><div><b>26</b><span>Years of craft</span></div><div><b>100%</b><span>Carefully sourced</span></div></div></div>
</section>

<section class="club" id="club">
    <div><p class="eyebrow">JOIN THE COFFEE CLUB</p><h2>Fresh roasts,<br>delivered straight to you.</h2><p>Get fresh coffee delivered every month plus limited-edition beans and member perks.</p></div>
    <a class="btn light" href="register.php">Join the Club</a>
</section>
<?php require "includes/footer.php"; ?>
