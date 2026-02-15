<?php
class Router
{
    private array $routes = [];

    public function get(string $pattern, array $handler): void
    {
        $this->routes['GET'][$pattern] = $handler;
    }

    public function post(string $pattern, array $handler): void
    {
        $this->routes['POST'][$pattern] = $handler;
    }

    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $url = $_GET['url'] ?? '';
        $url = trim($url, '/');

        foreach ($this->routes[$method] ?? [] as $pattern => $handler) {
            $regex = '#^' . preg_replace('#\{([\w]+)\}#', '([^/]+)', $pattern) . '$#';
            if (preg_match($regex, $url, $matches)) {
                array_shift($matches);
                [$controllerName, $action] = $handler;
                $controller = new $controllerName();
                call_user_func_array([$controller, $action], $matches);
                return;
            }
        }

        http_response_code(404);
        echo '404 Not Found';
    }
}