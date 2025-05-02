<?php 
use function App\Controllers\errors\get_error;
?>
 <link rel="stylesheet" href="/ges-apprenant/public/assets/css/style.css?v=<?= time() ?>">
<div class="right-content">
  <section class="top-sidebar">
    <div class="input-container">
    <input type="text" class="icon-input" placeholder="Rechercher...">
    </div>
    <div class="top-right">
      <img class="icons-topbar" src="/ges-apprenant/public/assets/icons/notif.png"  alt="">
      <?php if(!empty($user)): ?>
      <div class="profil">
         <img src="<?= htmlspecialchars($user['photo']) ?>" alt="">
      </div>
      <div class="info">
        <p><?= htmlspecialchars($user['login']) ?></p>
        <p><?= htmlspecialchars($user['profil']) ?></p>
      </div>
      <?php endif ?>
    </div>
     
  </section>
  <main class="content-variable">
  <div class="main-container">
  <div class="second">
           <div class="gril">
               <div class="info-gril">
               <h1><?= $stats["nombre_apprenants"] ?></h1>
                   <h4>apprenants</h4>
               </div>
               <div class="icon-content">
                <img class="gril-icon" src="/ges-apprenant/public/assets/icons/appr.png"   alt="">
               </div>
           </div>
           <div class="gril">
               <div class="info-gril">
                   <h1><?= $stats["nombre_referentiels"] ?></h1>
                   <h4>Referentiels</h4>
               </div>
               <div class="icon-content">
                <img class="gril-icon" src="/ges-apprenant/public/assets/icons/referent.png"   alt="">
               </div>
           </div>
           <div class="gril">
               <div class="info-gril">
               <h1><?= $stats["nombre_promotions_actives"] ?></h1>
                   <h4>Promotions Actives</h4>
               </div>
               <div class="icon-content">
                <img class="gril-icon" src="/ges-apprenant/public/assets/icons/valider.png"   alt="">
               </div>
           </div>
           <div class="gril">
               <div class="info-gril">
               <h1><?= $stats["nombre_total_promotions"] ?></h1>
                   <h4>Total promotions</h4>
               </div>
               <div class="icon-content">
                <img class="gril-icon" src="/ges-apprenant/public/assets/icons/folder.png"   alt="">
               </div>
           </div>
       </div>
<div class="container-create-promotion">
   <div class="content-form">
   
     <div class="title-form2">
     <h1>créer une nouvelle promotion</h1>
     <a href="index.php?menu=promotion">
     <!-- <img class="fermer-icon" src="/ges-apprenant/public/assets/icons/fermer.png" alt="dashbord"> -->
     </a>
      </div>
      <h3>Remplissez les informations ci-dessous pour créer une nouvelle promotion.</h3>
      <form class="create-form" action="index.php?menu=promotion&action=ajouter" method="POST" enctype="multipart/form-data">
    <label class="create-label" for="nom">Nom de la promotion</label>
    <input class="create-input" name="nom" type="text" placeholder="ex: Promotion 2025" value="<?= $_POST['nom'] ?? '' ?>">
    <p class="error"><?= get_error('nom') ?></p>

    <div class="date-create">
        <div class="debut">
            <label class="create-label" for="date-debut">Date de début</label>
            <input class="create-input-date" name="date-debut" type="text" placeholder="jj/mm/aaaa" value="<?= $_POST['date-debut'] ?? '' ?>">
            <p class="error"><?= get_error('date-debut') ?></p>
        </div>

        <div class="debut">
            <label class="create-label" for="date-fin">Date de fin</label>
            <input class="create-input-date" name="date-fin" type="text" placeholder="jj/mm/aaaa" value="<?= $_POST['date-fin'] ?? '' ?>">
            <p class="error"><?= get_error('date-fin') ?></p>
        </div>
    </div>

    <label class="upload-label">Photo de la promotion</label>
    <div class="upload-wrapper-prom">
        <input type="file" name="photo" accept="image/*" class="upload-input" />
        <div class="upload-box-prom">
            <span class="upload-text"><strong>Ajouter</strong><br>ou glisser</span>
        </div>
        <p class="upload-info">Format JPG, PNG. Taille max 2MB</p>
        <p class="error"><?= get_error('photo') ?></p>
    </div>


    <?php
$couleurs = ['#e7f7ef', ' #e6f0ff', '#f0e6ff', '#fff2e0', ' #ffe6f0'];
$textcolor = ['#34b47b', '#4d8dff', '#9c6ade','#f5a623', '#e83e8c'];
?>

    <label class="create-label">Référentiels</label>
<div class="tags-container">
    <?php foreach ($referentiels as $ref): ?>
        <label class="tag" style="background-color: <?= $couleurs[$i % count($couleurs)] ?>; color: <?= $textcolor[$i % count($textcolor)] ?>; display: flex; align-items: center; padding: 6px 10px; border-radius: 4px;">
            <input style="margin-right:12px" type="checkbox" name="referentiels[]" value="<?= htmlspecialchars($ref['nom']) ?>"
                <?= (isset($_POST['referentiels']) && in_array($ref['nom'], $_POST['referentiels'])) ? 'checked' : '' ?>>
            
            <?= htmlspecialchars($ref['nom']) ?>
           
        </label>
    <?php endforeach; ?>
</div>

<p class="error"><?= get_error('nom') ?></p>

    <div class="buttons">
        <a href="index.php?menu=promotion">Annuler</a>
        <button class="create-button" type="submit">Créer la promotion</button>
    </div>
</form>


   </div>
</div>

</div>
    
  </main>
  </div>
  </div>
    
</body>
</html>