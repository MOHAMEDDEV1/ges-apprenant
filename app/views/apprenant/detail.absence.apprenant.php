<?php 
echo "Nombre d'absences : " . count($absences ?? []);
var_dump($absences);  // Pour voir les données complètes
?>
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
    <div class="container">
    
       <div class="sidebar">
            <a href="index.php?menu=apprenant" class="back-button">Retour sur la liste</a>
            
            <div class="profile">
                <div class="profile-pic">
                    <img src="<?= htmlspecialchars($apprenant['photo']) ?>" alt="Seydina Mouhammad Diop">
                </div>
                <img class="qr-code" src="<?= htmlspecialchars($qrCodeFile) ?>" alt="QR Code" style="width:100%">

                <h3 class="profile-name"><?= htmlspecialchars($apprenant['nom-complet']) ?></h3>
                <div class="status-badge"><?= htmlspecialchars($apprenant['referentiel']) ?></div>
                <button class="action-button">+</button>
                
                <div class="contact-info">
               
                    <div class="info-item">
                        <span class="info-icon">✉️</span>
                        <span><?= htmlspecialchars($apprenant['email']) ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-icon">🏠</span>
                        <span><?= htmlspecialchars($apprenant['adresse']) ?></span>
                    </div>
                    <div class="info-item">
                    </div>
                    
                </div>
                
            </div>
        </div>
        <!-- Main Content -->
        <div class="main-content">
            <!-- Stats Row -->
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-icon green-icon">✓</div>
                    <div>
                        <div class="stat-number">20</div>
                        <div class="stat-label">Présence(s)</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon orange-icon">⏰</div>
                    <div>
                        <div class="stat-number">5</div>
                        <div class="stat-label">Retard(s)</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon red-icon">⚠️</div>
                    <div>
                        <div class="stat-number">1</div>
                        <div class="stat-label">Absence(s)</div>
                    </div>
                </div>
            </div>
            
        
            <div class="tabs">
                <div class="tab">Programme & Modules</div>
                <div class="tab active">Liste de présences de l'apprenant</div>
            </div>
            
        
            <table class="attendance-table">
                <thead class="table-header">
                    <tr>
                        <th>Photo</th>
                        <th>Matricule</th>
                        <th>Nom Complet</th>
                        <th>Date & Heure</th>
                        <th>Statut</th>
                        <th>Justification</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
    <?php if(!empty($absences)): ?>
        <?php foreach($absences as $absence): ?>
        <tr>
            <td>
                <div class="student-photo">
                    <img src="<?= htmlspecialchars($absence['photo']) ?>" alt="Student">
                </div>
            </td>
            <td><?= htmlspecialchars($absence['mat-apprenant']) ?></td>
            <td><?= htmlspecialchars($absence['nom-complet']) ?></td>
            <td><?= htmlspecialchars($absence['date']) ?> <?= htmlspecialchars($absence['heure']) ?></td>
            <td><span class="status-badge-table status-absent">Absent</span></td>
            <td><span class="justified"><?= htmlspecialchars($absence['motif']) ?></span></td>
            <td class="action-dots">...</td>
        </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</tbody>
            </table>
        </div>
    </div>
