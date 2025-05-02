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
       <div class="first">
       <div class="title">
         <h1> Promotions </h1>
         <h3>Gérer les promotions de l'école</h3>
       </div>
       <div class="ajout">
       <img class="icons-topbar" src="/ges-apprenant/public/assets/icons/plus.png"  alt="">
       <a href="index.php?menu=promotion&action=creation_page" class="ajout-link">ajouter une promotions </a>
       </div>
       </div>
       <br><br>
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
       <br>
       <div class="third">

       <form class="filtre-form-grid" method="get" action="index.php" style="display: flex; gap: 10px; align-items: center;">
           <input type="hidden" name="menu" value="promotion">
            <input type="hidden" name="action" value="default">

            <input type="text" class="input-recherche" name="query" placeholder="Rechercher par nom..." value="<?= htmlspecialchars($query ?? '') ?>" style="width: 100%; border: none;">


            <select class="filtrer-grid" name="status" id="status">
                <option value="">TOUS</option>
                <option value="active" <?= ($status_selectionne == 'active') ? 'selected' : '' ?>>Active</option>
                <option value="inactive" <?= ($status_selectionne == 'inactive') ? 'selected' : '' ?>>Inactive</option>
            </select>

            <button type="submit" class="btn-filtrer">Rechercher</button>
        </form>


       <div class="grid">
         <h3>Grid</h3>
       </div>
       <div class="list">
       <a href="index.php?menu=promotion&action=lister"  style="text-decoration: none;color:black"><h3> List</h3></a>
       </div>      
       </div>
        
         <?php if(!empty($promotions )): ?>
       <div class="four">
         <?php foreach($promotions as $prom): ?>
          <div class="prom-grid">
             <div class="lign1">
                  <div <?php if($prom['status'] == "active"): ?> class="etat-active"  <?php else :  ?>  class="etat-inactive"   <?php endif ?> >
                    <h3><?= htmlspecialchars($prom['status']) ?></h3>
                  </div>
                  <div class="<?= $prom['status'] === 'active'  ? 'button-active'  : 'button-inactive' ?>" >
                  <a href="index.php?menu=promotion&action=changer_status&nom=<?= urlencode($prom['nom']) ?>" title="Changer le statut">
                     <img src="<?= $prom['status'] === 'active'  ? '/ges-apprenant/public/assets/icons/on.png' : '/ges-apprenant/public/assets/icons/off.png' ?>" 
                        class="<?= $prom['status'] === 'active'  ? 'gril-icon-active' : 'gril-icon-inactive' ?>" alt="Changer statut">
                  </a>
                  </div>
             </div>
             <div class="lign2">
                <div class="img-prom">
                  <img src="<?= htmlspecialchars($prom['photo']) ?>" alt="">
                    
                </div>
                <div class="info-prom">
                   <h2>   <?= htmlspecialchars($prom['nom']) ?></h2>
                    <div class="date-prom">
                    <img class="date-icon" src="/ges-apprenant/public/assets/icons/calendrier.png"   alt="">
                    <p><?= htmlspecialchars($prom['date-debut']) ?> - <?= htmlspecialchars($prom['date-fin']) ?></p>
                    </div>
                </div>
             </div>
             <br>
             <div class="lign3">
                 <img class="appr-icon" src="/ges-apprenant/public/assets/icons/appr.png" alt="dashbord">
                 <h4>0 <strong> Apprenants </strong>  </h4>
             </div>
             <br>
             <div class="lign4">
                <a href="#">Voir details</a>
                <img class="arrow" src="/ges-apprenant/public/assets/icons/arrow.png" alt="suivant">
             </div>
          </div>
        
          <?php endforeach ?>  
          
          <div class="pagination-container">
    <form method="get" class="page-selector" style="display: flex; align-items: center;">
        <input type="hidden" name="menu" value="promotion">
    
        
        
        <?php if (!empty($query)): ?>
        <input type="hidden" name="query" value="<?= htmlspecialchars($query) ?>">
        <?php endif; ?>
        
        <?php if (!empty($status_selectionne)): ?>
        <input type="hidden" name="status" value="<?= htmlspecialchars($status_selectionne) ?>">
        <?php endif; ?>
        
        <?php if (!empty($referentiel)): ?>
        <input type="hidden" name="referentiel" value="<?= htmlspecialchars($referentiel) ?>">
        <?php endif; ?>
        
        <span style="color:black; margin-right: 5px;">page</span>
        
        <input 
            type="number" 
            class="page-input" 
            name="page" 
            min="1" 
            max="<?= $pagination['total_pages'] ?>" 
            value="<?= $pagination['page_actuelle'] ?>" 
            style="width: 50px;"
        >
    </form>

    <div class="page-info">
        <?= $pagination['start'] ?> à <?= $pagination['end'] ?> pour <?= $pagination['total'] ?>
    </div>

    <div class="navigation">
    <?php if ($pagination['precedente']): ?>
    <a href="index.php?menu=promotion&action=default&page=<?= $pagination['precedente'] . $pagination['url_params'] ?>" class="nav-button" title="Page précédente">
    <div class="nav-arrow">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
         <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </div>
    </a>
<?php endif; ?>

<?php foreach ($pagination['pages'] as $page): ?>
    <a href="index.php?menu=promotion&action=default&page=<?= $page . $pagination['url_params'] ?>" class="nav-button <?= $page == $pagination['page_actuelle'] ? 'active' : '' ?>">
        <?= $page ?>
    </a>
<?php endforeach; ?>

<?php if ($pagination['suivante']): ?>
    <a href="index.php?menu=promotion&action=default&page=<?= $pagination['suivante'] . $pagination['url_params'] ?>" class="nav-button" title="Page suivante">
    <div class="nav-arrow">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
     </div>
    </a>
<?php endif; ?>
    </div>
</div>
            
         
      <?php endif?>
      <?php if(empty($promotions)):  ?>
        <p><?= htmlspecialchars("pas de promotion disponible ! ") ?> </p>
        <?php endif?>
      
       </div>

       <br> <br>
 </div>
    
  </main>
  </div>
  </div>