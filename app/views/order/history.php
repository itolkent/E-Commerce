<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Your Orders</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/styles.css">
</head>

<body>

    <div class="order-history">

        <h1>Your Orders</h1>

        <?php if (empty($orders)): ?>
            <p>You have no orders yet.</p>
            <a href="<?= BASE_URL ?>" class="button-primary">Start Shopping</a>
        <?php else: ?>

            <table class="order-table">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?= $order['id'] ?></td>
                            <td>$<?= number_format($order['total'], 2) ?></td>
                            <td><?= ucfirst($order['status'] ?? 'pending') ?></td>
                            <td><?= $order['created_at'] ?></td>
                            <td>
                                <a href="<?= BASE_URL ?>order/<?= $order['id'] ?>" class="button-small">
                                    View
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php endif; ?>

    </div>
</body>

</html>