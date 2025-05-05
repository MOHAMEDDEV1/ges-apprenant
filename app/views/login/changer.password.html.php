<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="/ges-apprenant/public/assets/css/style.css">
    <title>Orange Digital Center - Mobile</title>
   
</head>
<body>
    <div class="mobile-frame">
        <!-- Status Bar -->
        <div class="status-bar">
            <div class="time">17:57</div>
            <div class="icons">
                <span>5G</span>
                <span>
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.01 21.49L23.64 7C23.8 6.8 23.9 6.6 23.94 6.34C23.98 6.09 23.93 5.84 23.82 5.61C23.6 5.16 23.07 4.92 22.59 5.05L2.44 11.95C1.96 12.08 1.59 12.5 1.58 12.98C1.57 13.46 1.92 13.9 2.39 14.05L8.01 15.9L10.87 21.49C11.02 21.8 11.33 22 11.67 22C12 22 12.33 21.79 12.49 21.47L12.01 21.49Z" fill="white"/>
                    </svg>
                </span>
                <span>
                    <svg width="18" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 5.5v13c0 .8-.7 1.5-1.5 1.5h-7c-.8 0-1.5-.7-1.5-1.5v-13c0-.8.7-1.5 1.5-1.5h7c.8 0 1.5.7 1.5 1.5z" fill="white"/>
                    </svg>
                </span>
            </div>
        </div>

        <!-- Header -->
        <div class="header">
            <h1>Orange Digital Center</h1>
            <p>"Coding For Better Life!"</p>
        </div>
        
        <!-- Logo -->
        <div class="logo-container">
            <img src="/ges-apprenant/public/assets/images/logo.jpg" alt="Orange Digital Center Sonatel" class="logo">
        </div>
        
        <!-- Form -->
        <div class="form-container">
            <p class="form-title">Bienvenue sur l'interface de Changement password !</p>
            
            <form action="index.php?action=changer_password" method="POST">
                <div class="form-group">
                    <label>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 4H4C2.9 4 2 4.9 2 6V18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4Z" stroke="#333" stroke-width="2"/>
                            <path d="M22 6L12 13L2 6" stroke="#333" stroke-width="2"/>
                        </svg>
                        Email
                    </label>
                    <input type="email" name="login" class="form-control" placeholder="entrez votre e-mail de connection">
                </div>
                
                <div class="form-group">
                    <label>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="11" width="18" height="11" rx="2" stroke="#333" stroke-width="2"/>
                            <path d="M7 11V7C7 4.23858 9.23858 2 12 2C14.7614 2 17 4.23858 17 7V11" stroke="#333" stroke-width="2"/>
                        </svg>
                       Nouveau Mot de  passe
                    </label>
                    <div class="password-field">
                        <input type="password" name="new_password" class="form-control" placeholder="••••••••">
                        <button type="button" class="password-toggle">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 5C7 5 2.73 8.11 1 12C2.73 15.89 7 19 12 19C17 19 21.27 15.89 23 12C21.27 8.11 17 5 12 5Z" stroke="#999" stroke-width="2"/>
                                <circle cx="12" cy="12" r="3" stroke="#999" stroke-width="2"/>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <div class="forgot-password">
            
                </div>
                
                <button type="submit"  class="btn-login">Changer password &nbsp;›</button>
                
                <div class="create-account">
                    Pas encore de compte ? <a href="#">Créer un compte</a>
                </div>
            </form>
        </div>

      
        <div class="address-bar">
            <div style="display:flex; align-items:center;">
                <span style="margin-right:8px;">Aa</span>
                <span style="margin-right:8px;">🔒</span>
                <span>scan-front-vf.vercel.app</span>
            </div>
            <div>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.65 6.35C16.2 4.9 14.21 4 12 4C7.58 4 4.01 7.58 4.01 12C4.01 16.42 7.58 20 12 20C15.73 20 18.84 17.45 19.73 14H17.65C16.83 16.33 14.61 18 12 18C8.69 18 6 15.31 6 12C6 8.69 8.69 6 12 6C13.66 6 15.14 6.69 16.22 7.78L13 11H20V4L17.65 6.35Z" fill="#666"/>
                </svg>
            </div>
        </div>

      
        <div class="mobile-nav">
            <div class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" stroke="#666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" stroke="#666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zM23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" stroke="#666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" stroke="#666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M22 6l-10 7L2 6" stroke="#666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>
    </div>
</body>
</html>