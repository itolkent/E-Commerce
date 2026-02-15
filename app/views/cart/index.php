<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/styles.css">
</head>

<body>

    <div class="cart-container">

        <h1>Your Shopping Cart</h1>

        <?php if (empty($items)): ?>
            <p>Your cart is empty.</p>
            <a href="<?= BASE_URL ?>" class="button-secondary">Continue Shopping</a>
        <?php else: ?>

            <form action="<?= BASE_URL ?>cart/update" method="POST">

                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($items as $item): ?>
                            <tr>
                                <td>
                                    <img src="<?= BASE_URL ?>/assets/uploads/<?= $item['image'] ?>" class="cart-thumb">
                                    <?= $item['name'] ?>
                                </td>

                                <td>
                                    <input type="number" name="qty[<?= $item['id'] ?>]" value="<?= $item['qty'] ?>" min="1">
                                </td>

                                <td>$
                                    <?= number_format($item['price'], 2) ?>
                                </td>

                                <td>£
                                    <?= number_format($item['price'] * $item['qty'], 2) ?>
                                </td>

                                <td>
                                    <a href="<?= BASE_URL ?>cart/remove/<?= $item['id'] ?>" class="button-small danger">
                                        Remove
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <button type="submit" class="button-secondary">Update Cart</button>

            </form>

            <div class="cart-summary">
                <h2>Total: £
                    <?= number_format($total, 2) ?>
                </h2>

                <a href="<?= BASE_URL ?>checkout" class="button-secondary">Proceed to Checkout</a>
                <a href="<?= BASE_URL ?>cart/clear" class="button-small danger">Clear Cart</a>
            </div>

        <?php endif; ?>

    </div>


</body>

</html>