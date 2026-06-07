<?php

declare(strict_types=1);

namespace App\Core;

class Router
{
    public static function load(string $page): void
    {
        $basePath = dirname(__DIR__, 2);

        $file = $basePath .
            '/templates/' .
            $page .
            '.php';

        if (file_exists($file)) {

            require $file;
            return;
        }

        http_response_code(404);

        echo '<h1>404 - Page Not Found</h1>';
    }
}