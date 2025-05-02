<?php 
namespace App\Models\Statistique;

require_once __DIR__ ."/../model.php";
use App\Enums\NAME_FUNCTION;

$StatistiqueService = [
    
    NAME_FUNCTION::CALCULER_STATISTIQUES_PROMOTION_ACTIVE->value => function (): array {
        global $ReferentielServices, $PromotionServices;
    
     

        $referentiels = $ReferentielServices[NAME_FUNCTION::LISTER_REFERENTIELS_PROMO_ACTIVE->value]();
        

        $promotions = $PromotionServices[NAME_FUNCTION::LISTER_PROMOTIONS_ACTIVES->value]();
    

        $nombreApprenants = array_reduce($referentiels, function ($carry, $ref) {
            return $carry + ($ref['capacite'] ?? 0); 
        }, 0);

    
        return [
            'nombre_apprenants' => $nombreApprenants,
            'nombre_referentiels' => count($referentiels),
            'nombre_promotions_actives' => count($promotions),
            'nombre_total_promotions' => count($PromotionServices[NAME_FUNCTION::LISTE_PROMOTIONS->value]()),
        ];
    },

    NAME_FUNCTION::RECUPERER_NOM_PROMO_ACTIVE->value => function (): ?string {
        global $PromotionServices;
    
        $promos = $PromotionServices[NAME_FUNCTION::LISTER_PROMOTIONS_ACTIVES->value]();
    
        return $promos[0]["nom"] ?? null;
    },
    
    
];