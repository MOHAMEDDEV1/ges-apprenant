<?php
$importResults = $_SESSION['import_results'];
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
      
  <div class="report-container">
        <h2>Rapport d'importation des apprenants</h2>
        
        <div class="summary">
            <h3>Résumé</h3>
            <p>Total de lignes traitées: <strong><?php echo $importResults['total']; ?></strong></p>
            <p>Importations réussies: <span class="success"><?php echo $importResults['success']; ?></span></p>
            <p>Importations échouées: <span class="failure"><?php echo $importResults['failures']; ?></span></p>
        </div>
        
        <?php if (!empty($importResults['errors'])): ?>
        <div class="error-list">
            <h3>Détails des erreurs</h3>
            
            <?php foreach ($importResults['errors'] as $error): ?>
            <div class="error-item">
                <p><strong>Ligne <?php echo $error['line']; ?></strong> - <?php echo $error['nom']; ?> (<?php echo $error['email']; ?>)</p>
                
                <?php foreach ($error['errors'] as $field => $message): ?>
                <div class="error-detail">
                    <strong><?php echo ucfirst($field); ?>:</strong> <?php echo $message; ?>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        
        <div class="actions">
            <a href="index.php?menu=apprenant" class="btn">Retour à la liste des apprenants</a>
        </div>
    </div>
    </div>
    
  </main>
  </div>
  </div>