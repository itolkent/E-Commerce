<?php

class AdminOrderController extends Controller
{
    public function index()
    {
        $orderModel = new Order();
        $orders = $orderModel->all();

        $this->view('admin/orders/index', [
            'orders' => $orders
        ]);
    }

    public function show($id)
    {
        $orderModel = new Order();
        $orderItemModel = new OrderItem();

        $order = $orderModel->find($id);
        $items = $orderItemModel->getByOrder($id);

        $this->view('admin/orders/show', [
            'order' => $order,
            'items' => $items
        ]);
    }

    public function updateStatus($id)
    {
        $orderModel = new Order();

        $orderModel->updateStatus($id, $_POST['status']);

        $this->redirect(BASE_URL . "admin/orders/$id");
    }
}