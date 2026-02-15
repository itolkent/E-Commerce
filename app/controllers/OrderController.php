<?php
class OrderController extends Controller
{
    public function detail($id)
    {


        $orderModel = new Order();
        $orderItemModel = new OrderItem();

        $order = $orderModel->find($id);
        $items = $orderItemModel->getByOrder($id);

        if (!$order) {
            $this->redirect(BASE_URL);
        }

        $this->view('order/detail', [
            'order' => $order,
            'items' => $items
        ]);
    }


    public function history()
    {
        $this->requireLogin(); // must match AuthController

        $orderModel = new Order();
        $orders = $orderModel->getByUser($_SESSION['user_id']);

        $this->view('order/history', [
            'order' => $orders
        ]);
    }
    public function create($data)
    {
        $stmt = $this->db->prepare("
            INSERT INTO orders (user_id, total, shipping, payment)
            VALUES (:user_id, :total, :shipping, :payment)
        ");

        $stmt->execute($data);

        return $this->db->lastInsertId();
    }
}