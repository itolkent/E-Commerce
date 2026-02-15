<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/styles.css">
</head>

<body>
    <div class="admin-container">

        <h1>Edit Product</h1>

        <form action="<?= BASE_URL ?>admin/products/update/<?= $product['id'] ?>" method="POST"
            enctype="multipart/form-data">

            <input type="hidden" name="<?= CSRF_TOKEN_NAME ?>" value="<?= $csrf ?>">

            <label>Name</label>
            <input type="text" name="name" value="<?= $product['name'] ?>" required>

            <label>Slug</label>
            <input type="text" name="slug" value="<?= $product['slug'] ?>" required>

            <label>Description</label>
            <textarea name="description" required><?= $product['description'] ?></textarea>

            <label>Price</label>
            <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" required>

            <label>Stock</label>
            <input type="number" name="stock" value="<?= $product['stock'] ?>" required>

            <label>SKU</label>
            <input type="text" name="sku" value="<?= $product['sku'] ?>" required>

            <label>Status</label>
            <select name="status">
                <option value="active" <?= $product['status'] === 'active' ? 'selected' : '' ?>>Active</option>
                <option value="inactive" <?= $product['status'] === 'inactive' ? 'selected' : '' ?>>Inactive</option>
            </select>

            <label>Category</label>
            <select name="category_id">
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>" <?= $product['category_id'] == $cat['id'] ? 'selected' : '' ?>>
                        <?= $cat['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Featured</label>
            <select name="featured">
                <option value="0" <?= $product['featured'] == 0 ? 'selected' : '' ?>>No</option>
                <option value="1" <?= $product['featured'] == 1 ? 'selected' : '' ?>>Yes</option>
            </select>

            <label>Current Image</label>
            <img src="<?= BASE_URL ?>assets/uploads/<?= $product['image'] ?>" width="120"
                style="display:block;margin-bottom:10px;">

            <label>Upload New Image</label>
            <input type="file" name="image">

            <button type="submit" class="button-primary">Save Changes</button>

        </form>

    </div>
</body>

</html>