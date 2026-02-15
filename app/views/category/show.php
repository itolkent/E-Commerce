<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>
        <?= htmlspecialchars($category['name']) ?> – Kent Shop
    </title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/styles.css">
</head>

<body>

    <h1 class="section-heading">
        <?= htmlspecialchars($category['name']) ?>
    </h1>

    <?php if (empty($products)): ?>
        <p>No products found in this category.</p>
        <a href="<?= BASE_URL ?>" class="button-primary">Back to Home</a>
    <?php else: ?>

        <div class="product-grid">
            <?php foreach ($products as $product): ?>
                <div class="product-card">

                    <img src="<?= BASE_URL ?>assets/uploads/<?= $product['image'] ?>"
                        alt="<?= htmlspecialchars($product['name']) ?>" class="product-image">

                    <div class="product-card-info">
                        <p class="product-card-name">
                            <?= htmlspecialchars($product['name']) ?>
                        </p>

                        <p class="product-card-price">
                            $
                            <?= number_format($product['price'], 2) ?>
                        </p>

                        <a href="<?= BASE_URL ?>product/<?= $product['slug'] ?>" class="button-primary full-width">
                            View
                        </a>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>

</body>

</html>