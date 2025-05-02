<?php
require_once __DIR__ ."/../../models/apprenant/apprenant.model.php";
require_once __DIR__ ."/../../models/apprenant/absence.model.php";
require_once __DIR__ ."/../../models/apprenant/attente.model.php";
require_once __DIR__ . '/../../libs/src/SimpleXLSX.php';
require_once __DIR__ .'/../error.controller.php';
require_once __DIR__ .'/../../libs/src/phpqrcode/qrlib.php';


use function App\Controllers\BaseControllers\redirect_to;
use function App\Controllers\BaseControllers\runder_single_views;
use function App\Controllers\BaseControllers\runder_view;
use App\Enums\NAME_FUNCTION;
use App\Enums\SESSION;
use App\Enums\VALIDATOR;
use App\Enums\MESSAGE_ERREUR;
use Shuchkin\SimpleXLSX;
use function App\Controllers\errors\clear_errors;
use function App\Controllers\errors\get_error;
use function App\Controllers\errors\has_errors;
use function App\Controllers\BaseControllers\paginate;



require_once __DIR__ ."/../controller.php";
function runder_apprenant(){
    global $SessionService;

    $action = $SessionService[SESSION::REQUETE->value]("action","");

    match($action){
        'valider_apprenant' => valider_apprenant_retenu(),
        'attente_apprenants' => lister_attente(),
        'dashbord_apprenant' => ouvrir_apprenant_page(),
        "ajout_excel" => upload_excel(),
        'ajout_apprenant' => ajouter_apprenant(),
        'details_programme' => ouvrir_programme_page(),
        "details_absence" => ouvrir_absence_page(),
        "page_ajout" => ajout_page_app(),
        default => lister_apprenants(),
    };
}

function upload_excel(){
    if (isset($_FILES['fichier_excel'])) {
        if ($_FILES['fichier_excel']['error'] == UPLOAD_ERR_OK) {
            $tmpPath = $_FILES['fichier_excel']['tmp_name'];
            importer_apprenants_excel($tmpPath);
        } else {
            echo "Erreur upload : code erreur = " . $_FILES['fichier_excel']['error'];
        }
    } else {
        echo "Aucun fichier reçu.";
    }  
}

function lister_apprenants(){
    global $ApprenantServices, $SessionService;
    $apprenants = $ApprenantServices[NAME_FUNCTION::LISTER_APPRENANTS->value]();  
    
    $filtre_referentiel = $SessionService[SESSION::GET->value]('referentiel', '');
    $filtrer_status = $SessionService[SESSION::GET->value]('status', '');
    $query = $SessionService[SESSION::GET->value]('query', '');

    $filter_params = [
        'referentiel' => $filtre_referentiel,
        'status' => $filtrer_status,
        'query' => $query,
        'menu' => 'apprenant',
    ];


    $referentiels = array_unique(array_map(function($apprenant) {
        return $apprenant['referentiel'];
    }, $apprenants));

   
    if (!empty($filtre_referentiel)) {
        $apprenants = filtrer_par_referentiel($apprenants, $filtre_referentiel);
    }

    if (!empty($filtrer_status)) {
        $apprenants = array_filter($apprenants, function ($promo) use ($filtrer_status) {
            return strtolower($promo['status']) === strtolower($filtrer_status);
        });
    }

    if (!empty($query)) {
        $apprenants = array_filter($apprenants, function ($promo) use ($query) {
            return stripos($promo['nom-complet'], $query) !== false;
        });
    }

    

  
    $page = $SessionService[SESSION::GET->value]('page',1);
    $resultat = paginate($apprenants, (int)$page, 5,$filter_params);

    runder_view("base.layout.php", "apprenant/list.apprenant.html.php", [
        'apprenants' => $resultat['data'],
        'status_selectionne' => $filtrer_status,
        'query' => $query,
        'referentiel' => $filtre_referentiel,
        'referentiels' => $referentiels, 
        'pagination' => $resultat['pagination'],
    ]);
}


function ajout_page_app(){
    global  $LoginService, $ReferentielServices;

    $referentiels = $ReferentielServices[NAME_FUNCTION::LISTER_REFERENTIELS_PROMO_ENCOURS->value]();
    $user = $LoginService[NAME_FUNCTION::RECUPERER_USER->value]();

    runder_view('base.layout.php', "apprenant/ajout.apprenant.php",[
        'referentiels' => $referentiels,
        'user' => $user,
    ]);
}

