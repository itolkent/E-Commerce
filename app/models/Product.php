<?php
class Product extends Model
{
    public function getFeatured(int $limit = 8): array
    {
        $stmt = $this->db->prepare("
        SELECT * FROM products 
        WHERE featured = 1 AND is_deleted = 0
        ORDER BY created_at DESC 
        LIMIT :limit
    ");

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getBySlug(string $slug): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE slug = :slug");
        $stmt->execute([':slug' => $slug]);
        $product = $stmt->fetch();
        return $product ?: null;
    }

    public function getByCategorySlug(string $slug, int $page = 1, int $perPage = 12): array
    {
        $offset = ($page - 1) * $perPage;
        $sql = "SELECT p.* FROM products p
                JOIN categories c ON p.category_id = c.id
                WHERE c.slug = :slug
                ORDER BY p.created_at DESC
                LIMIT :offset, :perPage";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':slug', $slug);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function search(string $q, int $page = 1, int $perPage = 12): array
    {
        $offset = ($page - 1) * $perPage;
        $like = '%' . $q . '%';
        $sql = "SELECT * FROM products
                WHERE name LIKE :q OR description LIKE :q OR sku LIKE :q
                ORDER BY created_at DESC
                LIMIT :offset, :perPage";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':q', $like);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getRelated(int $productId, int $categoryId, int $limit = 4): array
    {
        $sql = "SELECT * FROM products
                WHERE category_id = :category_id AND id != :id
                ORDER BY created_at DESC
                LIMIT :limit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->bindValue(':id', $productId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getAll(): array
    {
        $stmt = $this->db->query("
            SELECT * FROM products 
            WHERE is_deleted = 0 
            ORDER BY created_at DESC
        ");




        return $stmt->fetchAll();
        var_dump($stmt->errorInfo());
        var_dump($stmt->fetchAll(PDO::FETCH_ASSOC));
        exit;
    }
    public function index(): void
    {
        $productModel = new Product();
        $products = $productModel->getAll();

        $this->view('product/index', [
            'products' => $products
        ]);
    }
    public function countAll(): int
    {
        return (int) $this->db->query("SELECT COUNT(*) FROM products WHERE is_deleted = 0")
            ->fetchColumn();

    }
    public function create($data)
    {
        $stmt = $this->db->prepare("
        INSERT INTO products 
        (category_id, name, slug, description, price, stock, featured, sku, status, image, created_at, updated_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
    ");

        return $stmt->execute([
            $data['category_id'],
            $data['name'],
            $data['slug'],
            $data['description'],
            $data['price'],
            $data['stock'],
            $data['featured'],
            $data['sku'],
            $data['status'],
            $data['image'] ?? null
        ]);
    }
    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
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
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function getByCategory($categoryId)
    {
        $stmt = $this->db->prepare("
        SELECT * FROM products 
        WHERE category_id = :id AND status = 'active'
        ORDER BY id DESC
    ");
        $stmt->execute(['id' => $categoryId]);
        return $stmt->fetchAll();
    }
}
