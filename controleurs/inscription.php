<?php
session_start();
ini_set('display_errors', 1);
include_once('../modeles/user.php');

$_SESSION['connected'] = 'not connected';
if (isset($_POST['password']) && isset($_POST['password2']) && $_POST['password'] == $_POST['password2']) {
    if (isset($_POST['pseudo'])) {
        $pseudo   = htmlspecialchars($_POST['pseudo']);
        $password = htmlspecialchars($_POST['password']);
        $user     = new User();
        if ($user->create($pseudo, $password)) {
            $_SESSION['pseudo']    = $pseudo;
            $_SESSION['connected'] = 'connected';
            header('Location: chat.php');
        } else {
            print 'Pseudo existant !';
        }
    }
} else {
    print 'Erreur: Mot de passe différents !';
}


include_once('../vues/authentification.php');