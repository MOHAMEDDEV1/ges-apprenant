<?php
namespace App\Models\Promotion;
require_once __DIR__ ."/../model.php";
use App\Enums\NAME_FUNCTION;


$PromotionServices = [

   NAME_FUNCTION::LISTE_PROMOTIONS->value => function ():array {
    global $JsonService;

    $data = $JsonService[NAME_FUNCTION::JSON_TO_ARRAY->value]();
    $promotions = $data["promotions"];

    return $promotions;
},

NAME_FUNCTION::AJOUTER_PROMOTIONS->value => function (string $nom, string $dateDebut, string $dateFin, string $photo = null, string $status , array $refs): array {
    global  $JsonService;

 
    $data = $JsonService[NAME_FUNCTION::JSON_TO_ARRAY->value]();

  
    if (!isset($data["promotions"])) {
        $data["promotions"] = [];
    }

    
    $data["promotions"][] = [
        'nom' => $nom,
        'date-debut' => $dateDebut,
        'date-fin' => $dateFin,
        'photo' => $photo ?? "/ges-apprenant/public/assets/images/dg.png",
        'status' => $status,
        'referentiels' => $refs
    ];

    $JsonService[NAME_FUNCTION::ARRAY_TO_JSON->value]($data);

    return $data["promotions"]; 
}, 

NAME_FUNCTION::LISTER_PROMOTIONS_ACTIVES->value => function () {
    global $JsonService;
    $data = $JsonService[NAME_FUNCTION::JSON_TO_ARRAY->value]();

    return array_values(array_filter($data['promotions'], fn($promotion) => $promotion['status'] === 'active'));
},

NAME_FUNCTION::RECUPERER_PROMOTION_EN_COURS->value => function ():array {
    global $JsonService;
    $data = $JsonService[NAME_FUNCTION::JSON_TO_ARRAY->value]();
    $promotions = $data["promotions"];

    $anneeEnCours = date('Y'); 

    foreach ($promotions as $promotion) {
        $anneeDebut = date('Y', strtotime($promotion['date-debut']));
        if ($promotion["status"] === "active" && $anneeDebut == $anneeEnCours) {
            return $promotion;
        }
    }
    return [];
},




NAME_FUNCTION::RECHERCHER_PROMO_PAR_NOM->value => function(string $query):array {
    global $PromotionServices;

    $data = $PromotionServices[NAME_FUNCTION::LISTE_PROMOTIONS->value]();

    return array_values(array_filter($data, function($promotion) use ($query) {
        return stripos($promotion["nom"], $query) !== false;
    }));
},

NAME_FUNCTION::CHANGER_STATUS_PROMOTION->value => function(string $nom) use (&$JsonService) {
    $data = $JsonService[NAME_FUNCTION::JSON_TO_ARRAY->value]();

    $data['promotions'] = array_map(function ($promotion) use ($nom) {
        $promotion['status'] = ($promotion['nom'] === $nom) ? 'active' : 'inactive';
        return $promotion;
    }, $data['promotions']);

    $JsonService[NAME_FUNCTION::ARRAY_TO_JSON->value]($data);
},



];

