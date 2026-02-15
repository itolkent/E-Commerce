<?php
abstract class Controller
{
    protected function view(string $view, array $data = []): void
    {
        extract($data);
        $viewFile = __DIR__ . '/../views/' . $view . '.php';
        $layoutFile = __DIR__ . '/../views/layouts/main.php';
        if (!file_exists($viewFile)) {
            throw new Exception("View $view not found");
        }
        ob_start();
        require $viewFile;
        $content = ob_get_clean();
        require $layoutFile;
    }

    protected function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }

    protected function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    protected function csrfToken(): string
    {
        if (empty($_SESSION[CSRF_TOKEN_NAME])) {
            $_SESSION[CSRF_TOKEN_NAME] = bin2hex(random_bytes(32));
        }
        return $_SESSION[CSRF_TOKEN_NAME];
    }

    protected function verifyCsrf(): void
    {
        $token = $_POST[CSRF_TOKEN_NAME] ?? '';
        if (!$token || !hash_equals($_SESSION[CSRF_TOKEN_NAME] ?? '', $token)) {
            http_response_code(400);
            exit('Invalid CSRF token');
        }
    }
    protected function requireLogin(): void
    {
        if (empty($_SESSION['user_id'])) {
            $this->redirect(BASE_URL . 'login');
            exit;
        }
    }
}