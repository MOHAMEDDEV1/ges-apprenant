
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
   <div class="content-form-ref">
     <div class="title-form2">
     <h3>affecter une réferentiel à la  </h3><h1><?= htmlspecialchars($nomPromoActive) ?></h1>
     <a href="index.php?menu=referentiel">
     <!-- <img class="fermer-icon" src="/ges-apprenant/public/assets/icons/fermer.png" alt="dashbord"> -->
     </a>
      </div>

      <br>
     

<?php
$couleurs = ['#e7f7ef', ' #e6f0ff', '#f0e6ff', '#fff2e0', ' #ffe6f0'];
$textcolor = ['#34b47b', '#4d8dff', '#9c6ade','#f5a623', '#e83e8c'];
?>


    <form class="affecter-form" action="index.php?menu=referentiel&action=affecter_ref" method="post">
    <div class="form-group">
        <label class="form-label">Libellé référentiel</label>
        <input type="text" class="form-input" name="libelle_referentiel" list="referentiels-disponibles" placeholder="Cloud & CyberSec...">
        <datalist id="referentiels-disponibles">
            <?php foreach ($disponibles as $ref): ?>
                <option value="<?= htmlspecialchars($ref['nom']) ?>"></option>
            <?php endforeach; ?>
        </datalist>
        
    </div>

    <div class="form-group">
    <label class="form-label">Référentiels affectés à la promotion active</label>
    <div class="tags-container">
        <?php foreach ($referentiels as $i => $ref): ?>
            <label class="tag" style="background-color: <?= $couleurs[$i % count($couleurs)] ?>; color: <?= $textcolor[$i % count($textcolor)] ?>; display: flex; align-items: center; padding: 6px 10px; border-radius: 4px;">
                <input 
                    type="checkbox" 
                    name="referentiels[]" 
                    value="<?= htmlspecialchars($ref['nom']) ?>" 
                    checked 
                    style="margin-right: 10px;"
                >
                <?= htmlspecialchars($ref['nom']) ?>
            </label>
        <?php endforeach; ?>
    </div>

</div>



    <button type="submit" class="button-affecter">Terminer</button>
</form>



   </div>
</div>
    
