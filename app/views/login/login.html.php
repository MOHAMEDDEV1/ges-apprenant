<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ges-apprenant/public/assets/css/style.css">
    <title>Login</title>
</head>
<body>
 
<div class="login">
     <div class="container-login">
     <img class="login-img" src="/ges-apprenant/public/assets/images/logo.jpg" alt="logo">
        <h3>Bienvenue Sur <br> <span>Ecole du Code Sonatel Academy</span></h3>
       <br> <h1>Se connecter</h1>

       <br>
       
       <form class="login-form" action="http://www.gueye.mohamed.sa.edu.sn:67/ges-apprenant/public/index.php" method="POST">
        <label class="login-label" for="login">Login</label>
        <input class="login-input" name="login"  type="text" placeholder="matricule ou email" value="<?= htmlspecialchars($old['login'] ?? '') ?>">
        <?php if(!empty($errors['login'])): ?>
          <span class="error"><?=  $errors['login'] ?></span>
          <?php endif ?>

        <label class="login-label" for="password">Mots de passe</label>
        <input class="login-input" type="password" name="password"  placeholder="mot de passe">
        <?php if(!empty($errors['password'])): ?>
          <span class="error"><?=  $errors['password'] ?></span>
          <?php endif ?>
          <p class="login-p">
            <a href="http://www.gueye.mohamed.sa.edu.sn:67/ges-apprenant/public/index.php?action=forgot_password">
                Mot de passe oublié ?
            </a>
        </p>

         <br>
         <br>
         <button class="login-button" type="submit" name="action" value="login"> Se connecter</button>
       </form>

     </div>
</div>
    
</body>
</html>