function valider_apprenant_retenu(){
    global $RetenuServices, $ReferentielServices, $SessionService;

    $referentiels = $ReferentielServices[NAME_FUNCTION::LISTER_REFERENTIELS_PROMO_ENCOURS->value]();
    $matricule = $SessionService[SESSION::GET->value]('matricule', '');

    if($matricule){
        $apprenant = $RetenuServices[NAME_FUNCTION::RECUPERER_APPRENANT_ATTENTE->value]($matricule);
    }
    runder_view('base.layout.php', "apprenant/ajout.apprenant.php",[
        'apprenant' => $apprenant,
        'referentiels' => $referentiels,
    ]);  
}

function importer_apprenants_excel($fichierTmpPath) {
    global $ApprenantServices, $ValidatorService, $SessionService, $RetenuServices;
    
    $importResults = [
        'total' => 0,
        'success' => 0,
        'failures' => 0,
        'errors' => []
    ];
    
    if ($xlsx = SimpleXLSX::parse($fichierTmpPath)) {
        $rows = $xlsx->rows();

        $dataRows = array_slice($rows, 1);

        $importResults['total'] = count($dataRows);

        array_walk($dataRows, function($row, $index) use (&$importResults, $ApprenantServices, $ValidatorService, $RetenuServices) {
            $nomComplet  = $row[0] ?? '';
            $telephone = $row[1] ?? "";
            $email       = $row[2] ?? '';
            $adresse     = $row[3] ?? '';
            $referentiel = $row[4] ?? '';
            $statut      = $row[6] ?? 'actif';

            clear_errors(); 

            $validationReussie = $ValidatorService[VALIDATOR::VALIDATE_FICHIER_EXCEL->value]($nomComplet, $adresse, $email, $referentiel);
            
            $photoPath = "ges-apprenant/public/assets/images/promotions/78HwybxT b5n REJ8ZKgDJygAAAABJRU.png";
            $matricule = $ApprenantServices[NAME_FUNCTION::GENERER_MATRICULE->value]();
            if ($validationReussie) {
                

                $ApprenantServices[NAME_FUNCTION::INSCRIRE_APPRENANT->value](
                    $matricule,
                    $telephone,
                    $nomComplet,
                    $email,
                    $adresse,
                    $referentiel,
                    $statut,
                    $photoPath
                    
                );

                $importResults['success']++;
            } else {
                $importResults['failures']++;
                $RetenuServices[NAME_FUNCTION::AJOUT_AUX_ATTENTES->value](
                    $matricule,
                    $telephone,
                    $nomComplet,
                    $email,
                    $adresse,
                    $referentiel,
                    $statut,
                    $photoPath
                );
                $fields = ['nom-complet', 'adresse', 'email', 'referentiel'];
                
                $lineErrors = array_reduce($fields, function($carry, $field) {
                    $error = get_error($field);
                    if ($error) {
                        $carry[$field] = $error;
                    }
                    return $carry;
                }, []);

                $importResults['errors'][] = [
                    'line' => $index + 2, 
                    'nom' => $nomComplet,
                    'email' => $email,
                    'errors' => $lineErrors
                ];
            }
        });

        $_SESSION['import_results'] = $importResults;

        runder_view('base.layout.php', 'apprenant/rapport.importation.php');
    } else {
        $importResults['failures'] = 1;
        $importResults['errors'][] = [
            'line' => 0,
            'nom' => 'Fichier',
            'email' => '',
            'errors' => ['fichier' => "Erreur lors de la lecture du fichier : " . SimpleXLSX::parseError()]
        ];
        
        $_SESSION['import_results'] = $importResults;
        runder_view('base.layout.php', 'apprenant/rapport.importation.php');
    }
}


