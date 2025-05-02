<?php 
require_once __DIR__ ."/../model.php";
require_once __DIR__ . "/../../libs/src/PHPMailer.php";
    require_once __DIR__ . '/../../libs/src/SMTP.php';
    require_once __DIR__ . '/../../libs/src/Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
use App\Enums\NAME_FUNCTION;

$ApprenantServices = [
   NAME_FUNCTION::LISTER_APPRENANTS->value => function(): array {
      global $PromotionServices; 
  
      $promotion = $PromotionServices[NAME_FUNCTION::RECUPERER_PROMOTION_EN_COURS->value]();
  
      if (!empty($promotion)) {
          return $promotion["apprenants"];
      }
  
      return [];
  },

  NAME_FUNCTION::INSCRIRE_APPRENANT->value => function (
   string $matricule,
   string $telephone,
   string $nomComplet,
   string $email,
   string $adresse,
   string $referentiel,
   string $status = 'actif',
   string $photo = null
): array {
   global $PromotionServices, $JsonService,$ApprenantServices;
   
   $data = $JsonService[NAME_FUNCTION::JSON_TO_ARRAY->value]();
   
   if (!isset($data['promotions']) || !is_array($data['promotions'])) {
       $data['promotions'] = [];
   }
   

   if (!isset($data['users']) || !is_array($data['users'])) {
       $data['users'] = [];
   }
   
   $PromotionEnCours = $PromotionServices[NAME_FUNCTION::RECUPERER_PROMOTION_EN_COURS->value]();
   
   foreach ($data['promotions'] as &$promotion) {
       if (isset($PromotionEnCours)) {
           if (!isset($promotion['apprenants']) || !is_array($promotion['apprenants'])) {
               $promotion['apprenants'] = [];
           }
           
           $motDePasseTemporaire = 'Apprenant@2025';
           $passwordHash = password_hash($motDePasseTemporaire, PASSWORD_DEFAULT);
           
           $nouvelApprenant = [
               'matricule' => $matricule,
               'telephone' => $telephone,
               'nom-complet' => $nomComplet,
               'email' => $email,
               'adresse' => $adresse,
               'referentiel' => $referentiel,
               'status' => $status,
               'photo' => $photo ?? "/ges-apprenant/public/assets/images/avatar-apprenant.png",
               'password' => $passwordHash,
               'must_change_password' => true
           ];
           
           
           $promotion['apprenants'][] = $nouvelApprenant;
           
           
           $data['users'][] = [
               'login' => $email,
               'password' => $passwordHash, 
               'profil' => 'apprenant',
               'must_change_password' => true
           ];
           
           $JsonService[NAME_FUNCTION::ARRAY_TO_JSON->value]($data);
           
           $ApprenantServices["envoyer_mail_apprenant"]($email, $email, $motDePasseTemporaire);
           
           return $nouvelApprenant;
       }
   }
   
   return [];
},


"envoyer_mail_apprenant" => function ($toEmail, $login, $motDePasse) {
    $mail = new PHPMailer(true);

    try {
    
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'gueyeprophete287@gmail.com'; 
        $mail->Password   = 'pmlh zrpo stlj dsdx'; 
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        
        $mail->setFrom('gueyeprophete287@gmail.com', 'Support GesApprenant');
        $mail->addAddress($toEmail);

       
        $mail->isHTML(true);
        $mail->Subject = "Bienvenue sur GesApprenant - Vos identifiants de connexion";
        $mail->Body    = "
            <h2>Bienvenue sur notre plateforme !</h2>
            <p><strong>Login :</strong> $login</p>
            <p><strong>Mot de passe temporaire :</strong> $motDePasse</p>
            <p><a href='http://www.gueye.mohamed.sa.edu.sn:67/ges-apprenant/public/index.php?action=page_changer_password'>Cliquez ici pour vous connecter</a></p>
            <p><strong>⚠️ Important :</strong> Merci de changer votre mot de passe à votre première connexion.</p>
            <br><p>Cordialement,<br>L'équipe GesApprenant.</p>
        ";
 
        $mail->SMTPDebug = 2;
        $mail->send();
        return true;

    } catch (Exception $e) {
      echo "Erreur d'envoi : " . $mail->ErrorInfo; 
      $logFile = __DIR__ . '/emails_error_log.txt';
      file_put_contents($logFile, "Erreur envoi email vers $toEmail: " . $mail->ErrorInfo . PHP_EOL, FILE_APPEND);
      return false;
  }
  
},

NAME_FUNCTION::GENERER_MATRICULE->value  => function(): string {
   return (string) "MAT" . rand(100, 999);
},
 
   "rechercher_mat_apprenant" => function (string $matricule):?string{
        global $ApprenantServices;

        $apprenants = $ApprenantServices[NAME_FUNCTION::LISTER_APPRENANTS->value]();

        foreach($apprenants as $apprenant){
         if($matricule == $apprenant["matricule"]){
            return $apprenant;
         }
        }
        return null;
   },

   NAME_FUNCTION::RECHERCHER_APPRENANT_PAR_EMAIL-> value => function($query):array{
      global $ApprenantServices;
  
      $data = $ApprenantServices[NAME_FUNCTION::LISTER_APPRENANTS->value]();
  
      return array_values(array_filter($data, function($apprenant) use ($query) {
          return stripos($apprenant["email"], $query) !== false;
      }));
  
   },

   NAME_FUNCTION::LISTER_APPRENANT_PAR_MATRICULE->value => function (string $matricule){
      global $ApprenantServices;

      $apprenants =  $ApprenantServices[NAME_FUNCTION::LISTER_APPRENANTS->value]();

      foreach($apprenants as $apprenant){
        if($apprenant['matricule'] == $matricule){
           return $apprenant;
        }
      }
      return null;
   },

   NAME_FUNCTION::RECUPERER_APPRENANT_PAR_EMAIL->value => function (string $email){
      global $ApprenantServices;

      $apprenants = $ApprenantServices[NAME_FUNCTION::LISTER_APPRENANTS->value]();
      
      foreach($apprenants as $apprenant){
         if($apprenant['email'] == $email){
            return $apprenant;
         }
      }
      return null;
   }

     
   
];


