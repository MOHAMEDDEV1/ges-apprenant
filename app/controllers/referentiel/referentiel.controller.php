<?php
namespace App\Controllers\referentiel;
require_once __DIR__ ."/../../models/referentiel/referentiel.model.php";
require_once __DIR__ ."/../controller.php";

use App\Enums\SESSION;
use App\Enums\NAME_FUNCTION;
use App\Enums\VALIDATOR;

use function App\Controllers\BaseControllers\redirect_to;
use function App\Controllers\BaseControllers\runder_view;
use function App\Controllers\BaseControllers\runder_single_views;



function runder_referentiel():void{
    global $SessionService;
    $action = $SessionService[SESSION::REQUETE->value]("action","default");

    match($action){
        "rechercher_sur_toutes" => rechercher_refs_par_nom(),
        "rechercher" => rechercher_en_cours_par_nom(),
        "affecter_ref" => affecter_referentiel(),
        "affecter" => affecter_page(),
        "lister" => lister_tous_referentiel(),
        "ajouter" => ajouter_referentiels(),
        "creation_page" => creation_page_ref(),
        default => lister_referentiel_en_cours(),
    };
}


function lister_tous_referentiel(){
    global $ReferentielServices, $SessionService, $LoginService, $StatistiqueService;

    $referentiels_all = $ReferentielServices[NAME_FUNCTION::LISTER_REFERENTIELS->value]();


    $par_page = 4;
    $total_referentiels = count($referentiels_all);
    $total_pages = ceil($total_referentiels/$par_page);
    $page = $SessionService[SESSION::GET->value]('page', "");
    $page_actuelle = isset($page) ? (int)$page :1;
    $page_actuelle = max(1,min($total_pages,$page_actuelle));

    $start_index = ($page_actuelle -1) * $par_page;

    $referentiels = array_slice($referentiels_all, $start_index,$par_page);

    $pages = range(1,$total_pages);

    $pagination = [
       'page_actuelle' => $page_actuelle,
        'total_pages' => $total_pages,
        'precedente' => $page_actuelle > 1 ? $page_actuelle - 1 : null,
        'suivante' => $page_actuelle < $total_pages ? $page_actuelle + 1 : null,
        'pages' => $pages,
        'start' => $start_index + 1,
        'end' => min($start_index + $par_page, $total_referentiels),
        'total' => $total_referentiels,
        'par_page' => $par_page,
    ];

    $user = $LoginService[NAME_FUNCTION::RECUPERER_USER->value]();

    $nomPromoActive = $StatistiqueService[NAME_FUNCTION::RECUPERER_NOM_PROMO_ACTIVE->value]();

    runder_view("base.layout.php", "referentiel/liste.referentiel.php",[
        'referentiels' => $referentiels,
        'pagination' => $pagination,
        'user' => $user,
        'nomPromoActive' => $nomPromoActive,
    ]);
}

function creation_page_ref():void{
    runder_view("base.layout.php","/referentiel/creer.referentiel.php");
}

function affecter_page():void{
    global $PromotionServices , $ReferentielServices,$LoginService, $StatistiqueService;
    $promotions = $PromotionServices[NAME_FUNCTION::LISTER_PROMOTIONS_ACTIVES->value]();
   
    $referentiels = $ReferentielServices[NAME_FUNCTION::LISTER_REFERENTIELS_PROMO_ACTIVE->value]();

    $nonAffectes = lister_referentiels_non_affectes();
    $nomPromoActive = $StatistiqueService[NAME_FUNCTION::RECUPERER_NOM_PROMO_ACTIVE->value]();
    $user = $LoginService[NAME_FUNCTION::RECUPERER_USER->value]();
    
    runder_view("base.layout.php","/referentiel/form.referentiel.php", [
        'promotions' => $promotions,
        'referentiels' => $referentiels,
        'disponibles' => $nonAffectes,
        'user' => $user,
        'nomPromoActive' => $nomPromoActive,
        
    ]);
  
}

function lister_referentiel_en_cours(): void {
    global $ReferentielServices, $LoginService, $StatistiqueService;
    $referentiels = $ReferentielServices[NAME_FUNCTION::LISTER_REFERENTIELS_PROMO_ACTIVE->value]();

    $user = $LoginService[NAME_FUNCTION::RECUPERER_USER->value]();
    $nomPromoActive = $StatistiqueService[NAME_FUNCTION::RECUPERER_NOM_PROMO_ACTIVE->value]();

    runder_view("base.layout.php", "referentiel/liste.ref.encour.php", [
        "referentiels" => $referentiels,
        'user' => $user,
        'nomPromoActive' => $nomPromoActive,
    ]);
}

