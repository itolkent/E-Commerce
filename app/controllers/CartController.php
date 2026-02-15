<?php

class CartController extends Controller
{
    public function index()
    {
        $cart = new Cart();

        $this->view('cart/index', [
            'items' => $cart->items(),
            'total' => $cart->total()
        ]);
    }

    public function add($id)
    {
        $productModel = new Product();
        $product = $productModel->find($id);

        if (!$product) {
            $this->redirect(BASE_URL . 'cart');
        }

        $cart = new Cart();
        $cart->add($product);

        $this->redirect(BASE_URL . 'cart');
    }

    public function update()
    {
        $cart = new Cart();

        foreach ($_POST['qty'] as $id => $qty) {
            $cart->update($id, (int) $qty);
        }

        $this->redirect(BASE_URL . 'cart');
    }

    public function remove($id)
    {
        $cart = new Cart();
        $cart->remove($id);

        $this->redirect(BASE_URL . 'cart');
    }

    public function clear()
    {
        $cart = new Cart();
        $cart->clear();

        $this->redirect(BASE_URL . 'cart');
    }
}