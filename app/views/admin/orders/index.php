<h1>Manage Orders</h1>

<table class="admin-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Total</th>
            <th>Status</th>
            <th>Date</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td>
                    <?= $order['id'] ?>
                </td>
                <td>
                    <?= $order['user_id'] ?>
                </td>
                <td>$
                    <?= number_format($order['total'], 2) ?>
                </td>
                <td>
                    <?= ucfirst($order['status']) ?>
                </td>
                <td>
                    <?= $order['created_at'] ?>
                </td>
                <td>
                    <a href="<?= BASE_URL ?>admin/orders/<?= $order['id'] ?>" class="button-small">
                        View
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>