<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/styles.css">
</head>

<body>

    <div class="order-confirmation">

        <h1>Thank You for Your Order!</h1>

        <p>Your order has been placed successfully.</p>

        <div class="order-box">
            <h2>Order #
                <?= $order['id'] ?>
            </h2>
            <p><strong>Total:</strong> $
                <?= number_format($order['total'], 2) ?>
            </p>
            <p><strong>Date:</strong>
                <?= $order['created_at'] ?>
            </p>
        </div>

        <h3>Items in Your Order</h3>

        <table class="order-table">
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
                        <td>
                            <img src="<?= BASE_URL ?>uploads/<?= $item['image'] ?>" class="order-thumb">
                            <?= $item['name'] ?>
                        </td>
                        <td>
                            <?= $item['qty'] ?>
                        </td>
                        <td>$
                            <?= number_format($item['price'], 2) ?>
                        </td>
                        <td>$
                            <?= number_format($item['price'] * $item['qty'], 2) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="<?= BASE_URL ?>" class="button-primary">Continue Shopping</a>

    </div>

</body>

</html>