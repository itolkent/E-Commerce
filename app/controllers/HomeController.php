<?php
class HomeController extends Controller
{
    public function index(): void
    {
        $categoryModel = new Category();
        $productModel = new Product();

        $categories = $categoryModel->getAll();
        $featured = $productModel->getFeatured(8);

        $this->view('home/index', [
            'categories' => $categories,
            'featured' => $featured
        ]);
    }
}
