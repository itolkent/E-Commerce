<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $product['name'] ?> - Kent Shop</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/styles.css">
</head>

<body>

    <div class="product-page">

        <div class="product-layout">

            <!-- PRODUCT IMAGE -->
            <div class="product-image-section">
                <img src="<?= BASE_URL ?>assets/uploads/<?= $product['image'] ?>" alt="<?= $product['name'] ?>"
                    class="product-main-image">
            </div>

            <!-- PRODUCT INFO -->
            <div class="product-info-section">
                <h1 class="product-title"><?= $product['name'] ?></h1>

                <p class="product-price">£<?= number_format($product['price'], 2) ?></p>

                <p class="product-description">
                    <?= nl2br($product['description']) ?>
                </p>

                <p class="product-stock">
                    <?= $product['stock'] > 0 ? "In Stock" : "Out of Stock" ?>
                </p>

                <?php if ($product['stock'] > 0): ?>
                    <a href="<?= BASE_URL ?>cart/add/<?= $product['id'] ?>" class="button-secondary">
                        Add to Cart
                    </a>
                <?php endif; ?>
            </div>

        </div>

        <!-- RELATED PRODUCTS -->
        <h2 class="section-title">Related Products</h2>

        <div class="related-products">
            <?php foreach ($related as $item): ?>
                <div class="related-product-card">

                    <img src="<?= BASE_URL ?>assets/uploads/<?= $item['image'] ?>" alt="<?= $item['name'] ?>"
                        class="related-product-image">

                    <div class="related-product-info">
                        <p class="related-product-name"><?= $item['name'] ?></p>
                        <p class="related-product-price">£<?= number_format($item['price'], 2) ?></p>

                        <a href="<?= BASE_URL ?>product/<?= $item['slug'] ?>" class="button-secondary ">
                            View
                        </a>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>

    </div>

</body>

</html>