function lister_referentiels_non_affectes(): array {
    global $JsonService;

    $data = $JsonService[NAME_FUNCTION::JSON_TO_ARRAY->value]();
    $referentielsExistants = $data['referentiels'] ?? [];

    
    $promosActives = array_filter($data['promotions'] ?? [], fn($p) => $p['status'] === 'active' && isset($p['referentiels']));
    $referentielsActifs = array_merge(...array_map(fn($p) => $p['referentiels'], $promosActives));

    
    $nonAffectes = array_filter($referentielsExistants, fn($ref) => !in_array($ref['nom'], $referentielsActifs));

    return array_values($nonAffectes);
}



function ajouter_referentiels():void{
    global $SessionService, $ReferentielServices, $ValidatorService,$LoginService;
        $nom = $SessionService[SESSION::POST->value]("nom", "");
        $description = $SessionService[SESSION::POST->value]("description", "");
        $nombreSession = $SessionService[SESSION::POST->value]("nombre-session", "");
        $capacite = $SessionService[SESSION::POST->value]("capacite","");
    

        $photoPath = $ValidatorService[VALIDATOR::VALIDATE_REFERENTIEL_FORM->value]($nom, $description, $capacite,$nombreSession);
        $user = $LoginService[NAME_FUNCTION::RECUPERER_USER->value]();

    if ($photoPath !== null ) {
        $ReferentielServices[NAME_FUNCTION::AJOUTER_REFERENTIEL->value]($nom, $description, $nombreSession,$capacite,$photoPath);
        redirect_to('index.php?menu=referentiel&action=lister');
        exit;
    } else {
            runder_view("base.layout.php","referentiel/creer.referentiel.php", [
                "old" => compact("nom", "description", "capacite"),
                'user' => $user
            ]);
        }
}

function rechercher_en_cours_par_nom(){
    global $ReferentielServices;

    $query = isset($_GET['query']) ? trim($_GET['query']):'';

    if($query !== ""){
        $referentiels = $ReferentielServices[NAME_FUNCTION::RECHERCHER_REF_EN_COURS_PAR_NOM->value]($query);
    }else {
        $referentiels= $ReferentielServices[NAME_FUNCTION::LISTER_REFERENTIELS->value]();
    }

    runder_view("base.layout.php", "referentiel/liste.ref.encour.php", [
        'referentiels' => $referentiels
    ]);

}

function rechercher_refs_par_nom(){
    global $SessionService, $ReferentielServices;
    $value = $SessionService[SESSION::GET->value]('query');
    $query = isset($value) ? trim($value): "";

    if($query !== ""){
        $referentiels = $ReferentielServices[NAME_FUNCTION::RECHERCHER_REFS_PAR_NOM->value]($query);
    }else{
        $referentiels= $ReferentielServices[NAME_FUNCTION::LISTER_REFERENTIELS->value]();
    }

    runder_view("base.layout.php", "referentiel/liste.referentiel.php",[
        'referentiels' => $referentiels
    ]);
}

function affecter_referentiel() {
    global $ReferentielServices, $JsonService, $SessionService, $ValidatorService, $PromotionServices;

    $promotionActive = null;
    $promosActives = $PromotionServices[NAME_FUNCTION::RECUPERER_PROMOTION_EN_COURS->value]();
    
    if (!empty($promosActives)) {
        $promotionActive = $promosActives; // <<< garder tout
    }

    $referentiel = $SessionService[SESSION::POST->value]('libelle_referentiel');
    $referentiels_coches = $_POST['referentiels'] ?? [];

    $ValidatorService[VALIDATOR::VALIDATE_AFFECTER_REF->value]($referentiel);

    if ($promotionActive) {
        $ReferentielServices[NAME_FUNCTION::AFFECTER_REFERENTIEL_PROMOTION->value]($promotionActive['nom'], [$referentiel]);
       
        if (empty($promotionActive['apprenants'])) {
           

            if (!in_array($referentiel, $referentiels_coches)) {
                $referentiels_coches[] = $referentiel;
            }
            $ReferentielServices[NAME_FUNCTION::SET_REFERENTIELS_PROMOTION->value]($promotionActive['nom'], $referentiels_coches);
        }
    } else {
        echo "Operation Impossible : aucune promotion active et en cours.";
    }

    lister_referentiel_en_cours();
}







