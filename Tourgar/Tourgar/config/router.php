<?php
// config/router.php
// Inti MVC: Router yang mengarahkan request ke Controller yang sesuai

require_once __DIR__ . '/database.php';

// ================================================================
// BASE_URL — otomatis mendeteksi folder dasar aplikasi
// Contoh: jika diakses lewat http://localhost/Tourgar/public/...
// maka BASE_URL akan berisi "/Tourgar/public"
// Dipakai di semua view untuk memanggil CSS/JS/gambar agar selalu
// tepat di folder mana pun project ini diletakkan.
// ================================================================
if (!defined('BASE_URL')) {
    define('BASE_URL', rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'));
}

class Router {
    private $routes = [];

    public function get($path, $controller, $method) {
        $this->routes[] = [
            'method' => 'GET',
            'path'   => $path,
            'controller' => $controller,
            'action' => $method
        ];
    }

    public function post($path, $controller, $method) {
        $this->routes[] = [
            'method' => 'POST',
            'path'   => $path,
            'controller' => $controller,
            'action' => $method
        ];
    }

    public function dispatch() {
        $requestUri    = strtok($_SERVER['REQUEST_URI'], '?');
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        // Hapus base path jika ada
        $basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
        $uri = '/' . ltrim(str_replace($basePath, '', $requestUri), '/');

        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod && $this->matchPath($route['path'], $uri)) {
                $controllerFile = __DIR__ . '/../app/controllers/' . $route['controller'] . '.php';
                if (!file_exists($controllerFile)) {
                    http_response_code(500);
                    die("Controller tidak ditemukan: " . $route['controller']);
                }
                require_once $controllerFile;
                $ctrl = new $route['controller']();
                $action = $route['action'];
                $ctrl->$action();
                return;
            }
        }

        // 404 jika tidak ada route yang cocok
        http_response_code(404);
        echo "<h1>404 - Halaman tidak ditemukan</h1>";
    }

    private function matchPath($routePath, $uri) {
        return rtrim($routePath, '/') === rtrim($uri, '/');
    }
}
