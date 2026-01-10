<?php
// connexion PDO à la base clash_of_cooks
$dsn  = "mysql:host=localhost;dbname=clash_of_cooks;charset=utf8mb4";
$user = "root";          // à adapter
$pass = "";              // à adapter

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur connexion : " . $e->getMessage());
}

// récup des recettes du thème omelette (id_theme = 1) + pseudo du profil
$sql = "SELECT r.nom,
               r.description,
               r.img,
               p.pseudo
        FROM recettes AS r
        JOIN profils AS p
          ON r.fk_pseudo = p.id_profil
        WHERE r.fk_theme = 1";
$stmt     = $pdo->query($sql);
$recettes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Clash of Cooks - Omelettes</title>
  <link rel="stylesheet" href="recettes.css">
</head>
<body>
  <header>
    <div class="logo">
      <div class="logo-circle"></div>
      <div class="titre-chewy">Clash of Cooks</div>
    </div>

    <div class="top-right-actions">
      <span class="clock">16:10:53 s</span>
      <button class="btn-rect">poster une recette</button>
      <button class="btn-rect beige">Profil</button>
      <button class="btn-rect beige">Se connecter</button>
    </div>
  </header>

  <div class="greek-border"></div>

  <main>
    <h1 class="page-title">Omelettes</h1>

    <div class="clock-big">16:10:53 s</div>

    <!-- bloc consignes -->
    <section class="bloc-consignes">
      <label for="consignes">Consignes</label>
      <textarea id="consignes" readonly>
Les participants doivent réaliser une omelette dans le temps imparti.
Respecter les ingrédients imposés et présenter le plat avant la fin du chrono.
      </textarea>
    </section>

    <!-- liste des recettes -->
    <h2 class="section-recettes-titre">Recettes publiées pour ce thème</h2>

    <section class="liste-recettes">
      <?php foreach ($recettes as $recette): ?>
        <img src="<?php echo htmlspecialchars($recette['img']); ?>"
             alt="<?php echo htmlspecialchars($recette['nom']); ?>"
             class="miniature">

        <div class="recette-lignes">
          <span class="recette-titre">
            <?php echo htmlspecialchars($recette['nom']); ?>
          </span><br>
          <span class="recette-desc">
            <?php echo htmlspecialchars($recette['description']); ?>
          </span>
        </div>

        <button class="btn-rect btn-voir"
                data-img="<?php echo htmlspecialchars($recette['img']); ?>"
                data-nom="<?php echo htmlspecialchars($recette['nom']); ?>"
                data-pseudo="<?php echo htmlspecialchars($recette['pseudo']); ?>"
                data-description="<?php echo htmlspecialchars($recette['description']); ?>">
          voir
        </button>
      <?php endforeach; ?>

      <div class="separateur-vert"></div>
    </section>
  </main>

  <!-- COLISÉE + FOOTER -->
  <section class="colosseum">
    <div class="greek-border"></div>

    <div class="arches-row">
      <div class="arch"></div><div class="arch"></div><div class="arch"></div>
      <div class="arch"></div><div class="arch"></div><div class="arch"></div>
    </div>
    <div class="arches-row">
      <div class="arch"></div><div class="arch"></div><div class="arch"></div>
      <div class="arch"></div><div class="arch"></div><div class="arch"></div>
    </div>

    <div class="footer-links">
      <a href="#">Mentions légales</a><br>
      <a href="#">Plan du site</a><br>
      <a href="#">A propos de nous</a>
    </div>
  </section>

  <!-- MODAL VOTE -->
  <div id="modal-overlay" class="modal-overlay">
    <div class="modal-vote">
      <button class="modal-close" aria-label="Fermer">✕</button>
      <div class="modal-greek"></div>

      <h2 class="modal-title">Votez !</h2>

      <div class="modal-content">
        <div class="modal-recette">
          <img id="modal-img" src="" alt="Image recette" class="modal-img">
        </div>

        <div class="modal-texte">
          <p class="modal-libelle">
            Recette de <span id="modal-pseudo"></span>
          </p>
          <p class="modal-nom" id="modal-nom"></p>
          <p class="modal-desc" id="modal-description"></p>
        </div>
      </div>

      <div class="modal-actions">
        <button class="btn-rect modal-confirmer">Confirmer le vote</button>
      </div>
    </div>
  </div>

  <script src="recettes.js"></script>
</body>
</html>
