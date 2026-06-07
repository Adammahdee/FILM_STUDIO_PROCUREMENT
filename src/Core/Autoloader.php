<?php

declare(strict_types=1);

spl_autoload_register(
    function (string $class): void {

        $prefix = 'App\\';

        if (
            strncmp(
                $prefix,
                $class,
                strlen($prefix)
            ) !== 0
        ) {
            return;
        }

        $relativeClass = substr(
            $class,
            strlen($prefix)
        );

        $file = dirname(__DIR__) . '/'
            . str_replace(
                '\\',
                '/',
                $relativeClass
            )
            . '.php';

        if (file_exists($file)) {
            require_once $file;
        }
    }
);