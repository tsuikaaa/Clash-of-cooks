<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon profile</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Love+Ya+Like+A+Sister&display=swap" rel="stylesheet">
</head>
<body>
    <header>
     <div> 
    <p> Thème Actuelle : <?= htmlspecialchars($user['theme'] ?? 'Classique') ?></p>
    </div>

    <div>
        <a href="index.php"></a>
    </div>
    <div>
        <a href="poster-recette.php"> Poster sa recette </a>
    </div>
    <div>
        <a href="logout.php">Déconnexion</a>
    </header>

    <section>
        <div>
            <img src="<?= htmlspecialchars($user['photo'] ?? 'uploads/Photo/default.png') ?>"
            alt="Photo de profil" width="120" height="120">
        </div>
        
    <form action="modifier_profil.php" method="get">
        <button type="submit">Modifier mon profil</button>
    </form>

        <div>
            <h1><?= htmlspecialchars($user['username']) ?></h1>
            <p>@<?= htmlspecialchars($user['pseudo'] ?? 'utilisateur') ?></p>

            <p> <?= htmlspecialchars($user['victoires'] ?? '0') ?> victoires</p>
            <p>Rang : <?= htmlspecialchars($user['rang'] ?? 'non classé') ?></p>

            <blockquote>
                <?= htmlspecialchars($user['bio'] ?? 'Aucune biographie pour le moment.') ?>
            </blockquote>

            <form action="upload.php" method="post" enctype="multipart/form-data">
                <label>Changer sa photo :</label><br>
                <input type="file" name="photo" accept="image/*"><br><br>

                <label>Modifier bio :</label><br>
                <input type="text" name="bio"><br><br>

                <button type="submit">Enregistrer</button>
            </form>
        </div>
    </section>
    
<!-- Code injected by live-server -->
<script>
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script>
</body>
</html>
<style>
    body{
        font-family: 'Love Ya Like A Sister', cursive;
        font-style : normal;
        background-color: #FCFBCB;
    }

