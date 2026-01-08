<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion / Inscription</title>
  <link rel="stylesheet" href="styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Stick&display=swap" rel="stylesheet">
</head>
<body>

  <!-- HEADER -->
  <header class="header">
    <div class="header-logo">
      <img src="logo.png" alt="Logo">
      <span>Recettes romaines</span>
    </div>

    <div class="header-timer">16:10:53 s</div>

    <div class="header-center">
      <img src="plat-pates.jpg" alt="Plat du jour">
    </div>

    <div class="header-actions">
      <button class="btn">poster une recette</button>
      <button class="btn btn-icon btn-outline">
        <span>👤</span> Profil
      </button>
      <button class="btn btn-outline">Se connecter</button>
    </div>
  </header>

  <!-- frise grecque -->
  <div class="greek-border"></div>

  <main class="page-content">

    <!-- PARCHEMIN + SWITCH -->
    <section class="signup-section">
      <div class="scroll-wrapper">
        <div class="scroll-bar top"></div>

        <div class="scroll-body">

          <!-- boutons de switch -->
          <div class="toggle-buttons">
            <button id="btn-login" class="toggle-btn active">Se connecter</button>
            <button id="btn-register" class="toggle-btn">S'inscrire</button>
          </div>

          <!-- titre -->
          <h1 id="form-title" class="signup-title">Se connecter</h1>
          <div class="signup-separator"></div>

          <!-- messages -->
          <?php if (isset($_GET['err'])): ?>
            <p class="msg error">
              <?php
              if ($_GET['err'] === 'login')     echo 'Mail ou mot de passe incorrect.';
              if ($_GET['err'] === 'inscription') echo 'Tous les champs sont obligatoires et les mots de passe doivent correspondre.';
              if ($_GET['err'] === 'mail')      echo 'Un compte existe déjà avec ce mail.';
              ?>
            </p>
          <?php elseif (isset($_GET['ok']) && $_GET['ok'] === 'inscription'): ?>
            <p class="msg success">Inscription réussie, vous pouvez vous connecter.</p>
          <?php endif; ?>

          <!-- FORM CONNEXION -->
          <form id="form-login" class="form-block" action="auth.php" method="post">
            <input type="hidden" name="action" value="login">
            <label>adresse mail</label>
            <input type="email" name="mail" required>
            <label>mot de passe</label>
            <input type="password" name="mdp" required>
            <button class="signup-submit" type="submit">Se connecter</button>
          </form>

          <!-- FORM INSCRIPTION -->
          <form id="form-register" class="form-block hidden" action="auth.php" method="post">
            <input type="hidden" name="action" value="register">
            <label>adresse mail</label>
            <input type="email" name="mail" required>
            <label>mot de passe</label>
            <input type="password" name="mdp" required>
            <label>confirmer le mot de passe</label>
            <input type="password" name="mdp2" required>
            <button class="signup-submit" type="submit">S'inscrire</button>
          </form>

        </div>

        <div class="scroll-bar bottom"></div>
      </div>
    </section>

    <!-- COLISÉE + FOOTER -->
    <section class="colosseum">
      <div class="arches-row">
        <div class="arch"></div><div class="arch"></div><div class="arch"></div>
        <div class="arch"></div><div class="arch"></div><div class="arch"></div>
      </div>
      <div class="arches-row">
        <div class="arch"></div><div class="arch"></div><div class="arch"></div>
        <div class="arch"></div><div class="arch"></div><div class="arch"></div>
      </div>

      <div class="footer-links">
        <a href="#">mentions légales</a><br>
        <a href="#">plan du site</a><br>
        <a href="#">A propos de nous</a>
      </div>
    </section>

  </main>

  <script src="script.js"></script>
</body>
</html>
