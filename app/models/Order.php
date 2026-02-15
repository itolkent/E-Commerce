<?php

class Order extends Model
{
    public function create($data)
    {
        $stmt = $this->db->prepare("
            INSERT INTO orders (user_id, total, shipping, payment)
            VALUES (:user_id, :total, :shipping, :payment)
        ");

        $stmt->execute($data);

        return $this->db->lastInsertId();
    }

    public function getByUser(int $userId): array
    {
        $stmt = $this->db->prepare("
            SELECT * FROM orders 
            WHERE user_id = :user_id 
            ORDER BY created_at DESC
        ");

        $stmt->execute(['user_id' => $userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getWithItems(int $orderId): ?array
    {
        // Get order
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE id = :id");
        $stmt->execute(['id' => $orderId]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$order) {
            return null;
        }

        // Get items
        $itemsStmt = $this->db->prepare("
            SELECT oi.*, p.name
            FROM order_items oi
            JOIN products p ON oi.product_id = p.id
            WHERE oi.order_id = :order_id
        ");

        $itemsStmt->execute(['order_id' => $orderId]);
        $order['items'] = $itemsStmt->fetchAll(PDO::FETCH_ASSOC);

        return $order;
    }

    public function countAll(): int
    {
        return (int) $this->db
            ->query("SELECT COUNT(*) FROM orders")
            ->fetchColumn();
    }

    public function countPending(): int
    {
        return (int) $this->db
            ->query("SELECT COUNT(*) FROM orders WHERE status = 'pending'")
            ->fetchColumn();
    }

    public function find($id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE id = ?");
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function all(): array
    {
        $stmt = $this->db->query("
            SELECT * FROM orders 
            ORDER BY created_at DESC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($id, $status): bool
    {
        $stmt = $this->db->prepare("
            UPDATE orders 
            SET status = ? 
            WHERE id = ?
        ");

        return $stmt->execute([$status, $id]);
    }
    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM orders ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}