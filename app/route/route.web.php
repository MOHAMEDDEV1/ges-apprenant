<?php

namespace App\Route;
// require __DIR__ ."/../views/erreur404.php";
require_once __DIR__ ."/../controllers/login/login.controller.php";
// require_once __DIR__ ."/../controllers/promotion/promotion.controller.php";
require_once __DIR__ ."/../controllers/referentiel/referentiel.controller.php";
require_once __DIR__ ."/../controllers/apprenant/apprenant.controller.php";
// require_once __DIR__ ."/../controllers/auth.php";

use App\Enums\SESSION;
use function App\Controllers\Promotion\runder_promotion;
use function App\Controllers\Login\runder_login;
use function App\Controllers\referentiel\runder_referentiel;

function  render_menu():void{
   
    global  $SessionService;

    $menu =  $SessionService[SESSION::REQUETE->value]('menu','');

    match($menu){
        "rapport-import" => require_once __DIR__ ."/../views/apprenant/rapport.importation.php",
        ""=> runder_login(),
        "referentiel" => runder_referentiel(),
        "promotion" => runder_promotion(),
        "apprenant" => runder_apprenant(),
         default=> require_once __DIR__ ."/../views/erreur404.php",
    };
}

