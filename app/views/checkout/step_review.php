<h1>Review Your Order</h1>

<h3>Shipping</h3>
<p><?= $shipping['name'] ?>, <?= $shipping['address'] ?>, <?= $shipping['city'] ?> <?= $shipping['zip'] ?></p>

<h3>Payment</h3>
<p><?= strtoupper($payment['method']) ?></p>

<h3>Items</h3>

<table>
    <?php foreach ($items as $item): ?>
        <tr>
            <td><?= $item['name'] ?></td>
            <td><?= $item['qty'] ?></td>
            <td>$<?= number_format($item['price'], 2) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h2>Total: $<?= number_format($total, 2) ?></h2>

<form action="<?= BASE_URL ?>checkout/place-order" method="POST">
    <button type="submit" class="button-primary">Place Order</button>
</form>