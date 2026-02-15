<?php
class ProductController extends Controller
{
    public function index(): void
    {
        $productModel = new Product();
        $products = $productModel->getAll(); // or getFeatured()

        $this->view('product/index', [
            'products' => $products
        ]);
    }
    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM products ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }
    public function category($slug)
    {
        $categoryModel = new Category();
        $productModel = new Product();

        $category = $categoryModel->findBySlug($slug);

        if (!$category) {
            throw new Exception("Category not found");
        }

        $products = $productModel->getByCategory($category['id']);

        $this->view('category/show', [
            'category' => $category,
            'products' => $products
        ]);
    }
    public function detail(string $slug): void
    {
        $productModel = new Product();
        $product = $productModel->getBySlug($slug);
        if (!$product) {
            http_response_code(404);
            echo 'Product not found';
            return;
        }
        $related = $productModel->getRelated((int) $product['id'], (int) $product['category_id']);
        $this->view('product/detail', [
            'product' => $product,
            'related' => $related,
        ]);
    }

    public function search(): void
    {
        $q = trim($_GET['q'] ?? '');
        $page = (int) ($_GET['page'] ?? 1);
        $products = [];
        if ($q !== '') {
            $productModel = new Product();
            $products = $productModel->search($q, $page);
        }
        $this->view('product/list', [
            'products' => $products,
            'searchQuery' => $q,
        ]);
    }
    public function products()
    {
        $productModel = new Product();
        $products = $productModel->getAll();

        $this->view('admin/products', [
            'products' => $products
        ]);
    }

}