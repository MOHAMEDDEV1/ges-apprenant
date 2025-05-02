<?php
require_once __DIR__ ."/../model.php";
use App\Enums\NAME_FUNCTION;

$AbsenceService = [

    NAME_FUNCTION::LISTER_ABSENCES->value => function(string $matricule):array{
        global $JsonService;

        $data = $JsonService[NAME_FUNCTION::JSON_TO_ARRAY->value]();
        $absences = $data['absences'];

        $result = [];

        foreach($absences as $absence){
            if($absence['mat-apprenant'] == $matricule){
                $result[] = $absence; 
            }
        }

        return $result; 
    },
];
