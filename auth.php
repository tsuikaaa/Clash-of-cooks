<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /* ========= INSCRIPTION ========= */
    if (isset($_POST['action']) && $_POST['action'] === 'register') {

        $mail   = trim($_POST['mail'] ?? '');
        $pseudo = trim($_POST['pseudo'] ?? '');
        $mdp    = trim($_POST['mdp'] ?? '');
        $mdp2   = trim($_POST['mdp2'] ?? '');

        if ($mail === '' || $pseudo === '' || $mdp === '' || $mdp2 === '' || $mdp !== $mdp2) {
            header('Location: inscription.php?err=inscription');
            exit;
        }

        // mail déjà utilisé ?
        $stmt = $pdo->prepare('SELECT id_profil FROM profils WHERE mail = ?');
        $stmt->execute([$mail]);
        if ($stmt->fetch()) {
            header('Location: inscription.php?err=mail');
            exit;
        }

        // upload photo de profil
        $ppFileName = 'default.png';
        if (!empty($_FILES['pp']['name'])) {
            $uploadDir = 'uploads_pp/'; // crée ce dossier à la racine du projet
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $ext = pathinfo($_FILES['pp']['name'], PATHINFO_EXTENSION);
            $ppFileName = uniqid('pp_') . '.' . $ext;
            $dest = $uploadDir . $ppFileName;

            move_uploaded_file($_FILES['pp']['tmp_name'], $dest);
        }

        // hash du mot de passe
        $hash = password_hash($mdp, PASSWORD_DEFAULT);

        $sql = 'INSERT INTO profils (mail, mdp, pseudo, description, pp, nb_victoire, recettes_faites)
                VALUES (?, ?, ?, "", ?, 0, 0)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$mail, $hash, $pseudo, $ppFileName]);

        header('Location: inscription.php?ok=inscription');
        exit;
    }

    /* ========= CONNEXION ========= */
    if (isset($_POST['action']) && $_POST['action'] === 'login') {

        $mail = trim($_POST['mail'] ?? '');
        $mdp  = trim($_POST['mdp'] ?? '');

        $stmt = $pdo->prepare('SELECT id_profil, mdp, pseudo, pp FROM profils WHERE mail = ?');
        $stmt->execute([$mail]);
        $user = $stmt->fetch();

        if ($user && password_verify($mdp, $user['mdp'])) {
            $_SESSION['id_profil'] = $user['id_profil'];
            $_SESSION['pseudo']    = $user['pseudo'];
            $_SESSION['pp']        = $user['pp'];
            header('Location: accueil.php');
            exit;
        } else {
            header('Location: inscription.php?err=login');
            exit;
        }
    }
}

// accès direct à auth.php -> retour au formulaire
header('Location: inscription.php');
