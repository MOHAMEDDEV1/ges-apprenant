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
         <h1> Réferentiels </h1>
         <h3>Gérer les réferentiels de la promotion</h3>
       </div>
       
       </div>
       <br><br>
       <div class="third">
       
       <form class="input-third" method="GET" action="index.php" style="display: flex; gap: 10px;">
         <input type="hidden" name="menu" value="referentiel">
         <input type="hidden" name="action" value="rechercher">
         
         <input type="text" classe="input-recherche" name="query"  placeholder="Rechercher par nom..." style="width: 100%;border:none"><button type="submit" class="btn-filtrer">Rechercher</button>
            
         </form>

       <div class="grid-referentiel">
       <img class="icons-topbar" src="/ges-apprenant/public/assets/icons/referent.png"  alt="">
       <a  class="tout-ref-link"  href="index.php?menu=referentiel&action=lister" style="color:white; text-decoration:none">
         <h3>Toutes les référentiels</h3>
         </a>
       </div>
       <div class="ajout-referentiel">
       <img class="icons-topbar" src="/ges-apprenant/public/assets/icons/plus.png"  alt="">
       <a href="index.php?menu=referentiel&action=affecter" class="ajout-link">ajouter à la promotion </a>
      
       </div>
       </div>
     <br><br>
       <div class="card">
        
       <?php foreach ($referentiels as $ref): ?>
       
            <div class="card-content">
            <a href="index.php?menu=apprenant&action=rechercher_liste&query=&referentiel=<?= $ref['nom']?>&status=">
              <img class="img-card" src="<?= htmlspecialchars($ref['photo']) ?>" alt="photo referentiel">
              <h3><?= htmlspecialchars($ref['nom']) ?></h3>
              <h4>1 module</h4>
              <p><?= htmlspecialchars($ref['description']) ?></p>
              <br>
              <div class="card-footer">
                 <div class="icon-card">
                         
                 </div>
                 <p><?= htmlspecialchars($ref['capacite']) ?>apprenants </p>
              </div>
              </a>
            </div>
            
            <?php endforeach ?>
            </div>
        
    </div>
    
  </main>
  </div>
  </div>