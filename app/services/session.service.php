<?php
namespace App\Services;
require_once __DIR__ ."/../enums/enums.php";

use App\Enums\SESSION;

$SessionService = [

    SESSION::REQUETE->value => function(string $key, $default = null){
        return $_REQUEST[$key]?? $default;
    },

    SESSION::POST->value => function (string $key, $default = null){
        return $_POST[$key] ?? $default;
    },
    
    SESSION::GET->value => function (string $key, $default = null){
    return $_GET[$key]?? $default;
    },
    
    SESSION::FILE->value => function (string $key, $default = null){
        return $_FILES[$key]?? $default;
    },

    SESSION::SESSION_REQUETE->value => function (string $key, string $default = null){
        return $_SESSION[$key] ?? $default;
    }

];

 