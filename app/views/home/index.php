<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Kent Shop</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/styles.css">
</head>

<body>
    <div class="welcome-banner">
        <h1 class="welcome-title">Welcome to Kent Shop</h1>
        <p class="welcome-subtitle">Discover the latest products, best deals, and fast delivery.</p>
        <a href="<?= BASE_URL ?>products" class="btn btn-primary btn-large mt-medium">Shop Now</a>
    </div>

    <h2 class="section-heading">Shop by Category</h2>
    <div class="category-container">
        <?php foreach ($categories as $cat): ?>
            <div class="category-box">
                <a href="<?= BASE_URL ?>category/<?= $cat['slug'] ?>" class="category-link">
                    <?= htmlspecialchars($cat['name']) ?>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

    <h2 class="section-heading">Featured Products</h2>

    <div class="product-grid">
        <?php foreach ($featured as $product): ?>
            <div class="product-card">

                <img src="<?= BASE_URL ?>assets/uploads/<?= $product['image'] ?>" alt="<?= $product['name'] ?>"
                    class="product-image">

                <div class="product-card-info">
                    <p class="product-card-name">
                        <?= $product['name'] ?>
                    </p>
                    <p class="product-card-price">$
                        <?= number_format($product['price'], 2) ?>
                    </p>

                    <a href="<?= BASE_URL ?>product/<?= $product['slug'] ?>" class="button-primary full-width">
                        View
                    </a>
                </div>

            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>