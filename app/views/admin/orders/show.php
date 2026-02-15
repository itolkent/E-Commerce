<h1>Order #<?= $order['id'] ?></h1>

<p><strong>User ID:</strong> <?= $order['user_id'] ?></p>
<p><strong>Total:</strong> $<?= number_format($order['total'], 2) ?></p>
<p><strong>Status:</strong> <?= ucfirst($order['status']) ?></p>
<p><strong>Date:</strong> <?= $order['created_at'] ?></p>

<h2>Update Status</h2>

<form action="<?= BASE_URL ?>admin/orders/status/<?= $order['id'] ?>" method="POST">
    <select name="status">
        <option value="pending"     <?= $order['status']=='pending'?'selected':'' ?>>Pending</option>
        <option value="processing"  <?= $order['status']=='processing'?'selected':'' ?>>Processing</option>
        <option value="shipped"     <?= $order['status']=='shipped'?'selected':'' ?>>Shipped</option>
        <option value="completed"   <?= $order['status']=='completed'?'selected':'' ?>>Completed</option>
        <option value="cancelled"   <?= $order['status']=='cancelled'?'selected':'' ?>>Cancelled</option>
    </select>

    <button type="submit" class="button-primary">Update</button>
</form>

<h2>Items</h2>

<table class="admin-table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Subtotal</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?= $item['name'] ?></td>
                <td><?= $item['quantity'] ?></td>
                <td>$<?= number_format($item['price'], 2) ?></td>
                <td>$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>