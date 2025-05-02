<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="/ges-apprenant/public/assets/css/style.css"> -->
    <!-- <link rel="stylesheet" href="/ges-apprenant/public/assets/css/style.css?v=</?= time() ?>"> -->
    <link rel="stylesheet" href="/ges-apprenant/public/assets/css/style.css?v=<?= time() ?>">

    
    <title>Gestion apprenant Odc</title>
</head>
<body>
  <div class="layout">
  <section class="left-sidebar">
     <img class="img-sidebar" src="/ges-apprenant/public/assets/images/logo.jpg" alt="">

     <div class="box-sidebar">
  
         <h4><?= htmlspecialchars($nomPromoActive) ?></h4>
     </div>

    <div class="container-menu">

     <div class="menu">
      
       <img class="icons" src="/ges-apprenant/public/assets/icons/accueil.png" alt="dashbord">
       <a href=""> 
       <h4  class="menu-title">Tableau de bord</h4>
       </a>
     </div>

     <div class="menu">
     
       <img class="icons" src="/ges-apprenant/public/assets/icons/folder.png" alt="dashbord">
       <a  href="index.php?menu=promotion">
       <h4 class="menu-title">Promotions</h4>
       </a>
     </div>

     <div class="menu">
      
       <img class="icons" src="/ges-apprenant/public/assets/icons/referent.png" alt="dashbord">
       <a href="index.php?menu=referentiel">
       <h4 class="menu-title">Réferentiels</h4>
       </a>
     </div>

     <div class="menu">
    
       <img class="icons" src="/ges-apprenant/public/assets/icons/appr.png" alt="dashbord">
       <a href="index.php?menu=apprenant"> 
       <h4 class="menu-title">Apprenants</h4>
       </a>
     </div>

     <div class="menu">
     
       <img class="icons" src="/ges-apprenant/public/assets/icons/bloc-notes.png" alt="dashbord">
       <a href=""> 
       <h4 class="menu-title">Gestion des presences</h4>
       </a>
     </div>

     <div class="menu">
     
       <img class="icons" src="/ges-apprenant/public/assets/icons/referent.png" alt="dashbord">
       <a href=""> 
       <h4 class="menu-title">Kits & Laptops</h4>
       </a>
     </div>

     <div class="menu">
      
       <img class="icons" src="/ges-apprenant/public/assets/icons/stat.png" alt="dashbord">
       <a href=""> 
       <h4 class="menu-title">Rapports & Stats</h4>
       </a>
     </div>
     </div>
     <div class="deconnection">
     <img class="icons" src="/ges-apprenant/public/assets/icons/se-deconnecter.png" alt="dashbord">
         <a class="deconn-link" href="http://www.gueye.mohamed.sa.edu.sn:67/ges-apprenant/public/index.php">Deconnection</a>
     </div>
   
  </section>
 
 
 
  
</body>
</html>