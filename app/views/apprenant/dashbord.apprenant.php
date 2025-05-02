<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Dashboard Étudiant - Sonatel</title>
    <link rel="stylesheet" href="/ges-apprenant/public/assets/css/style.mobile.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="app-container-mob">
        <div class="header">
            <img src="assets/images/logo.jpg" alt="Sonatel Logo" class="logo">
            <div class="menu-icon">
                <i class="fas fa-bars"></i>
            </div>
        </div>

        <div class="main-content-mob">
            <div class="dashboard-header">
                Tableau de Bord
            </div>
            
            
            <div class="scanner-card">
                <div class="scanner-icon">
                    <i class="fas fa-qrcode"></i>
                </div>
                <div class="scanner-title">Scanner pour la présence</div>
                <div class="qr-code">
                <img class="qr-code" src="<?= htmlspecialchars($qrCodeFile) ?>" alt="QR Code" style="width:100%">
                </div>
            </div>
            
            <div class="section-divider"></div>
            
            
            <div class="profile-card">
                <div class="profile-picture">
                    <img src="<?= htmlspecialchars($apprenant['photo']) ?>" alt="Mohamed GUEYE">
                    <div class="profile-badge">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                </div>
                <div class="profile-name"><?= htmlspecialchars($apprenant['nom-complet']) ?></div>
                <div class="profile-role"><?= htmlspecialchars($apprenant['referentiel']) ?></div>
                <div class="profile-info">
                    <i class="fas fa-envelope"></i>
                    <?= htmlspecialchars($apprenant['email']) ?>
                </div>
                <div class="profile-info">
                    <i class="fas fa-id-card"></i>
                    <?= htmlspecialchars($apprenant['matricule']) ?>
                </div>
            </div>
            
            
            <div class="stats-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="card-title">Présences</div>
                </div>
                
                <div class="attendance-stats">
                    <div class="stat-item stat-present">
                        <div class="stat-value">38</div>
                        <div class="stat-label">Présent</div>
                    </div>
                    <div class="stat-item stat-late">
                        <div class="stat-value">0</div>
                        <div class="stat-label">Retard</div>
                    </div>
                    <div class="stat-item stat-absent">
                        <div class="stat-value">1</div>
                        <div class="stat-label">Absent</div>
                    </div>
                </div>
            </div>
            
            <div class="section-divider"></div>
            
            <div class="stats-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <div class="card-title">Répartition</div>
                </div>
                
                <div class="chart-container">
                    <div class="pie-chart"></div>
                    <div class="chart-legend">
                        <div class="legend-item">
                            <div class="legend-color legend-present"></div>
                            <div>Présents</div>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color legend-late"></div>
                            <div>Retards</div>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color legend-absent"></div>
                            <div>Absents</div>
                        </div>
                    </div>
                </div>
            </div>
            
        
            <div class="stats-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-history"></i>
                    </div>
                    <div class="card-title">Historique de présence</div>
                </div>
                
                <div class="search-bar">
                    <div class="search-input">
                        <i class="fas fa-search"></i>
                        Rechercher...
                    </div>
                    <div class="filter-button">
                        <i class="fas fa-filter"></i>
                        Tous les statuts
                    </div>
                </div>
                
                <div class="history-list">
                    <div class="list-header">
                        <div class="date-column">Date</div>
                        <div class="status-column">Statut</div>
                    </div>
                    
                    <div class="list-item">
                        <div class="list-date">24/02/2025<br>07:21:35</div>
                        <div class="list-status">
                            <span class="status-pill status-present-pill">Present</span>
                        </div>
                    </div>
                    
                    <div class="list-item">
                        <div class="list-date">25/02/2025<br>07:24:57</div>
                        <div class="list-status">
                            <span class="status-pill status-present-pill">Present</span>
                        </div>
                    </div>
                    
                    <div class="list-item">
                        <div class="list-date">26/02/2025<br>07:17:16</div>
                        <div class="list-status">
                            <span class="status-pill status-present-pill">Present</span>
                        </div>
                    </div>
                    
                    <div class="list-item">
                        <div class="list-date">27/02/2025<br>07:33:06</div>
                        <div class="list-status">
                            <span class="status-pill status-present-pill">Present</span>
                        </div>
                    </div>
                    
                    <div class="list-item">
                        <div class="list-date">28/02/2025<br>07:28:08</div>
                        <div class="list-status">
                            <span class="status-pill status-present-pill">Present</span>
                        </div>
                    </div>
                </div>
                
                <div class="pagination-controls">
                    <div class="page-arrow">
                        <i class="fas fa-chevron-left"></i>
                    </div>
                    <div class="page-number active">1</div>
                    <div class="page-number">2</div>
                    <div class="page-number">3</div>
                    <div class="page-number">4</div>
                    <div class="page-number">5</div>
                    <div class="page-arrow">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
                
                <div class="pagination-info">
                    Affichage de 1 à 5 sur 39 entrées
                </div>
                
                <div class="items-per-page">
                    Afficher
                    <select class="items-select">
                        <option>5</option>
                        <option>10</option>
                        <option>20</option>
                    </select>
                    par page
                </div>
            </div>
        </div>
    </div>
</body>
</html>