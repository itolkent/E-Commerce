<h1>Payment Method</h1>

<form action="<?= BASE_URL ?>checkout/payment" method="POST">

    <label>
        <input type="radio" name="method" value="cod" checked>
        Cash on Delivery
    </label>

    <label>
        <input type="radio" name="method" value="card">
        Credit/Debit Card
    </label>

    <button type="submit" class="button-primary">Review Order</button>
</form>