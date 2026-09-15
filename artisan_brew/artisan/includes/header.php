<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$cartCount = array_sum($_SESSION['cart'] ?? []);
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= htmlspecialchars($pageTitle ?? "Artisan Brew Co.") ?></title>
<link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<header class="site-header">
<a class="brand" href="index.php">ARTISAN BREW CO.<small>EST. 1998</small></a>
<button class="menu-toggle">☰</button>
<nav class="nav"><a href="index.php">Home</a><a href="products.php">Our Coffee</a><a href="menu.php">Café Menu</a><a href="index.php#story">Our Story</a><a href="index.php#club">Coffee Club</a><a href="contact.php">Contact</a></nav>
<div class="header-actions"><a href="cart.php">Cart <span class="cart-count"><?= (int)$cartCount ?></span></a><?php if(isset($_SESSION['user'])):?><a class="nav-order" href="logout.php">Logout</a><?php else:?><a class="nav-order" href="login.php">Login</a><?php endif;?></div>
</header><main>