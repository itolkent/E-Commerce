<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add New Product – Admin</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/styles.css">
</head>

<body>

    <div class="admin-container">

        <h1>Add New Product</h1>

        <form action="<?= BASE_URL ?>admin/products/store" method="POST" enctype="multipart/form-data"
            class="admin-form">

            <!-- CATEGORY -->
            <label>Category</label>
            <select name="category_id" required>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                <?php endforeach; ?>
            </select>

            <label>Product Name</label>
            <input type="text" name="name" required>
            <label>Slug (URL)</label>
            <input type="text" name="slug" required>
            <label>Description</label>
            <textarea name="description" rows="5" required></textarea>
            <label>Price ($)</label>
            <input type="number" step="0.01" name="price" required>
            <label>Stock</label>
            <input type="number" name="stock" required>
            <label>SKU</label>
            <input type="text" name="sku" required>
            <label>Featured</label>
            <select name="featured">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
            <label>Status</label>
            <select name="status">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
            <label>Product Image</label>
            <input type="file" name="image">
            <button type="submit" class="button-primary">Save Product</button>

        </form>

    </div>


</body>

</html>