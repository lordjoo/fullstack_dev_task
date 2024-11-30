<?php

namespace App;

class Router
{
    private $routes = [];

    public function addRoute($method, $path, $controller)
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller
        ];
    }

    public function handleRequest($uri, $method)
    {
        // set CORS headers
        header("Access-Control-Allow-Origin: *");

        foreach ($this->routes as $route) {
            if ($route['method'] === $method) {
                $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-f0-9\-]{36})', $route['path']);
                $pattern = '#^' . $pattern . '$#';
                if (preg_match($pattern, $uri, $matches)) {
                    $controllerAction = $route['controller'];
                    list($controllerClass, $action) = explode('@', $controllerAction);
                    $controllerClass = 'App\\Controllers\\' . $controllerClass;
                    if (!class_exists($controllerClass)) {
                        header("HTTP/1.1 500 Internal Server Error");
                        echo json_encode([
                            "message" => "Internal Server Error",
                            "error" => "Cannot find controller class: $controllerClass"
                        ]);
                        return;
                    }
                    $controller = new $controllerClass();

                    try {
                        call_user_func_array([$controller, $action], array_slice($matches, 1));
                        return;
                    } catch (\Exception $e) {
                        header("HTTP/1.1 500 Internal Server Error");
                        echo json_encode([
                            "message" => "Internal Server Error",
                            "error" => $e->getMessage()
                        ]);
                        return;
                    }
                }
            }
        }

        header("HTTP/1.1 404 Not Found");
        echo json_encode(["message" => "Not Found"]);
    }
}
