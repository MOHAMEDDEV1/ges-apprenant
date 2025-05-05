<?php
require_once __DIR__ ."/../model.php";
use App\Enums\NAME_FUNCTION;

$AbsenceService = [

    NAME_FUNCTION::LISTER_ABSENCES->value => function(string $matricule): array {
        global $JsonService;
    
        $data = $JsonService[NAME_FUNCTION::JSON_TO_ARRAY->value]();
        
        if (!isset($data['absences']) || !is_array($data['absences'])) {
            return [];
        }
        
        $result = array_filter($data['absences'], function($absence) use ($matricule) {
            return isset($absence['mat-apprenant']) && $absence['mat-apprenant'] === $matricule;
        });
        
        return array_values($result);
    },
];
