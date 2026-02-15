<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin – Products</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/styles.css">
</head>

<body>
    <div class="admin-container">

        <h1>Products</h1>

        <a href="<?= BASE_URL ?>admin/products/create" class="button-primary">Add New Product</a>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>SKU</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= $product['id'] ?></td>
                        <td><?= $product['name'] ?></td>
                        <td>$<?= number_format($product['price'], 2) ?></td>
                        <td><?= $product['stock'] ?></td>
                        <td><?= $product['sku'] ?></td>
                        <td><?= $product['status'] ?></td>

                        <td>
                            <a href="<?= BASE_URL ?>admin/products/edit/<?= $product['id'] ?>" class="button-small">Edit</a>
                            <a href="<?= BASE_URL ?>admin/products/delete/<?= $product['id'] ?>" class="button-small danger"
                                onclick="return confirm('Are you sure you want to delete this product?');">
                                Delete
                            </a>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>


</body>

</html>