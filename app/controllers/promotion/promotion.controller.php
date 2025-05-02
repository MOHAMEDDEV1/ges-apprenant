<?php
namespace App\Controllers\Promotion;
require_once __DIR__ ."/../../models/promotion/promotion.model.php";
require_once __DIR__ ."/../controller.php";
require_once __DIR__ ."/../../models/statistique/stats.model.php";
use App\Enums\SESSION;
use App\Enums\NAME_FUNCTION;
use App\Enums\VALIDATOR;

use function App\Controllers\BaseControllers\redirect_to;
use function App\Controllers\BaseControllers\runder_view;
use function App\Controllers\BaseControllers\runder_single_views;
use function App\Controllers\BaseControllers\paginate;


function runder_promotion(){

    global $SessionService;

    $action = $SessionService[SESSION::REQUETE->value]('action',"default");

    match($action){
        "changer_status" => changer_statut(),
        "rechercher_grid" => rechercher_par_nom_grid(),
        "rechercher_liste" => rechercher_par_nom_liste(),
        "lister" => liste_promotions(),
        "creation_page" => creation_page(),
        "ajouter" => ajouter_promotions(),
        default => grid_promotions(),
    };
}

function liste_promotions(): void {
    global $PromotionServices, $ReferentielServices, $LoginService, $StatistiqueService, $SessionService;

    $promotions_all = $PromotionServices[NAME_FUNCTION::LISTE_PROMOTIONS->value]();
    $referentiels_data = $ReferentielServices[NAME_FUNCTION::LISTER_REFERENTIELS->value]();
    $referentiels = array_column($referentiels_data, 'nom');

    $filtre_referentiel = $SessionService[SESSION::GET->value]('referentiel', '');
    $filtrer_status = $SessionService[SESSION::GET->value]('status', '');
    $query = $SessionService[SESSION::GET->value]('query', '');

    $filter_params = [
        'referentiel' => $filtre_referentiel,
        'status' => $filtrer_status,
        'query' => $query,
        'menu' => 'promotion',
        // 'action' => 'lister'
    ];

    if (!empty($filtre_referentiel)) {
        $promotions_all = filtrer_par_referentiel($promotions_all, $filtre_referentiel);
    }

    if (!empty($filtrer_status)) {
        $promotions_all = array_filter($promotions_all, function ($promo) use ($filtrer_status) {
            return strtolower($promo['status']) === strtolower($filtrer_status);
        });
    }
    if (!empty($query)) {
        $promotions_all = array_filter($promotions_all, function ($promo) use ($query) {
            return stripos($promo['nom'], $query) !== false;
        });
    }
    

    $nomPromoActive = $StatistiqueService[NAME_FUNCTION::RECUPERER_NOM_PROMO_ACTIVE->value]();

  
    $promo_active = null;
    $promotions_restantes = [];

    foreach ($promotions_all as $promo) {
        if ($promo['nom'] === $nomPromoActive) {
            $promo_active = $promo;
        } else {
            $promotions_restantes[] = $promo;
        }
    }

    
   
    $page = $SessionService[SESSION::GET->value]('page',1);
    $resultat = paginate($promotions_restantes, (int)$page, 3,$filter_params);

    
    if ($promo_active !== null) {
        array_unshift($resultat['data'], $promo_active);
    }

    $user = $LoginService[NAME_FUNCTION::RECUPERER_USER->value]();
    $stats = $StatistiqueService[NAME_FUNCTION::CALCULER_STATISTIQUES_PROMOTION_ACTIVE->value]();

    runder_view("base.layout.php", "promotions/list.promotion.php", [
        'promotions' => $resultat['data'],
        'pagination' => $resultat['pagination'],
        'user' => $user,
        'stats' => $stats,
        'nomPromoActive' => $nomPromoActive,
        'referentiels' => $referentiels,
        'referentiel_selectionne' => $filtre_referentiel,
        'status_selectionne' => $filtrer_status,
    ]);
}

function grid_promotions(): void {
    global $PromotionServices, $ReferentielServices, $LoginService, $StatistiqueService, $SessionService;

    $promotions_all = $PromotionServices[NAME_FUNCTION::LISTE_PROMOTIONS->value]();
    $referentiels_data = $ReferentielServices[NAME_FUNCTION::LISTER_REFERENTIELS->value]();
    $referentiels = array_column($referentiels_data, 'nom');

    $filtre_referentiel = $SessionService[SESSION::GET->value]('referentiel', '');
    $filtrer_status = $SessionService[SESSION::GET->value]('status', '');
    $query = $SessionService[SESSION::GET->value]('query', '');

    $filter_params = [
        'referentiel' => $filtre_referentiel,
        'status' => $filtrer_status,
        'query' => $query,
        'menu' => 'promotion',
        
    ];

    if (!empty($filtre_referentiel)) {
        $promotions_all = filtrer_par_referentiel($promotions_all, $filtre_referentiel);
    }

    if (!empty($filtrer_status)) {
        $promotions_all = array_filter($promotions_all, function ($promo) use ($filtrer_status) {
            return strtolower($promo['status']) === strtolower($filtrer_status);
        });
    }

    if (!empty($query)) {
        $promotions_all = array_filter($promotions_all, function ($promo) use ($query) {
            return stripos($promo['nom'], $query) !== false;
        });
    }

    $nomPromoActive = $StatistiqueService[NAME_FUNCTION::RECUPERER_NOM_PROMO_ACTIVE->value]();
    $promo_active = null;
    $promotions_restantes = [];

    foreach ($promotions_all as $promo) {
        if ($promo['nom'] === $nomPromoActive) {
            $promo_active = $promo;
        } else {
            $promotions_restantes[] = $promo;
        }
    }
   
    $page = $SessionService[SESSION::GET->value]('page', 1);

    $resultat = paginate($promotions_restantes, (int)$page, 2, $filter_params);

    if ($promo_active !== null) {
        array_unshift($resultat['data'], $promo_active);
    }

    $user = $LoginService[NAME_FUNCTION::RECUPERER_USER->value]();
    $stats = $StatistiqueService[NAME_FUNCTION::CALCULER_STATISTIQUES_PROMOTION_ACTIVE->value]();

    runder_view("base.layout.php", "promotions/grid.promotion.php", [
        'promotions' => $resultat['data'],
        'pagination' => $resultat['pagination'],
        'user' => $user,
        'stats' => $stats,
        'nomPromoActive' => $nomPromoActive,
        'status_selectionne' => $filtrer_status,
        'query' => $query,
        'referentiel' => $filtre_referentiel
    ]);
}


