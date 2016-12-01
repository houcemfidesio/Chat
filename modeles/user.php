<?php
ini_set('display_errors', 1);


class User
{
    private $bdd;
    private $connected;

    function __construct()
    {
        try {
            $this->bdd = new PDO('mysql:host=localhost;dbname=iad', 'root', '', [
                                                                      PDO::ATTR_ERRMODE =>
                                                                          PDO::ERRMODE_EXCEPTION,
                                                                  ]
            );
            $this->bdd->exec('SET CHARACTER SET utf8');
            $this->connected = false;
        } catch (Exception $e) {
            die('ERREUR : Impossible de se connecter à la base de donnée.' . $e->getMessage());
        }
    }

    public function connect($pseudo, $password)
    {
        $query = $this->bdd->query("SELECT password FROM User WHERE pseudo = '$pseudo'");
        $pass  = $query->fetch()[0];
        if ($password == $pass) {
            $this->connected = true;
            $this->setStatus($pseudo, true);
        }
        return $this->connected;
    }

    public function exist($pseudo)
    {
        $query = $this->bdd->query("SELECT password FROM User WHERE pseudo = '$pseudo'");
        if ($query->fetch()[0]) {
            return true;
        }
        return false;
    }

    public function create($pseudo, $password)
    {
        if (!$this->exist($pseudo)) {

            try {
                $query = $this->bdd->prepare('INSERT INTO user(pseudo, password) VALUES(:pseudo, :password)');
                $query->execute([
                                    'pseudo'   => htmlspecialchars($pseudo),
                                    'password' => htmlspecialchars($password),
                                ]
                );
                $this->setStatus($pseudo, true);
                return true;
            } catch (Exception $e) {
                die('ERREUR : Impossible de se creer l\'utilisateur' . $e->getMessage());
            }
        }
        return false;

    }

    public function setStatus($pseudo, $status)
    {
        try {
            $query = $this->bdd->prepare('UPDATE user SET status = :status WHERE pseudo = :pseudo');
            $query->execute([
                                'pseudo' => htmlspecialchars($pseudo),
                                'status' => htmlspecialchars($status),
                            ]
            );
            return true;
        } catch (Exception $e) {
            die('ERREUR : Impossible de modifier l\'état de l\'utilisateur' . $e->getMessage());
        }
        return false;
    }

    public function getAllUsers()
    {
        $users = [];
        $query    = $this->bdd->query('SELECT pseudo FROM user WHERE status=1 ORDER BY id DESC');
        $i        = 0;
        while ($data = $query->fetch()) {
            $users[$i] = $data;
            $i++;
        }
        return $users;
    }
}


