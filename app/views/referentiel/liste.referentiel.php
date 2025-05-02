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
         <h1> Tous les Réferentiels </h1>
         <h3>liste complete des referentiels de formation </h3>
       </div>
       
       </div>
       <br><br>
       <div class="third">
       
       <form class="input-third" method="GET" action="index.php" style="display: flex; gap: 10px;">
         <input type="hidden" name="menu" value="referentiel">
         <input type="hidden" name="action" value="rechercher_sur_toutes">
         
         <input type="text" classe="input-recherche" name="query"  placeholder="Rechercher par nom..." style="width: 100%;border:none"><button type="submit" class="btn-filtrer">Rechercher</button>
            
         </form>
       
       <div class="ajout-referentiel">
       <img class="icons-topbar" src="/ges-apprenant/public/assets/icons/plus.png"  alt="">
       <a href="index.php?menu=referentiel&action=creation_page" class="ajout-link">creer un referentiels </a>
      
       </div>
       </div>
    
     <br><br>
       <div class="card">
       
       <?php if(!empty($referentiels)): ?>
    <?php foreach($referentiels as $referentiel): ?>
        <div class="card-content-tout-ref">
            <img class="img-card" src="<?= htmlspecialchars($referentiel["photo"] ?? "default.png") ?>" alt="img">
            <h3><?= htmlspecialchars($referentiel["nom"]) ?></h3>
            <p><?= htmlspecialchars($referentiel["description"]) ?></p>
            <br>
            <div class="card-footer-tr">
                <div class="icon-card-tr">
                    <span>Capacité :  </span>&nbsp;<?= htmlspecialchars($referentiel["capacite"]) ?> <h4>&nbsp;places</h4>
                </div>
            </div>
        </div>
    <?php endforeach ?>
<?php else: ?>
    <p>Aucun référentiel trouvé.</p>
<?php endif ?>

<div class="pagination-container">
      <form method="get" class="page-selector" style="display: flex; align-items: center;">
        <input type="hidden" name="menu" value="referentiel">
        <input type="hidden" name="action" value="lister">
        
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
                  <a href="index.php?menu=referentiel&action=lister&page=<?= $pagination['precedente'] ?>" class="nav-button" title="Page précédente">
                      <div class="nav-arrow">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                          </svg>
                      </div>
                  </a>
              <?php endif; ?>

              <?php foreach ($pagination['pages'] as $page): ?>
                  <a href="index.php?menu=referentiel&action=lister&page=<?= $page ?>" class="nav-button <?= $page == $pagination['page_actuelle'] ? 'active' : '' ?>">
                      <?= $page ?>
                  </a>
              <?php endforeach; ?>

              <?php if ($pagination['suivante']): ?>
                  <a href="index.php?menu=referentiel&action=lister&page=<?= $pagination['suivante'] ?>" class="nav-button" title="Page suivante">
                      <div class="nav-arrow">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                          </svg>
                      </div>
                  </a>
              <?php endif; ?>
          </div>
      </div>
       </div>
      
    </div>
    
    
  </main>
  </div>
  </div>