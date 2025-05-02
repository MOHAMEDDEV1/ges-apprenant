<?php

function message(string $key, ...$args): string
{
    static $messages = null;

    if ($messages === null) {
        $path = __DIR__ . '/error.fr.php';
        if (file_exists($path)) {
            $messages = include $path;
        } else {
            $messages = [];
        }
    }

    if (!array_key_exists($key, $messages)) {
        return $key;
    }

    $msg = $messages[$key];

    
    return is_callable($msg) ? $msg(...$args) : $msg;
}
