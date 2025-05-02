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
        <!-- Sidebar -->
        <div class="sidebar">
            <a href="index.php?menu=apprenant" class="back-button">Retour sur la liste</a>
            
            <div class="profile">
                <div class="profile-pic">
                    <img src="https://via.placeholder.com/100" alt="Seydina Mouhammad Diop">
                </div>
                <h3 class="profile-name">Seydina Mouhammad Diop</h3>
                <div class="status-badge">DEV WEB/MOBILE</div>
                <button class="action-button">+</button>
                
                <div class="contact-info">
                    <div class="info-item">
                        <span class="info-icon">📱</span>
                        <span>+221 78 599 35 46</span>
                    </div>
                    <div class="info-item">
                        <span class="info-icon">✉️</span>
                        <span>mouhaleecr7@gmail.com</span>
                    </div>
                    <div class="info-item">
                        <span class="info-icon">🏠</span>
                        <span>Sicap Liberté 6 Villa 6059 Dakar</span>
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
            
            <!-- Tabs -->
            <div class="tabs">
                <div class="tab active">Programme & Modules</div>
                <div class="tab ">Liste de présences de l'apprenant</div>
            </div>

             <!-- Brand Indicator -->
             <div class="brand-indicator"></div>
            
            <!-- Course Grid -->
            <div class="course-grid">
                <!-- Course 1 -->
                <div class="course-card">
                    <div class="course-header">
                        <div class="course-duration"><i>⏱</i> 30 jours</div>
                        <div class="menu-dots">...</div>
                        <h3 class="course-title">Algorithme & Langage C</h3>
                        <p class="course-subtitle">Complexité algorithmique & pratique codage en langage C</p>
                        <span class="course-label">Démarré</span>
                    </div>
                    <div class="course-footer">
                        <div class="course-date"><i>📅</i> 15 Février 2025</div>
                        <div class="course-time"><i>⏰</i> 12:45 pm</div>
                    </div>
                </div>
                
                <!-- Course 2 -->
                <div class="course-card">
                    <div class="course-header">
                        <div class="course-duration"><i>⏱</i> 15 jours</div>
                        <div class="menu-dots">...</div>
                        <h3 class="course-title">Frontend 1: Html, Css & JS</h3>
                        <p class="course-subtitle">Création d'interfaces de design avec animations avancées !</p>
                        <span class="course-label">Démarré</span>
                    </div>
                    <div class="course-footer">
                        <div class="course-date"><i>📅</i> 24 Mars 2025</div>
                        <div class="course-time"><i>⏰</i> 12:45 pm</div>
                    </div>
                </div>
                
                <!-- Course 3 -->
                <div class="course-card">
                    <div class="course-header">
                        <div class="course-duration"><i>⏱</i> 20 jours</div>
                        <div class="menu-dots">...</div>
                        <h3 class="course-title">Backend 1: PhpPhp avancées & POO</h3>
                        <p class="course-subtitle">Complexité algorithmique & pratique codage en langage C</p>
                        <span class="course-label in-progress-badge">En cours</span>
                    </div>
                    <div class="course-footer">
                        <div class="course-date"><i>📅</i> 23 Mar 2024</div>
                        <div class="course-time"><i>⏰</i> 12:45 pm</div>
                    </div>
                </div>
                
                <!-- Course 4 -->
                <div class="course-card">
                    <div class="course-header">
                        <div class="course-duration"><i>⏱</i> 15 jours</div>
                        <div class="menu-dots">...</div>
                        <h3 class="course-title">Frontend 2: JS & TS + Tailwind</h3>
                        <p class="course-subtitle">Complexité algorithmique & pratique codage en langage C</p>
                        <span class="course-label">Démarré</span>
                    </div>
                    <div class="course-footer">
                        <div class="course-date"><i>📅</i> 23 Mar 2024</div>
                        <div class="course-time"><i>⏰</i> 12:45 pm</div>
                    </div>
                </div>
                
                <!-- Course 5 -->
                <div class="course-card">
                    <div class="course-header">
                        <div class="course-duration"><i>⏱</i> 30 jours</div>
                        <div class="menu-dots">...</div>
                        <h3 class="course-title">Backend 2: Laravel & SOLID</h3>
                        <p class="course-subtitle">Complexité algorithmique & pratique codage en langage C</p>
                        <span class="course-label">Démarré</span>
                    </div>
                    <div class="course-footer">
                        <div class="course-date"><i>📅</i> 23 Mar 2024</div>
                        <div class="course-time"><i>⏰</i> 12:45 pm</div>
                    </div>
                </div>
                
                <!-- Course 6 -->
                <div class="course-card">
                    <div class="course-header">
                        <div class="course-duration"><i>⏱</i> 15 jours</div>
                        <div class="menu-dots">...</div>
                        <h3 class="course-title">Frontend 3: ReactJs</h3>
                        <p class="course-subtitle">Complexité algorithmique & pratique codage en langage C</p>
                        <span class="course-label in-progress-badge">En cours</span>
                    </div>
                    <div class="course-footer">
                        <div class="course-date"><i>📅</i> 23 Mar 2024</div>
                        <div class="course-time"><i>⏰</i> 12:45 pm</div>
                    </div>
                </div>
            </div>
            
            
        </div>
    </div>
