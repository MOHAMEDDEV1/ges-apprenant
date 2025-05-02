<?php

require_once __DIR__ ."/../model.php";
use App\Enums\NAME_FUNCTION;
use App\Enums\SESSION;



$LoginService = [

    NAME_FUNCTION::SE_CONNECTER->value => function (string $login, string $password): bool {
        global $JsonService, $SessionService;
        
        $data = $JsonService[NAME_FUNCTION::JSON_TO_ARRAY->value]();
        $users = $data["users"];
        
        $match = array_values(array_filter($users, fn($user) => $user["login"] === $login && $user["password"] === $password));
        
        if (!empty($match)) {
            $_SESSION['profil'] = $match[0]["profil"] ;
            $_SESSION['user_login'] = $match[0]['login'];

            $_SESSION['user'] = $match[0];
            return true;
        }
        
        return false;
    },

    NAME_FUNCTION::RECUPERER_USER->value => function() use(&$SessionService): array {
        global $JsonService;
        $user_login =  $SessionService[SESSION::SESSION_REQUETE->value]('user_login', '');
        if (!isset($user_login)) {
            return [];
        }
    
        $data = $JsonService[NAME_FUNCTION::JSON_TO_ARRAY->value]();
        $users = $data["users"];
    
        $userMatch = array_values(array_filter($users, fn($user) => $user['login'] === $user_login));
    
        return $userMatch[0] ?? [];
    },

    NAME_FUNCTION::USERS->value => function ():array{
        global $JsonService;
         
        $data = $JsonService[NAME_FUNCTION::JSON_TO_ARRAY->value]();
        $users = $data['users'];

        return $users;
    },

    NAME_FUNCTION::CHANGER_MOT_DE_PASSE->value => function (string $ancienMotDePasse, string $nouveauMotDePasse) : bool {
        global $JsonService, $SessionService;
        
        $user_login = $SessionService[SESSION::SESSION_REQUETE->value]('user_login', '');
        $etat_password = $SessionService[SESSION::SESSION_REQUETE->value]('must_change_password', '');
        
        if (!isset($user_login)) {
            return false;
        }
        
        $login = $user_login;
        $data = $JsonService[NAME_FUNCTION::JSON_TO_ARRAY->value]();
        
        $userUpdated = false;
        

        $data['users'] = array_map(function($user) use ($login, $ancienMotDePasse, $nouveauMotDePasse, $etat_password, &$userUpdated) {
            if ($user['login'] === $login) {
                if (isset($etat_password) && $etat_password === true) {
                    $user['password'] = password_hash($nouveauMotDePasse, PASSWORD_DEFAULT);
                    $user['must_change_password'] = false;
                    $userUpdated = true;
                } elseif (password_verify($ancienMotDePasse, $user['password'])) {
                    $user['password'] = password_hash($nouveauMotDePasse, PASSWORD_DEFAULT);
                    $userUpdated = true;
                }
            }
            return $user;
        }, $data['users']);
        
        $profil = $SessionService[SESSION::SESSION_REQUETE->value]('profil', '');
        
        if ($profil === 'APPRENANT') {
          
            $data['promotions'] = array_map(function($promotion) use ($login, $ancienMotDePasse, $nouveauMotDePasse, $etat_password) {
                if (isset($promotion['apprenants']) && is_array($promotion['apprenants'])) {
                    $promotion['apprenants'] = array_map(function($apprenant) use ($login, $ancienMotDePasse, $nouveauMotDePasse, $etat_password) {
                        if ($apprenant['matricule'] === $login) {
                            if (isset($etat_password) && $etat_password === true) {
                                $apprenant['password'] = password_hash($nouveauMotDePasse, PASSWORD_DEFAULT);
                                $apprenant['must_change_password'] = false;
                            } elseif (password_verify($ancienMotDePasse, $apprenant['password'])) {
                                $apprenant['password'] = password_hash($nouveauMotDePasse, PASSWORD_DEFAULT);
                            }
                        }
                        return $apprenant;
                    }, $promotion['apprenants']);
                }
                return $promotion;
            }, $data['promotions']);
        }
        
        if ($userUpdated) {
            $JsonService[NAME_FUNCTION::ARRAY_TO_JSON->value]($data);
            
            if (isset($etat_password)) {
                unset($etat_password);
            }
            
            return true;
        }
        
        return false;
    }

   
];

