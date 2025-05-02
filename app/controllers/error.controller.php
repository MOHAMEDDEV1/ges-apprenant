<?php
namespace App\Controllers\errors;
$errors = []; 

function add_error(string $field, string $message) {
    global $errors;
    $errors[$field] = $message;
}

function has_errors(): bool {
    global $errors;
    return !empty($errors);
}

function get_error(string $field): ?string {
    global $errors;
    return $errors[$field] ?? null;
}

function clear_errors() {
    global $errors;
    $errors = [];
}
