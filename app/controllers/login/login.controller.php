<?php 

namespace App\Controllers\Login;

require_once __DIR__ . '/../../models/login/login.model.php';
require_once __DIR__ . "/../controller.php";
require_once __DIR__ . "/../error.controller.php";

use App\Enums\MESSAGE_ERREUR;
use App\Enums\SESSION;
use App\Enums\NAME_FUNCTION;
use App\Enums\VALIDATOR;


use function App\Controllers\BaseControllers\runder_single_views;
use function App\Controllers\BaseControllers\runder_view;
use function App\Controllers\BaseControllers\redirect_to;



use function App\Controllers\Promotion\grid_promotions;

use function App\Controllers\errors\add_error;

function runder_login() {
    global $SessionService;
    $action =  $SessionService[SESSION::REQUETE->value]('action','');

    match ($action) {
        'page_changer_password' => page_changer_login(),
        'changer_password' => changer_mot_de_passe(),
        "login" => login(),
        "forgot_password" => runder_single_views('login/forgot_password.html.php'),
        "reset_password" => reset_password(),
        default => runder_single_views('login/login.html.php', [
            'errors' => [],
            'old' => [],
        ]),
    };
}

function page_changer_login(){
    runder_single_views('login/changer.password.html.php');
}

function login() {
    global $LoginService, $ValidatorService, $SessionService;
     
    $username = $SessionService[SESSION::POST->value]('login','');
    $password = $SessionService[SESSION::POST->value]('password','');

    if (!$ValidatorService[VALIDATOR::VALIDATE_LOGIN_FORM->value]($username, $password)) {
        return runder_single_views('login/login.html.php', [
            'errors' => $GLOBALS['errors'],
            'old' => ['login' => $username],
        ]);
    } 

    if ($LoginService[NAME_FUNCTION::SE_CONNECTER->value]($username, $password)) {
        $user = $LoginService[NAME_FUNCTION::RECUPERER_USER->value]();
    
        if (!empty($user) && ($user['must_change_password'] ?? false)) {
            return runder_single_views('login/changer_password.html.php');
        }else if($user['profil'] == 'apprenant'){
            redirect_to("index.php?menu=apprenant&action=dashbord_apprenant&email=$user[login]");
        }
    
        return grid_promotions();
    }
     else {
        
        add_error('login', message(MESSAGE_ERREUR::LOGIN_OR_PASSWORD_INCORRECTE->value));
        return runder_single_views('login/login.html.php', [
            'errors' => $GLOBALS['errors'],
            'old' => ['login' => $username],
        ]);
    

    }
}

function reset_password() {
    global $SessionService, $JsonService;

    $login = $SessionService[SESSION::POST->value]('login', '');
    $newPassword = $SessionService[SESSION::POST->value]('new_password', '');

    $data = $JsonService[NAME_FUNCTION::JSON_TO_ARRAY->value]();
    $users = $data["users"];

    $foundKey = array_search($login, array_column($users, 'login'));

    if ($foundKey !== false) {
        $users[$foundKey]["password"] = $newPassword;
        $data["users"] = $users;

        $JsonService[NAME_FUNCTION::ARRAY_TO_JSON->value]($data);

        return runder_single_views('login/login.html.php', [
            'errors' => [],
            'old' => ['login' => $login],
        ]);
    } else {
        add_error('login', "Utilisateur non trouvé.");
        return runder_single_views('login/forgot_password.html.php', [
            'errors' => $GLOBALS['errors']
        ]);
    }
}

function changer_mot_de_passe() {
    global $SessionService, $JsonService;

    $login = $SessionService[SESSION::POST->value]('login', '');
    $newPassword = $SessionService[SESSION::POST->value]('new_password', '');

    $data = $JsonService[NAME_FUNCTION::JSON_TO_ARRAY->value]();
    $users = $data["users"];

    $foundKey = array_search($login, array_column($users, 'login'));

    if ($foundKey !== false) {
        $users[$foundKey]["password"] = $newPassword;
        $users[$foundKey]["must_change_password"] = false;
        $data["users"] = $users;

        $JsonService[NAME_FUNCTION::ARRAY_TO_JSON->value]($data);

        return runder_single_views('login/login.html.php', [
            'errors' => [],
            'old' => ['login' => $login],
        ]);
    } else {
        add_error('login', "Utilisateur non trouvé.");
        return runder_single_views('login/changer.password.html.php', [
            'errors' => $GLOBALS['errors']
        ]);
    }
}





