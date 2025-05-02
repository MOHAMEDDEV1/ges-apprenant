
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réinitialisation du mot de passe</title>
    <link rel="stylesheet" href="/ges-apprenant/public/assets/css/style.css">
</head>
<body>

<div class="login">
     <div class="container-login">
        <img class="login-img" src="/ges-apprenant/public/assets/images/logo.jpg" alt="logo">
        <h3>Bienvenue Sur <br> <span>Ecole du Code Sonatel Academy</span></h3>
       <br> <h3>Renitialiser le mots de passe </h3>

       <br>
       
       <form class="login-form" action="index.php" method="POST">
        <label class="login-label" for="login">Login</label>
        <input class="login-input" name="login"  type="text" placeholder="matricule ou email" >
        <?php if(!empty($errors['login'])): ?>
          <span class="error"><?=  $errors['login'] ?></span>
          <?php endif ?>

        <label class="login-label" for="password">Mots de passe</label>
        <input class="login-input" type="password" name="new_password"  placeholder="mot de passe">
        <?php if(!empty($errors['password'])): ?>
          <span class="error"><?=  $errors['password'] ?></span>
          <?php endif ?>
        
         <br>
         <br>
         <button class="login-button" type="submit" name="action"value="reset_password">Réinitialiser</button>
         
       </form>
    <a href="index.php" class="login-p">Retour à la connexion</a>


     </div>
</div>

</body>
</html>
