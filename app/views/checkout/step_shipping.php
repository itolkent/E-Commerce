
<h1>Shipping Information</h1>

<form action="<?= BASE_URL ?>checkout/shipping" method="POST">

    <label>Name</label>
    <input type="text" name="name" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Phone</label>
    <input type="text" name="phone" required>

    <label>Address</label>
    <input type="text" name="address" required>

    <label>City</label>
    <input type="text" name="city" required>

    <label>ZIP Code</label>
    <input type="text" name="zip" required>

    <button type="submit" class="button-primary">Continue to Payment</button>
</form>