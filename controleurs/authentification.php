<?php
session_start();
ini_set('display_errors', 1);
include_once('../modeles/user.php');

$_SESSION['connected'] = 'not connected';

$user = new User();
if (isset($_SESSION['pseudo'])) {
    $user->setStatus($_SESSION['pseudo'], false);
}

if (isset($_POST['pseudo']) && isset($_POST['password'])) {
    $pseudo   = htmlspecialchars($_POST['pseudo']);
    $password = htmlspecialchars($_POST['password']);

    if ($user->connect($pseudo, $password)) {
        $_SESSION['pseudo']    = $pseudo;
        $_SESSION['connected'] = 'connected';
        header('Location: chat.php');
    } else {
        print "Erreur: pseudo ou mot de passe erroné !";
    }
}


include_once('../vues/authentification.php');