function creation_page():void{
    global $ReferentielServices, $LoginService, $StatistiqueService;
    $referentiels = $ReferentielServices[NAME_FUNCTION::LISTER_REFERENTIELS->value]();
    
    $user = $LoginService[NAME_FUNCTION::RECUPERER_USER->value]();
    $stats = $StatistiqueService[NAME_FUNCTION::CALCULER_STATISTIQUES_PROMOTION_ACTIVE->value]();
    
    runder_view("base.layout.php","promotions/form.promotion.php", [
        'referentiels' => $referentiels ,
        'user' => $user,
        'stats' => $stats,
    ]);
   
}

function ajouter_promotions() {
    global $SessionService, $PromotionServices, $ValidatorService, $ReferentielServices, $LoginService;

    $nom = $SessionService[SESSION::POST->value]("nom", "");
    $dateDebut = $SessionService[SESSION::POST->value]("date-debut", "");
    $dateFin = $SessionService[SESSION::POST->value]("date-fin", "");
    $status = "inactive";

    $refs = $SessionService[SESSION::POST->value]("referentiels", []);

    $allReferentiels = $ReferentielServices[NAME_FUNCTION::LISTER_REFERENTIELS->value]();
    $nomsValidReferentiels = array_column($allReferentiels, 'nom');

    $refs = array_filter($refs, fn($refNom) => in_array($refNom, $nomsValidReferentiels));

    $photoPath = $ValidatorService[VALIDATOR::VALIDATE_PROMOTION_FORM->value]($nom, $dateDebut, $dateFin);

    if ($photoPath !== null) {
        $PromotionServices[NAME_FUNCTION::AJOUTER_PROMOTIONS->value](
            $nom,
            $dateDebut,
            $dateFin,
            $photoPath,
            $status,
            $refs 
        );
        redirect_to('index.php?menu=promotion');
        exit;
    }else {
        $user = $LoginService[NAME_FUNCTION::RECUPERER_USER->value]();
        $referentiels = $ReferentielServices[NAME_FUNCTION::LISTER_REFERENTIELS->value]();
    
        runder_view("base.layout.php", "promotions/form.promotion.php", [
            "old" => compact("nom", "dateDebut", "dateFin"),
            'user' => $user,
            'referentiels' => $referentiels, 
        ]);
    }
    
}


    function rechercher_par_nom_grid() {
        global $PromotionServices;
    
        $query = isset($_GET['query']) ? trim($_GET['query']) : '';
    
        if ($query !== '') {
            $promotions = $PromotionServices[NAME_FUNCTION::RECHERCHER_PROMO_PAR_NOM->value]($query);
        } else {
            $promotions = $PromotionServices[NAME_FUNCTION::LISTE_PROMOTIONS->value]();
        }
    
        runder_view("base.layout.php", "promotions/grid.promotion.php", [
            'promotions' => $promotions
        ]);
        
    }

    function rechercher_par_nom_liste() {
        global $PromotionServices, $SessionService;

        $text = $SessionService[SESSION::GET->value]('query');
    
        $query = isset($text) ? trim($text) : '';
    
        if ($query !== '') {
            $promotions = $PromotionServices[NAME_FUNCTION::RECHERCHER_PROMO_PAR_NOM->value]($query);
        } else {
            $promotions = $PromotionServices[NAME_FUNCTION::LISTE_PROMOTIONS->value]();
        }
    
        runder_view("base.layout.php", "promotions/list.promotion.php", [
            'promotions' => $promotions
        ]);
    }

    function changer_statut(): void {
        global $PromotionServices, $SessionService;
        $nom = $SessionService[SESSION::GET->value]('nom',"");
    
        if ($nom) {
            $PromotionServices[NAME_FUNCTION::CHANGER_STATUS_PROMOTION->value]($nom);
        }
    
        header("Location: index.php?menu=promotion");
        exit;
    }

    function filtrer_par_referentiel(array $promotions, string $referentiel): array {
        return array_filter($promotions, function ($promo) use ($referentiel) {
            return in_array($referentiel, $promo['referentiels'] ?? []);
        });
    }

    function filtrer_par_status(array $promotions, string $status):array{
        return array_filter($promotions, function($promo) use($status):bool {
            return in_array($status, $promo['status'] ?? "");
        });
    }
    
    
    
    