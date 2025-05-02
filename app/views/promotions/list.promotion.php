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
         <h1> Promotion</h1>
         <p><?= $stats["nombre_apprenants"] ?> apprenants</p>
       </div>
       </div>
       <div class="filtre-liste">
        <div class="inputs-filtre">
        

        <form class="form-recherche-filtre" method="GET" action="index.php" style="display: flex; gap: 10px;">
    <input type="hidden" name="menu" value="promotion">
    <input type="hidden" name="action" value="lister">

    
    <input type="text" class="input-recherche" name="query" value="<?= isset($_GET['query']) ? htmlspecialchars($_GET['query']) : '' ?>" placeholder="Rechercher par nom...">

   
    <select name="referentiel" id="referentiel">
        <option value="">Filtrer classe </option>
        <?php foreach ($referentiels as $ref): ?>
            <option value="<?= htmlspecialchars($ref) ?>" <?= ($ref == $referentiel_selectionne) ? 'selected' : '' ?>>
                <?= htmlspecialchars($ref) ?>
            </option>
        <?php endforeach; ?>
    </select>

   
    <select name="status" id="status">
        <option value="">Filtrer statuts </option>
        <option value="active" <?= ($status_selectionne == 'active') ? 'selected' : '' ?>>Active</option>
        <option value="inactive" <?= ($status_selectionne == 'inactive') ? 'selected' : '' ?>>Inactive</option>
    </select>


    <button type="submit" class="btn-filtrer">Rechercher</button>
