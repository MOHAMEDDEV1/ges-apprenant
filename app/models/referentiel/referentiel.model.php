<?php

namespace App\Models\Referentiel;
require_once __DIR__ ."/../model.php";
use App\Enums\NAME_FUNCTION;


$ReferentielServices = [

 NAME_FUNCTION::LISTER_REFERENTIELS->value => function():array{
    
    global $JsonService;

    $data = $JsonService[NAME_FUNCTION::JSON_TO_ARRAY->value]();
    $referentiels = $data["referentiels"];

    return $referentiels;
 },


 NAME_FUNCTION::LISTER_REFERENTIELS_PROMO_ACTIVE->value => function (): array {
    global $JsonService;

    $data = $JsonService[NAME_FUNCTION::JSON_TO_ARRAY->value]();

    if (!isset($data["promotions"], $data["referentiels"])) {
        return [];
    }

    $promosActives = array_filter($data["promotions"], fn($p) => $p["status"] === "active" && isset($p["referentiels"]));

    $referentielPromo = array_reduce($promosActives, function ($carry, $promo) use ($data) {
        $refs = array_filter($data["referentiels"], fn($ref) => in_array($ref["nom"], $promo["referentiels"]));
        return array_merge($carry, $refs);
    }, []);

    return array_values($referentielPromo);
},

NAME_FUNCTION::LISTER_REFERENTIELS_PROMO_ENCOURS->value => function (): array {
    global $PromotionServices;

    $promotion = $PromotionServices[NAME_FUNCTION::RECUPERER_PROMOTION_EN_COURS->value]();

    if (!$promotion || !isset($promotion['referentiels'])) {
        return []; 
    }

    return $promotion['referentiels'];
},


NAME_FUNCTION::RECUPERER_PROMOTION_EN_COURS->value => function($tab): bool{
      global $JsonService;
      $data = $JsonService[NAME_FUNCTION::JSON_TO_ARRAY->value]();
      $tab = $data["promotions"];

      if(array_column($tab,"etat") !== "en cours"){
        return false;
      }
      return true;
},


 NAME_FUNCTION::AJOUTER_REFERENTIEL->value => function(string $nom,string $description, string $nombreSession,  int $capacite,string $photo = null ):array{
   global  $JsonService;

 
   $data = $JsonService[NAME_FUNCTION::JSON_TO_ARRAY->value]();

 
   if (!isset($data["referentiels"])) {
       $data["referentiels"] = [];
   }

   
   $data["referentiels"][] = [
       'nom' => $nom,
       'description' => $description,
       'nombre-session' => $nombreSession,
       'photo' => $photo ?? "/ges-apprenant/public/assets/images/dg.png",
       'capacite' => $capacite
   ];

   $JsonService[NAME_FUNCTION::ARRAY_TO_JSON->value]($data);

   return $data["referentiels"]; 
 },

 NAME_FUNCTION::RECHERCHER_REFS_PAR_NOM-> value => function($query):array{
    global $ReferentielServices;

    $data = $ReferentielServices[NAME_FUNCTION::LISTER_REFERENTIELS->value]();

    return array_values(array_filter($data, function($referentiel) use ($query) {
        return stripos($referentiel["nom"], $query) !== false;
    }));

 },


 NAME_FUNCTION::RECHERCHER_REF_EN_COURS_PAR_NOM->value => function(string $query){
      global $ReferentielServices;

      $data = $ReferentielServices[NAME_FUNCTION::LISTER_REFERENTIELS_PROMO_ACTIVE->value]();
      
      return array_values(array_filter($data, function($referentiel) use ($query) {
        return stripos($referentiel["nom"], $query) !== false;
    }));
 },

 NAME_FUNCTION::RECHERCHER_REF_PAR_NOM->value => function(string $query){
    global $ReferentielServices;

    $data = $ReferentielServices[NAME_FUNCTION::LISTER_REFERENTIELS->value]();
    
    return array_values(array_filter($data, function($referentiel) use ($query) {
      return stripos($referentiel["nom"], $query) !== false;
  }));
},

NAME_FUNCTION::AFFECTER_REFERENTIEL_PROMOTION->value => function ($promotionName, $referentiels) use (&$JsonService): bool {
    $data = $JsonService[NAME_FUNCTION::JSON_TO_ARRAY->value]();
    $success = false;

    $data["promotions"] = array_map(function ($promotion) use ($promotionName, $referentiels, &$success) {
        if ($promotion["nom"] === $promotionName) {
            $success = true;
            $promotion["referentiels"] = array_values(array_unique(array_merge(
                $promotion["referentiels"] ?? [],
                $referentiels
            )));
        }
        return $promotion;
    }, $data["promotions"]);

    if ($success) {
        $JsonService[NAME_FUNCTION::ARRAY_TO_JSON->value]($data);
    }

    return $success;
},

NAME_FUNCTION::SET_REFERENTIELS_PROMOTION->value => function ($promotionName, $referentiels) use (&$JsonService): bool {
    $data = $JsonService[NAME_FUNCTION::JSON_TO_ARRAY->value]();
    $success = false;

    $data["promotions"] = array_map(function ($promotion) use ($promotionName, $referentiels, &$success) {
        if ($promotion["nom"] === $promotionName) {
            $success = true;
            $promotion["referentiels"] = $referentiels;
        }
        return $promotion;
    }, $data["promotions"]);

    if ($success) {
        $JsonService[NAME_FUNCTION::ARRAY_TO_JSON->value]($data);
    }

    return $success;
}


];

