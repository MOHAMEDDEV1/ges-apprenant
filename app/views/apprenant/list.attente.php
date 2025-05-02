
<div class="right-content">
  <section class="top-sidebar">
    <div class="input-container">
    <input type="text" class="icon-input" placeholder="Rechercher...">
    </div>
    <div class="top-right">
      <img class="icons-topbar" src="/ges-apprenant/public/assets/icons/notification.png"  alt="">
      <?php if (!empty($user)): ?>
    <div class="info">
        <p><?= htmlspecialchars($user['login']) ?></p>
        <p><?= htmlspecialchars($user['profil']) ?></p>
    </div>


      
      <div class="profil-liste">
        <img src="<?= htmlspecialchars($user['photo']) ?>" alt="">
      </div>
      <?php endif; ?>
    </div>
     
  </section>
  <main class="content-variable">
  <div class="main-container">
       <div class="first">
       <div class="title-liste">
         <h1> Apprenant </h1>
         <p>180 apprenants</p>
       </div>
       </div>
       <div class="filtre-liste">

       <div class="inputs-filtre">
    <form class="input-third" method="GET" action="index.php" style="display: flex; gap: 10px;">
        <input type="hidden" name="menu" value="apprenant">
        <input type="hidden" name="action" value="rechercher_liste">

      
        <input type="text" class="input-recherche" name="query" value="<?= htmlspecialchars($_SESSION['query'] ?? '') ?>" placeholder="Rechercher..." style="width: 100%;border:none">

       
        <select name="referentiel" id="referentiel" class="input-filtre">
            <option value="">Filtrer par référentiel</option>
            <?php foreach ($referentiels as $referentiel) : ?>
                <option value="<?= htmlspecialchars($referentiel) ?>" <?= ($referentiel === $referentiel ? 'selected' : '') ?>>
                    <?= htmlspecialchars($referentiel) ?>
                </option>
            <?php endforeach; ?>
        </select>


     
        <select name="status" id="status">
            <option value="">Filtrer par statut</option>
            <option value="actif" <?= ($_SESSION['status'] ?? '') === 'actif' ? 'selected' : '' ?>>Actif</option>
            <option value="remplacé" <?= ($_SESSION['status'] ?? '') === 'remplacé' ? 'selected' : '' ?>>Remplacé</option>
        </select>

        <button type="submit">Filtrer</button>
    </form>
</div>


       <div class="gauche-appr">
        
            <div class="telecharge-liste-apprenant">
           
            <form class="import-form" action="index.php?menu=apprenant&action=ajout_excel" method="POST" enctype="multipart/form-data">
            <div class="file-input-wrapper">
            <label class="file-label">Choisir un fichier</label>
            <input  class="file-input" type="file" name="fichier_excel" required>
          
            </div>
            <button class="import-button" type="submit">Importer</button>
        </form>
            
            </div>

            <div class="ajout-liste-apprenant">
            <img class="icons-topbar" src="/ges-apprenant/public/assets/icons/person.png"  alt="">
            <a href="index.php?menu=apprenant&action=page_ajout" class="ajout-link">ajouter apprenant</a>
            <img src="" alt="">
            </div>
       </div>
       

       </div>
      
       <br><br>
       <div class="second-apprenant">
            <div class="retenu">
                <a href="http://www.gueye.mohamed.sa.edu.sn:67/ges-apprenant/public/index.php?menu=apprenant">
                 Liste des retenus 
                 </a>
                </div>
            <div class="attente">
              <a href="#">   
               Liste d'attente
               </a>
            </div>
       </div>
       <br>
      
       
       <table>
        <thead>
        <tr>
            <th>Photo</th>
                <th>Matricule</th>
                <th>Nom Complet</th>
                <th>Adresse</th>
                <th>Email</th>
                <th>Référentiel</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
       

            <?php if(!empty($apprenants)):  ?>
            <?php foreach($apprenants as $key => $apprenant): ?>
                <tr>
                
                <td> <img class="photo-list" src="<?= htmlspecialchars($apprenant["photo"]) ?>" alt=""> </td>
                <td><?= htmlspecialchars($apprenant["matricule"]) ?></td>
                    <td><?= htmlspecialchars($apprenant["nom-complet"]) ?></td>
                    <td><?= htmlspecialchars($apprenant["adresse"]) ?></td>
                    <td><?= htmlspecialchars($apprenant["email"]) ?></td>
                    <td class="ref-table"><span class="dev-web"> <?= htmlspecialchars($apprenant["referentiel"]) ?></span>  </td>
                    <td>
                        <div <?php if($apprenant["status"] == "actif"): ?>   class="status-table-actif-apprenant"   <?php else: ?>  class="status-table-inactif-apprenant" <?php endif ?>>
                        <h1 class="point" style=" <?php if($apprenant["status"] == "actif"): ?> color: var(--vert;  <?php else: ?> color: red; <?php endif ?>"></h1> 
                            <h3  style=" <?php if($apprenant["status"] == "actif"): ?> color: var(--vert;  <?php else: ?> color: white; <?php endif ?>"  ><?= htmlspecialchars($apprenant["status"]) ?> </h3>
                        </div>
                        
                    </td>
                    <td>
                    <div class="action-table">
                        <label for="menu-toggle-<?= $key ?>">
                            <h1>•••</h1>
                        </label>
                        <input type="checkbox" id="menu-toggle-<?= $key ?>" class="menu-toggle">
                        <div class="dropdown-menu">
                            <ul>
                            <li><a href="index.php?menu=apprenant&action=valider_apprenant&matricule=<?= htmlspecialchars($apprenant['matricule']) ?>">Valider apprenant</a></li>
                            </ul>
                        </div>
                    </div>
                    </td>
                </tr>
            <?php endforeach ?>
            <?php else: ?>
              <p>Pas d'apprenant !</p>
            <?php endif ?>
            
          
        </tbody>
       </table>
      
       <div class="pagination-container">
      <form method="get" class="page-selector" style="display: flex; align-items: center;">
        <input type="hidden" name="menu" value="apprenant">
       
        
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
            <a href="index.php?menu=apprenant&action=attente_apprenants&page=<?= $pagination['precedente'] . $pagination['url_params'] ?>" class="nav-button" title="Page précédente">
            <div class="nav-arrow">
                 <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                 </svg>
            </div>
            </a>
                <?php endif; ?>

                <?php foreach ($pagination['pages'] as $page): ?>
                    <a href="index.php?menu=apprenant&action=attente_apprenants&page=<?= $page . $pagination['url_params'] ?>" class="nav-button <?= $page == $pagination['page_actuelle'] ? 'active' : '' ?>">
                        <?= $page ?>
                    </a>
                <?php endforeach; ?>

                <?php if ($pagination['suivante']): ?>
                    <a href="index.php?menu=apprenant&action=attente_apprenants&page=<?= $pagination['suivante'] . $pagination['url_params'] ?>" class="nav-button" title="Page suivante">
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
    
  </main>
  </div>
  </div>