</form>


       </div>
       <div class="ajout-liste">
       <img class="icons-topbar" src="/ges-apprenant/public/assets/icons/person.png"  alt="">
       <a href="index.php?menu=promotion&action=creation_page" class="ajout-link">ajouter promotions</a>

       <img src="" alt="">
       </div>
       </div>
      
       <br><br>
       <div class="second">
       <div class="gril">
       <div class="icon-content">
                <img class="gril-icon" src="/ges-apprenant/public/assets/icons/appr.png"   alt="">
               </div>
               <div class="info-gril">
               <h1><?= $stats["nombre_apprenants"] ?></h1>
                   <h4>apprenants</h4>
               </div>
              
           </div>
           <div class="gril">
           <div class="icon-content">
                <img class="gril-icon" src="/ges-apprenant/public/assets/icons/referent.png"   alt="">
               </div>
               <div class="info-gril">
                   <h1><?= $stats["nombre_referentiels"] ?></h1>
                   <h4>Referentiels</h4>
               </div>
              
           </div>
           <div class="gril">
           <div class="icon-content">
                <img class="gril-icon" src="/ges-apprenant/public/assets/icons/reglage.png"   alt="">
               </div>
               <div class="info-gril">
                   <h1>5</h1>
                   <h4>Stagiaires</h4>
               </div>
               
           </div>
           <div class="gril">
           <div class="icon-content">
                <img class="gril-icon" src="/ges-apprenant/public/assets/icons/appr.png"   alt="">
               </div>
               <div class="info-gril">
                   <h1>13</h1>
                   <h4>Permanents</h4>
               </div>
              
           </div>
       </div>
       <br>
      
       
       <table>
        <thead>
        <tr>
            <td>Photos</td>
                <td>Promotion</td>
                <td>Date de debut</td>
                <td>Date de fin</td>
                <td>Référentiel</td>
                <td>Status</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>

        <?php if(!empty($promotions)):  ?>
        <?php foreach($promotions as $prom): ?>
            <tr>
            
             <td> <img class="photo-list" src="<?= htmlspecialchars($prom["photo"]) ?>" alt=""> </td>

                <td><?= htmlspecialchars($prom["nom"]) ?></td>
                <td><?= htmlspecialchars($prom["date-debut"]) ?></td>
                <td><?= htmlspecialchars($prom["date-fin"]) ?></td>

                <?php
                    $couleurs = ['#e7f7ef', ' #e6f0ff', '#f0e6ff', '#fff2e0', ' #ffe6f0'];
                    $textcolor = ['#34b47b', '#4d8dff', '#9c6ade','#f5a623', '#e83e8c'];
                ?>

                <td> 
                    <div class="ref-td" style="display: flex; flex-wrap: wrap; gap: 6px;">
                        <?php foreach ($prom["referentiels"] as $index => $ref): ?>
                            <?php 
                                $bgColor = $couleurs[$index % count($couleurs)];
                                $colorText = $textcolor[$index % count($textcolor)];
                            ?>
                            <span style="background-color: <?= $bgColor ?>; color: <?= $colorText ?>; padding: 4px 8px; border-radius: 12px; font-size: 17px;">
                                <?= htmlspecialchars($ref) ?>
                            </span>
                        <?php endforeach; ?>
                    </div>
                </td>

                </div>
                <td>
                    <div <?php if($prom["status"] == "active"): ?>   class="status-table-actif"   <?php else: ?>  class="status-table-inactif" <?php endif ?>>
                    <h1 class="point" style=" <?php if($prom["status"] == "active"): ?> color: var(--vert;  <?php else: ?> color: red; <?php endif ?>">•</h1> 
                        <h3  style=" <?php if($prom["status"] == "active"): ?> color: var(--vert;  <?php else: ?> color: red; <?php endif ?>"  ><?= htmlspecialchars($prom["status"]) ?> </h3>
                    </div>
                    
                </td>
                <td >
                    <div class="action-table">
                    <h1>•••</h1>
                    </div>
                    
                
                </td>
             </tr>

            <?php endforeach ?>
            
        </tbody>
       </table>
      
       <br>
      <div class="pagination-container">
      <form method="get" class="page-selector" style="display: flex; align-items: center;">
        <input type="hidden" name="menu" value="promotion">
        <input type="hidden" name="action" value="lister">
        
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
            <a href="index.php?menu=promotion&action=lister&page=<?= $pagination['precedente'] . $pagination['url_params'] ?>" class="nav-button" title="Page précédente">
            <div class="nav-arrow">
                 <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                 </svg>
            </div>
            </a>
                <?php endif; ?>

                <?php foreach ($pagination['pages'] as $page): ?>
                    <a href="index.php?menu=promotion&action=lister&page=<?= $page . $pagination['url_params'] ?>" class="nav-button <?= $page == $pagination['page_actuelle'] ? 'active' : '' ?>">
                        <?= $page ?>
                    </a>
                <?php endforeach; ?>

                <?php if ($pagination['suivante']): ?>
                    <a href="index.php?menu=promotion&action=lister&page=<?= $pagination['suivante'] . $pagination['url_params'] ?>" class="nav-button" title="Page suivante">
                    <div class="nav-arrow">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    </a>
                <?php endif; ?>
    </div>

          <!-- <div class="navigation">
              <?php if ($pagination['precedente']): ?>
                  <a href="index.php?menu=promotion&action=lister&page=<?= $pagination['precedente'] ?>" class="nav-button" title="Page précédente">
                      <div class="nav-arrow">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                          </svg>
                      </div>
                  </a>
              <?php endif; ?>

              <?php foreach ($pagination['pages'] as $page): ?>
                  <a href="index.php?menu=promotion&action=lister&page=<?= $page ?>" class="nav-button <?= $page == $pagination['page_actuelle'] ? 'active' : '' ?>">
                      <?= $page ?>
                  </a>
              <?php endforeach; ?>

              <?php if ($pagination['suivante']): ?>
                  <a href="index.php?menu=promotion&action=lister&page=<?= $pagination['suivante'] ?>" class="nav-button" title="Page suivante">
                      <div class="nav-arrow">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                          </svg>
                      </div>
                  </a>
              <?php endif; ?>
          </div> -->
      </div>
      <?php endif ?>
      <?php if(empty($promotions)): ?>
        <p>Aucun Promotion disponimble </p>
      <?php endif ?>
    </div>
    
  </main>
  </div>
  </div>


  