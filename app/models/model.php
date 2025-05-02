<?php
namespace App\Models;
use App\Enums\NAME_FUNCTION;

require_once __DIR__ ."/../enums/enums.php";
require_once __DIR__ ."/../services/session.service.php";

$PATH_JSON = __DIR__ . "/../data/data.json";




$JsonService = [
   
    NAME_FUNCTION::JSON_TO_ARRAY->value => function():array{
        global $PATH_JSON;
         if(!file_exists($PATH_JSON)){
            return [];
         }
         $tab = file_get_contents($PATH_JSON);
         return json_decode($tab, true);
    },
    
    NAME_FUNCTION::ARRAY_TO_JSON->value => function(array $tab):bool{
        global $PATH_JSON;
    
        return  (file_put_contents($PATH_JSON, json_encode($tab, JSON_PRETTY_PRINT))==true);
    },

    // "session" => function(string $key , string $defaul = null){
    //     return $_SESSION[$key] ?? $defaul;
    // },
];



?>