<?php

class OrderItem extends Model
{
    public function create($data)
    {
        $stmt = $this->db->prepare("
            INSERT INTO order_items (order_id, product_id, price, quantity)
            VALUES (:order_id, :product_id, :price, :quantity)
        ");

        return $stmt->execute([
            'order_id' => $data['order_id'],
            'product_id' => $data['product_id'],
            'price' => $data['price'],
            'quantity' => $data['qty'] ?? 1   // fallback to 1 if qty missing
        ]);
    }

    public function getByOrder($orderId)
    {
        $stmt = $this->db->prepare("
            SELECT oi.*, p.name, p.image
            FROM order_items oi
            JOIN products p ON p.id = oi.product_id
            WHERE oi.order_id = ?
        ");

        $stmt->execute([$orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}