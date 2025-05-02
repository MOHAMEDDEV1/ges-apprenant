<?php

use App\Enums\MESSAGE_ERREUR;

return [
    MESSAGE_ERREUR::CHAMP_OBLIGATOIRE->value => fn (string $champ ) => "le champ $champ  est requis.",
    MESSAGE_ERREUR::CARACTERE_MINIMUM->value =>  fn(string $champ,int $min ) => "le champ  $champ doit contenir au moins $min caractères.",
    MESSAGE_ERREUR::NOM_EXISTE->value => fn(string $champ) => "Ce $champ existe déjà.",
   
    MESSAGE_ERREUR::FORMAT_DATE->value => "La date doit être au format jj/mm/aaaa.",
   
    MESSAGE_ERREUR::DATE_DEBUT_INFERIEUR->value => "La date de début ne peut pas être supérieure à la date de fin.",

    MESSAGE_ERREUR::PHOTO_TYPE->value => "Seuls les formats JPG et PNG sont autorisés.",
    MESSAGE_ERREUR::TAILLE_PHOTO->value => "La taille du fichier ne doit pas dépasser 2 Mo.",

    MESSAGE_ERREUR::LOGIN_OR_PASSWORD_INCORRECTE->value => "Nom d'utilisateur ou mot de passe incorrect.",
    MESSAGE_ERREUR::REFERENTIEL_PAS_ENCOURS->value => "le referentiel ne fait pas partie des referentiels de la promotion en cours!",
    MESSAGE_ERREUR::NUMERO_INVALIDE->value => "le numero saisi est invali ",
  // MESSAGE_ERREUR::REFERENTIEL_PAS_ENCOURS->value => "Operation impossible  Le referentiel n'est pas en cours "
];
