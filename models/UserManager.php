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

    public function saveProfil($id, $nom, $prenom, $email, $pseudo, $mdp, $img)
    {
        $db = $this->dbConnect();
        $up = $db->prepare("UPDATE Users SET nom= ?, prenom = ?, email = ?, pseudo = ?, mdp = ?, imageProfil = ? WHERE id = ?");
        $update = $up->execute(array($nom, $prenom, $email, $pseudo, $mdp, $img, $id));

        return $update;
    }

    public function UserCommentaire($pseudo)
    {
        $db = $this->dbConnect();
        $Ucomment = $db->prepare('SELECT id, post_id, User_pseudo, contenu, signaler, DATE_FORMAT(comment_date, \'%d/%M/%Y\') AS comment_date_fr FROM Commentaires WHERE User_pseudo = ?');
        $Ucomment->execute(array($pseudo));

        return $Ucomment;
    }

    public function GetAllUsers()
    {
        $db = $this->dbConnect();
        $Users = $db->query('SELECT id, nom, prenom, email, pseudo, imageProfil, admin FROM Users ORDER BY pseudo');
        
        return $Users;
    }

    public function deleteUser($id)
    {
        $db = $this->dbConnect();
        $delUser = $db->prepare("DELETE FROM Users WHERE id= ? ");
        $delUser->execute(array($id));

        return $delUser;
    }

    public function changeAdmin($id)
    {
        $db = $this->dbConnect();
        $up = $db->prepare("UPDATE Users SET admin = 1 WHERE id = ?");
        $update = $up->execute(array($id));

        return $update;
    }

    public function changeUser($id)
    {
        $db = $this->dbConnect();
        $up = $db->prepare("UPDATE Users SET admin = 0 WHERE id = ?");
        $update = $up->execute(array($id));

        return $update;
    }
}