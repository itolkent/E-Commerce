<?php
class AdminController extends Controller
{
    public function __construct()
    {
        $this->requireAdmin();
    }
    public function dashboard(): void
    {
        $productModel = new Product();
        $orderModel = new Order();
        $userModel = new User();

        $stats = [
            'total_products' => $productModel->countAll(),
            'total_orders' => $orderModel->countAll(),
            'total_users' => $userModel->countAll(),
            'pending_orders' => $orderModel->countPending()
        ];

        $this->view('admin/dashboard', [
            'stats' => $stats
        ]);
    }
    private function requireAdmin(): void
    {
        if (empty($_SESSION['is_admin'])) {
            $this->redirect(BASE_URL);
        }
    }
    public function loginPost(): void
    {
        $this->verifyCsrf();
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $userModel = new User();
        $user = $userModel->findByEmail($email);

        if (!$user || !$userModel->verifyPassword($user, $password)) {
            $this->view('auth/login', [
                'error' => 'Invalid credentials',
                'csrf' => $this->csrfToken(),
            ]);
            return;
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['is_admin'] = ($user['role'] === 'admin');

        $this->redirect(BASE_URL);
    }



    public function products(): void
    {
        $productModel = new Product();
        $products = $productModel->getAll();
        $this->view('admin/products', [
            'products' => $products,
        ]);
    }

    public function productCreate(): void
    {
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();
        $this->view('admin/product_form', [
            'categories' => $categories,
            'csrf' => $this->csrfToken(),
        ]);
    }

    public function productStore(): void
    {
        $this->verifyCsrf();
        $this->redirect(BASE_URL . 'admin/products');
    }

    public function orders(): void
    {
        $orderModel = new Order();
        $orders = $orderModel->getAll();
        $this->view('admin/orders', [
            'orders' => $orders,
        ]);
    }

    public function orderStatus(int $id): void
    {
        $this->verifyCsrf();
        $status = $_POST['status'] ?? 'pending';
        $orderModel = new Order();
        $orderModel->updateStatus($id, $status);
        $this->redirect(BASE_URL . 'admin/orders');
    }

    private function getStats(): array
    {
        $db = Database::getInstance();
        $totalSales = $db->query("SELECT SUM(total) AS total_sales FROM orders WHERE status IN ('paid','shipped')")->fetch()['total_sales'] ?? 0;
        $orderCount = $db->query("SELECT COUNT(*) AS cnt FROM orders")->fetch()['cnt'] ?? 0;
        return [
            'total_sales' => $totalSales,
            'order_count' => $orderCount,
        ];
    }
    public function createProduct()
    {
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        $this->view('admin/products_create', [
            'categories' => $categories
        ]);
    }

    public function storeProduct()
    {
        $productModel = new Product();

        $data = [
            'category_id' => $_POST['category_id'],
            'name' => $_POST['name'],
            'slug' => $_POST['slug'],
            'description' => $_POST['description'],
            'price' => $_POST['price'],
            'stock' => $_POST['stock'],
            'featured' => $_POST['featured'],
            'sku' => $_POST['sku'],
            'status' => $_POST['status'],
        ];

        // Handle image upload
        if (!empty($_FILES['image']['name'])) {
            $filename = time() . '_' . $_FILES['image']['name'];

            $uploadPath = __DIR__ . '/../../public/assets/uploads/' . $filename;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                $data['image'] = $filename;
            } else {
                die('Image upload failed');
            }
        }


        $productModel->create($data);

        $this->redirect(BASE_URL . 'admin/products');
    }
    public function productEdit($id)
    {
        $productModel = new Product();
        $categoryModel = new Category();

        $product = $productModel->find($id);
        $categories = $categoryModel->getAll();

        if (!$product) {
            $this->redirect(BASE_URL . 'admin/products');
            return;
        }

        $this->view('admin/product_edit', [
            'product' => $product,
            'categories' => $categories,
            'csrf' => $this->csrfToken(),
        ]);
    }
    public function update($id, $data)
    {
        $fields = [];

        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
        }

        $sql = "UPDATE products SET " . implode(', ', $fields) . " WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        $data['id'] = $id;

        return $stmt->execute($data);
    }
    public function productDelete($id)
    {
        $productModel = new Product();
        $product = $productModel->find($id);

        if (!$product) {
            $this->redirect(BASE_URL . 'admin/products');
            return;
        }

        // Soft delete instead of hard delete
        $productModel->update($id, ['is_deleted' => 1]);

        $this->redirect(BASE_URL . 'admin/products');
    }
    public function reports(): void
    {
        $db = Database::getInstance();

        // Total sales
        $totalSales = $db->query("
        SELECT SUM(total) AS total_sales 
        FROM orders 
        WHERE status IN ('paid','shipped','completed')
    ")->fetch()['total_sales'] ?? 0;

        // Order counts
        $orderStats = $db->query("
        SELECT 
            COUNT(*) AS total_orders,
            SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) AS pending_orders,
            SUM(CASE WHEN status IN ('paid','shipped','completed') THEN 1 ELSE 0 END) AS completed_orders
        FROM orders
    ")->fetch();

        // Top 5 selling products
        $topProducts = $db->query("
        SELECT p.name, SUM(oi.quantity) AS qty
        FROM order_items oi
        JOIN products p ON p.id = oi.product_id
        GROUP BY oi.product_id
        ORDER BY qty DESC
        LIMIT 5
    ")->fetchAll();

        // Revenue by month
        $monthlyRevenue = $db->query("
        SELECT 
            DATE_FORMAT(created_at, '%Y-%m') AS month,
            SUM(total) AS revenue
        FROM orders
        WHERE status IN ('paid','shipped','completed')
        GROUP BY month
        ORDER BY month DESC
        LIMIT 12
    ")->fetchAll();

        $this->view('admin/reports', [
            'totalSales' => $totalSales,
            'orderStats' => $orderStats,
            'topProducts' => $topProducts,
            'monthlyRevenue' => $monthlyRevenue
        ]);
    }
}