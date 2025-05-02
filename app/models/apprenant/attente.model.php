<?php

use App\Enums\NAME_FUNCTION;

require_once __DIR__ ."/../model.php";

$RetenuServices = [

    NAME_FUNCTION::LISTE_DES_ATTENTES->value => function () use (&$JsonService):array{
          $data = $JsonService[NAME_FUNCTION::JSON_TO_ARRAY->value]();
          $retenus = $data['attentes'];

          return $retenus ;
    },
    
    NAME_FUNCTION::AJOUT_AUX_ATTENTES->value => function (string $matricule,string $telephone,string $nom,string $email,string $adresse,string $referentiel,string $status,string $photo) use (&$JsonService):array {
         $data = $JsonService[NAME_FUNCTION::JSON_TO_ARRAY->value]();

        $data["attentes"][] = [
            'matricule' => $matricule,
            'telephone' => $telephone,
            'nom-complet' => $nom,
            'email' => $email,
            'adresse' => $adresse,
            'referentiel' => $referentiel,
            'status' => $status,
            'photo' => $photo
        ];

         $JsonService[NAME_FUNCTION::ARRAY_TO_JSON->value]($data);
         return $data["attentes"];
    },

    NAME_FUNCTION::RECUPERER_APPRENANT_ATTENTE->value => function (string $matricule){
          global $RetenuServices;   

          $attentes = $RetenuServices[NAME_FUNCTION::LISTE_DES_ATTENTES->value]();

          foreach($attentes as $attente){
            if($attente['matricule'] == $matricule){
                return $attente;
            }
          }
          return null;
    }



    
                       



];