function ajouter_apprenant() {
    global $ApprenantServices, $SessionService, $ValidatorService, $ReferentielServices, $LoginService;

    $matricule = $ApprenantServices[NAME_FUNCTION::GENERER_MATRICULE->value]();
    $telephone = $SessionService[SESSION::POST->value]("telephone", "");
    $nomComplet = $SessionService[SESSION::POST->value]('nom-complet', "");
    $email = $SessionService[SESSION::POST->value]('email', "");
    $adresse = $SessionService[SESSION::POST->value]("adresse","");
    $referentiel = $SessionService[SESSION::POST->value]("referentiel","");

    $photoPath = $ValidatorService[VALIDATOR::VALIDATE_AJOUT_APPRENANT->value]($nomComplet,$telephone, $adresse, $email, $referentiel);

    if ($photoPath !== null) {
        $ApprenantServices[NAME_FUNCTION::INSCRIRE_APPRENANT->value](
            $matricule, 
            $telephone,
            $nomComplet, 
            $email, 
            $adresse, 
            $referentiel, 
            'actif', 
            $photoPath,
            
           
        );
        redirect_to('index.php?menu=apprenant');
    } else {
        $referentiels = $ReferentielServices[NAME_FUNCTION::LISTER_REFERENTIELS_PROMO_ENCOURS->value]();
        $user = $LoginService[NAME_FUNCTION::RECUPERER_USER->value]();
        echo "Échec d'enregistrement !";

        runder_view("base.layout.php", "apprenant/ajout.apprenant.php", [
            'user' => $user,
            'referentiels' => $referentiels,
        ]);
    }
}

function filtrer_par_referentiel(array $apprenants, string $referentiel): array {
    return array_filter($apprenants, function ($appr) use ($referentiel) {
        return strtolower($appr['referentiel'] ?? '') === strtolower($referentiel);
    });
}

function filtrer_par_status(array $apprenants, string $status): array {
    return array_filter($apprenants, function ($appr) use ($status) {
        return strtolower($appr['status'] ?? '') === strtolower($status);
    });
}



function ouvrir_absence_page(){
    global $AbsenceService, $ApprenantServices, $SessionService;
    
    $matricule = $SessionService[SESSION::GET->value]('matricule', '');

    
    if ($matricule) {
        $absences = $AbsenceService[NAME_FUNCTION::LISTER_ABSENCES->value]($matricule);
        $apprenant = $ApprenantServices[NAME_FUNCTION::LISTER_APPRENANT_PAR_MATRICULE->value]($matricule);
        $qrCodeFile = genererQRCode($matricule);
    } else {
        $absences = [];
    }
runder_view('base.layout.php','apprenant/detail.absence.apprenant.php',[
    'absences' => $absences,
    'apprenant' => $apprenant,
    'qrCodeFile'=> $qrCodeFile
]);
}

function ouvrir_programme_page(){
    runder_view('base.layout.php','apprenant/detail.programme.apprenant.php');
}

function genererQRCode($matricule) {
    global $ApprenantServices;

    $apprenant = $ApprenantServices[NAME_FUNCTION::LISTER_APPRENANT_PAR_MATRICULE->value]($matricule);

    $nom = $apprenant['nom-complet'];
    $email = $apprenant['email'];
    $telephone = $apprenant['telephone'] ?? '';
    $referentiel= $apprenant['referentiel'] ?? '';

    $data = [
        'matricule' => $matricule,
        'nom' => $nom,
        'email' => $email,
        'telephone' => $telephone,
        'referentiel' => $referentiel
    ];

    $jsonData = json_encode($data);

    $publicPath = 'assets/images/qr_codes/';
    if (!file_exists($publicPath)) {
        mkdir($publicPath, 0777, true);
    }

    $filename = $publicPath . $matricule . '.png';

    QRcode::png($jsonData, $filename);

    return '/ges-apprenant/public/assets/images/qr_codes/' . $matricule . '.png';
}


function ouvrir_apprenant_page(){
    global $ApprenantServices, $SessionService;
     $email = $SessionService[SESSION::GET->value]('email', '');
  
    if($email){
        $apprenant = $ApprenantServices[NAME_FUNCTION::RECUPERER_APPRENANT_PAR_EMAIL->value]($email);
        $qrCodeFile = genererQRCode($apprenant['matricule']);
    }

    runder_single_views('/apprenant/dashbord.apprenant.php', [
      'apprenant' => $apprenant,
    'qrCodeFile'=> $qrCodeFile

    ]);
}


function lister_attente(){
    global $RetenuServices, $SessionService;
    
    $apprenants = $RetenuServices[NAME_FUNCTION::LISTE_DES_ATTENTES->value]();

    $page = $SessionService[SESSION::GET->value]('page',1);
    $resultat = paginate($apprenants, (int)$page, 5);


    runder_view('base.layout.php', '/apprenant/list.attente.php',[
        'apprenants' => $resultat['data'],
        'pagination' => $resultat['pagination'],
    ]);
}


