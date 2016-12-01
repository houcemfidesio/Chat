<?php
ini_set('display_errors', 1);


class Chat
{
    private $bdd;

    function __construct()
    {
        try {
            $this->bdd = new PDO('mysql:host=localhost;dbname=iad', 'root', '', [
                                                                      PDO::ATTR_ERRMODE =>
                                                                          PDO::ERRMODE_EXCEPTION,
                                                                  ]
            );
            $this->bdd->exec('SET CHARACTER SET utf8');
        } catch (Exception $e) {
            die('ERREUR : Impossible de se connecter à la base de donnée.' . $e->getMessage());
        }
    }

    function getAllMessages()
    {
        $messages = [];
        $query    = $this->bdd->query('SELECT pseudo, message, DATE_FORMAT(date_post, "%d/%m/%Y %H:%i:%s") AS date_post 
        FROM 
        chat ORDER BY id DESC LIMIT 30'
        );
        $i        = 0;
        while ($data = $query->fetch()) {
            $messages[$i] = $data;
            $i++;
        }
        return $messages;
    }

    function addMessage($pseudo, $message)
    {
        $query = $this->bdd->prepare('INSERT INTO chat(pseudo, message, date_post) VALUES(:pseudo, :message, NOW())');
        $query->execute([
                            'pseudo'  => htmlspecialchars($pseudo),
                            'message' => htmlspecialchars($message),
                        ]
        );
    }
}


