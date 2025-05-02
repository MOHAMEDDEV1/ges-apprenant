<?php 
use function App\Controllers\errors\get_error;
?>
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
       <div class="ajout-app-title">
         <h1>Ajout Apprenant </h1>
       </div>
       </div>
       
    <div class="container-ajout-apprenant">
        <div class="section-ajout-apprenant">
            <div class="section-header">
                <h2 class="section-title">Informations de l'apprenant</h2>
                <span class="edit-icon">✏️</span>
            </div>
            <form action="index.php?menu=apprenant&action=ajout_apprenant" method="POST" enctype="multipart/form-data" >
            <div class="form-grid">
                <div class="form-group-appr">
                    <label>Nom Complet</label>
                    <input name="nom-complet" type="text" class="form-control" value="<?= htmlspecialchars($apprenant['nom-complet']) ?>" placeholder="Seydina Mouhammad">
                    <p class="error"><?= get_error('nom-complet') ?></p>
                </div>
                
                
                <div class="form-group-appr">
                <label>Telephone</label>
                    <input type="tel" name="telephone" class="form-control" value="<?= htmlspecialchars($apprenant['telephone'])  ?>" placeholder="EX:780118223">
                    <p class="error"><?= get_error('telephone') ?></p>
                </div>
               
                <div class="form-group-appr">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" value="<?= htmlspecialchars($apprenant['email'])  ?>" placeholder="mouhaleecr7@gmail.com">
                    <p class="error"><?= get_error('email') ?></p>
                </div>
                
                <div class="form-group-appr">
                    <label>Adresse</label>
                    <input type="text" name="adresse" class="form-control"  value="<?= htmlspecialchars($apprenant['adresse']) ?>" placeholder="EX : Sicap Liberté 6 Villa 6059 Dakar, Sénégal.">
                    <p class="error"><?= get_error('adresse') ?></p>
                </div>

                <div class="form-group-appr">
                    <div class="doc-upload">
                        <div class="doc-upload-icon">📂</div>
                        <div class="doc-upload-text">Ajouter une photo</div>
                        <input class="file" name="photo" value="<?= htmlspecialchars($apprenant['photo']) ?>" type="file" multiple>
                    </div>
                    <!-- <p class="error"><?= get_error('photo') ?></p> -->

                </div>
              
                <div class="form-group">
                                    <label class="form-label">Référentiels de promotion en cours</label>
                                    <div class="tags-container-ajout">
                                        <?php foreach ($referentiels as $ref): ?>
                                            <input type="radio" name="referentiel" value="<?= htmlspecialchars($ref) ?>" >
                                            <?= htmlspecialchars($ref) ?>
                                    </label>
                                        <?php endforeach; ?>
                                        <p class="error"><?= get_error('referentiel') ?></p>
                                    </div>
                                </div>  
                                <div class="form-group">
                            <button class="btn-ajout" type="submit">Enregistrer </button>
                            </div>  
                                
                                             
                        </div>
                        
                        </form>
                    </div>

    </div>
      
    </div>
    
  </main>
  </div>
  </div>
