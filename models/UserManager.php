<?php 

namespace Models;

class UserManager extends Config
{
    public function register($nom, $prenom, $email, $pseudo, $hashpass)
    {
        $db = $this->dbConnect();
        $infos = $db->prepare("INSERT INTO Users(id, nom, prenom, email, pseudo, mdp, imageProfil, admin) VALUES(NULL, ?, ?, ?, ?, ?, '', 0)");
        $register = $infos->execute(array($nom, $prenom, $email, $pseudo, $hashpass));

        return $register;
    }

    public function Login($pseudo)
    {
        $db = $this->dbConnect();
        $login = $db->prepare("SELECT id, nom, prenom, email, pseudo, mdp, imageProfil, admin FROM Users WHERE pseudo = ?");
        $login->execute(array($pseudo));
        $resultLogin = $login->fetch();

        return $resultLogin;
    }

    public function saveProfil($id, $nom, $prenom, $email, $pseudo, $hashmdp, $img)
    {
        $db = $this->dbConnect();
        $up = $db->prepare("UPDATE Users SET nom= ?, prenom = ?, email = ?, pseudo = ?, mdp = ?, imageProfil = ? WHERE id = ?");
        $update = $up->execute(array($nom, $prenom, $email, $pseudo, $hashmdp, $img, $id));

        return $update;
    }

}