<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>404 - Page non trouvée</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      height: 100vh;
      background: linear-gradient(to top right, #1e3c72, #2a5298);
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Segoe UI', sans-serif;
      overflow: hidden;
    }

    .container {
      text-align: center;
      color: white;
      z-index: 1;
    }

    h1 {
      font-size: 8rem;
      position: relative;
      animation: float 3s ease-in-out infinite;
    }

    h2 {
      font-size: 2rem;
      margin-top: -20px;
      animation: fadeIn 2s ease-in forwards;
    }

    p {
      font-size: 1.2rem;
      margin-top: 10px;
      animation: fadeIn 3s ease-in forwards;
    }

    a {
      display: inline-block;
      margin-top: 25px;
      padding: 10px 20px;
      background-color: white;
      color: #2a5298;
      text-decoration: none;
      font-weight: bold;
      border-radius: 30px;
      transition: background 0.3s ease;
    }

    a:hover {
      background-color: #f0f0f0;
    }

    @keyframes float {
      0%, 100% {
        transform: translateY(-20px);
      }
      50% {
        transform: translateY(20px);
      }
    }

    @keyframes fadeIn {
      0% {
        opacity: 0;
        transform: translateY(20px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Bulles animées */
    .bubbles {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: 0;
    }

    .bubble {
      position: absolute;
      bottom: -100px;
      width: 40px;
      height: 40px;
      background-color: rgba(255, 255, 255, 0.2);
      border-radius: 50%;
      animation: rise 10s infinite ease-in;
    }

    @keyframes rise {
      0% {
        transform: translateY(0) scale(1);
        opacity: 1;
      }
      100% {
        transform: translateY(-110vh) scale(0.5);
        opacity: 0;
      }
    }
  </style>
</head>
<body>

<div class="bubbles">
  <div class="bubble" style="left: 10%; animation-delay: 0s;"></div>
  <div class="bubble" style="left: 
  <div class="bubble" style="left: 10%; animation-delay: 0s;"></div>
  <div class="bubble" style="left: 20%; animation-delay: 2s;"></div>
  <div class="bubble" style="left: 30%; animation-delay: 4s;"></div>
  <div class="bubble" style="left: 50%; animation-delay: 1s;"></div>
  <div class="bubble" style="left: 70%; animation-delay: 3s;"></div>
  <div class="bubble" style="left: 85%; animation-delay: 5s;"></div>
</div>

<div class="container">
  <h1>404</h1>
  <h2>Oops ! Page introuvable</h2>
  <p>La page que vous recherchez n'existe pas ou a été déplacée.</p>
  <a href="http://www.gueye.mohamed.sa.edu.sn:67/ges-apprenant/public/index.php">Retour à l'accueil</a>
</div>

</body>
</html>
