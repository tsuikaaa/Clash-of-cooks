<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // INSCRIPTION
    if (isset($_POST['action']) && $_POST['action'] === 'register') {
        $mail = trim($_POST['mail'] ?? '');
        $mdp  = trim($_POST['mdp'] ?? '');
        $mdp2 = trim($_POST['mdp2'] ?? '');

        if ($mail === '' || $mdp === '' || $mdp2 === '' || $mdp !== $mdp2) {
            header('Location: index.php?err=inscription');
            exit;
        }

        $stmt = $pdo->prepare('SELECT id_profil FROM profils WHERE mail = ?');
        $stmt->execute([$mail]);
        if ($stmt->fetch()) {
            header('Location: index.php?err=mail');
            exit;
        }

        $hash = password_hash($mdp, PASSWORD_DEFAULT);

        $sql = 'INSERT INTO profils (mail, mdp, pseudo, description, pp, nb_victoire, recettes_faites)
                VALUES (?, ?, ?, "", "default.png", 0, 0)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$mail, $hash, $mail]);   // pseudo = mail par défaut

        header('Location: index.php?ok=inscription');
        exit;
    }

    // CONNEXION
    if (isset($_POST['action']) && $_POST['action'] === 'login') {
        $mail = trim($_POST['mail'] ?? '');
        $mdp  = trim($_POST['mdp'] ?? '');

        $stmt = $pdo->prepare('SELECT id_profil, mdp, pseudo FROM profils WHERE mail = ?');
        $stmt->execute([$mail]);
        $user = $stmt->fetch();

        if ($user && password_verify($mdp, $user['mdp'])) {
            $_SESSION['id_profil'] = $user['id_profil'];
            $_SESSION['pseudo']    = $user['pseudo'];
            header('Location: accueil.php');
            exit;
        } else {
            header('Location: index.php?err=login');
            exit;
        }
    }
}

header('Location: index.php');
