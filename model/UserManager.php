<?php 
class UserManager
{
    public function register($nom, $prenom, $email, $pseudo, $hashpass)
    {
        $db = $this->dbConnect();
        $infos = $db->prepare("INSERT INTO Users(id, nom, prenom, email, pseudo, mdp, admin) VALUES(NULL, ?, ?, ?, ?, ?, 0)");
        $register = $infos->execute(array($nom, $prenom, $email, $pseudo, $hashpass));

        return $register;
    }

    public function Login($pseudo)
    {
        $db = $this->dbConnect();
        $login = $db->prepare("SELECT id, nom, prenom, email, pseudo, mdp, admin FROM Users WHERE pseudo = ?");
        $login->execute(array($pseudo));
        $resultLogin = $login->fetch();

        return $resultLogin;
    }

    private function dbConnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=rideFrance;charset=utf8', 'root', 'root');
        return $db;
    }
}