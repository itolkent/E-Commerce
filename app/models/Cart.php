<?php

class Cart
{
    public function items()
    {
        return $_SESSION['cart'] ?? [];
    }

    public function total()
    {
        $total = 0;

        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $total += $item['price'] * $item['qty'];
            }
        }

        return $total;
    }

    public function add($product, $qty = 1)
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $id = $product['id'];

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['qty'] += $qty;
        } else {
            $_SESSION['cart'][$id] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['image'] ?? null,
                'qty' => $qty
            ];
        }
    }

    public function update($id, $qty)
    {
        if (isset($_SESSION['cart'][$id])) {
            if ($qty <= 0) {
                unset($_SESSION['cart'][$id]);
            } else {
                $_SESSION['cart'][$id]['qty'] = $qty;
            }
        }
    }

    public function remove($id)
    {
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
    }

    public function clear()
    {
        unset($_SESSION['cart']);
    }
    
}