<?php

require_once('model/CommentManager.php');
require_once('model/Config.php');
require_once('model/PostManager.php');
require_once('model/UserManager.php');


class ControllerbackEnd
{
    function RegisterSysteme($nom, $prenom, $email, $pseudo, $mdp)
    {
        $hashpass = password_hash($mdp, PASSWORD_BCRYPT);

        $userManager = new Simon\RideFrance\Model\UserManager();
        $Register = $userManager->Register($nom, $prenom, $email, $pseudo, $hashpass);

        $_SESSION['message'] = "Vous êtes maintenant inscrit";
        $_SESSION['msg_type'] = "success";

        require('view/ProfilPage.php');
    }

    function LoginSysteme($pseudo, $mdp)
    {
        $userManager = new Simon\RideFrance\Model\UserManager();

        $resultLogin = $userManager->Login($pseudo);

        if($resultLogin == true)
        {
            if(password_verify($mdp, $resultLogin['mdp']))
            {
                $_SESSION['id'] = $resultLogin['id'];
                $_SESSION['nom'] = $resultLogin['nom'];
                $_SESSION['prenom'] = $resultLogin['prenom'];
                $_SESSION['email'] = $resultLogin['email'];
                $_SESSION['pseudo'] = $resultLogin['pseudo'];
                $_SESSION['mdp'] = $resultLogin['mdp'];
                $_SESSION['admin'] = $resultLogin['admin'];

                header('Location: index.php?action=Profil');
            } 
            else
            {
                $_SESSION['message'] = "Le mot de passe est faux";
                $_SESSION['msg_type'] = "danger";
            }
        }
        else 
        {
            $_SESSION['message'] = "Cet utilisateur n'existe pas";
            $_SESSION['msg_type'] = "danger";
        }
        require('view/LoginPage.php');
    }

    function LogoutPage()
    {
        session_destroy();
        header('Location: index.php?action=Accueil');
    }

}