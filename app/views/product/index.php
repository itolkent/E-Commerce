<h1 class="page-title">All Products</h1>

<div class="product-grid">
    <?php foreach ($products as $product): ?>
        <div class="product-card">

            <img src="<?= BASE_URL ?>assets/uploads/<?= $product['image'] ?>" alt="<?= $product['name'] ?>"
                class="product-image">

            <div class="product-card-info">
                <p class="product-card-name">
                    <?= $product['name'] ?>
                </p>
                <p class="product-card-price">£
                    <?= number_format($product['price'], 2) ?>
                </p>

                <a href="<?= BASE_URL ?>product/<?= $product['slug'] ?>" class="button-secondary">
                    View
                </a>
            </div>

        </div>
    <?php endforeach; ?>
</div>