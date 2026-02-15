<?php

class CheckoutController extends Controller
{
    public function shipping()
    {
        $cart = new Cart();

        if (empty($cart->items())) {
            $this->redirect(BASE_URL . 'cart');
        }

        $this->view('checkout/step_shipping', [
            'items' => $cart->items(),
            'total' => $cart->total()
        ]);
    }

    public function saveShipping()
    {
        $_SESSION['checkout']['shipping'] = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'address' => $_POST['address'],
            'city' => $_POST['city'],
            'zip' => $_POST['zip']
        ];

        $this->redirect(BASE_URL . 'checkout/payment');
    }

    public function payment()
    {
        $this->view('checkout/step_payment');
    }

    public function savePayment()
    {
        $_SESSION['checkout']['payment'] = [
            'method' => $_POST['method']
        ];

        $this->redirect(BASE_URL . 'checkout/review');
    }

    public function review()
    {
        $cart = new Cart();

        $this->view('checkout/step_review', [
            'shipping' => $_SESSION['checkout']['shipping'],
            'payment' => $_SESSION['checkout']['payment'],
            'items' => $cart->items(),
            'total' => $cart->total()
        ]);
    }

    public function placeOrder()
    {
        $cart = new Cart();
        $orderModel = new Order();
        $orderItemModel = new OrderItem();

        // Create order
        $orderId = $orderModel->create([
            'user_id' => $_SESSION['user']['id'] ?? null,
            'total' => $cart->total(),
            'shipping' => json_encode($_SESSION['checkout']['shipping']),
            'payment' => json_encode($_SESSION['checkout']['payment'])
        ]);

        // Add order items
        foreach ($cart->items() as $item) {
            $orderItemModel->create([
                'order_id' => $orderId,
                'product_id' => $item['id'],
                'price' => $item['price'],
                'qty' => $item['qty']
            ]);
        }

        // Clear cart + checkout session
        $cart->clear();
        unset($_SESSION['checkout']);

        $this->redirect(BASE_URL . 'order/' . $orderId);
    }
}