<?php

namespace App;
class Router {
    private static $routes = [];

    public static function add($route, $controller, $action) {
        // Normalize route format to ensure consistent matching
        $route = trim($route, '/');
        self::$routes[$route] = ["controller" => $controller, "action" => $action];
    }

    public static function route($url) {
        $url = trim($url, '/');

        foreach (self::$routes as $route => $info) {
            // Convert routes to regular expression: escape forward slashes and replace parameters (e.g. :id)
            $pattern = "@^" . preg_replace('/:[a-zA-Z0-9]+/', '([a-zA-Z0-9_]+)', $route) . "$@D";

            // Try to match the route pattern against the provided URL
            if (preg_match($pattern, $url, $matches)) {
                // Remove the first element (the full matched string)
                array_shift($matches);

                $controller = "App\\Controllers\\" . $info['controller'];
                $action = $info['action'];

                if (class_exists($controller)) {
                    $object = new $controller();
                    if (method_exists($object, $action)) {
                        // Call the action method and pass in the matched parameters
                        call_user_func_array([$object, $action], $matches);
                        return;
                    }
                }
            }
        }

        // If no route was matched, show a 404 error
        echo "404 Not Found";
    }
}

?>