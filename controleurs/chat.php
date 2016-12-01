<?php
session_start();
ini_set('display_errors', 1);
include_once('../modeles/chat.php');
include_once('../modeles/user.php');

if ($_SESSION['connected'] == 'connected' && isset($_SESSION['pseudo'])) {
    $chat = new Chat();
    $user = new User();
    if (isset($_POST['message'])) {
        $pseudo  = $_SESSION['pseudo'];
        $message = htmlspecialchars($_POST['message']);

        $chat->addMessage($pseudo, $message);
    }

    $messages = $chat->getAllMessages();
    $users = $user->getAllUsers();

    include_once('../vues/chat.php');
} else {
    header('Location: authentification.php');
}
