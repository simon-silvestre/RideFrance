<?php

namespace Controllers;

class BackEnd
{
    function RegisterSysteme($nom, $prenom, $email, $pseudo, $mdp)
    {
        $hashpass = password_hash($mdp, PASSWORD_BCRYPT);

        $userManager = new \Models\UserManager();
        $Register = $userManager->Register($nom, $prenom, $email, $pseudo, $hashpass);

        $_SESSION['message'] = "Bravo vous êtes inscrit ! Vous pouvez maintenant vous connecter";
        $_SESSION['msg_type'] = "success";
        $update = false;

        require('views/LoginPage.php');
    }

    function LoginSysteme($pseudo, $mdp)
    {
        $userManager = new \Models\UserManager();

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
                $_SESSION['img'] = $resultLogin['imageProfil'];
                $_SESSION['admin'] = $resultLogin['admin'];
                $update = false;

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
        require('views/LoginPage.php');
    }

    function LogoutPage()
    {
        session_destroy();
        header('Location: index.php?action=Accueil');
    }

    function EditProfilInfos($id, $nom, $prenom, $email, $pseudo, $mdp, $img)
    {
        $userManager = new \Models\UserManager();

        if($img === "" && $mdp === "") {
            $img = $_SESSION['img'];
            $mdp = $_SESSION['mdp'];

            $resultUpdate = $userManager->saveProfil($id, $nom, $prenom, $email, $pseudo, $mdp, $img);

            $_SESSION['message'] = "Vos informations ont été modifiés avec succes";
            $_SESSION['msg_type'] = "info";

            $_SESSION['nom'] = $nom;
            $_SESSION['prenom'] = $prenom;
            $_SESSION['email'] = $email;
            $_SESSION['pseudo'] = $pseudo;
            
        }
        else if($mdp === "") {
            $mdp = $_SESSION['mdp'];

            $resultUpdate = $userManager->saveProfil($id, $nom, $prenom, $email, $pseudo, $mdp, $img);

            $_SESSION['message'] = "Vos informations ont été modifiés avec succes";
            $_SESSION['msg_type'] = "info";

            $_SESSION['nom'] = $nom;
            $_SESSION['prenom'] = $prenom;
            $_SESSION['email'] = $email;
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['img'] = $img;

            $update = false;
        }
        else if($img === "") {
            $img = $_SESSION['img'];

            $mdp = password_hash($mdp, PASSWORD_BCRYPT);

            $resultUpdate = $userManager->saveProfil($id, $nom, $prenom, $email, $pseudo, $mdp, $img);

            $_SESSION['message'] = "Vos informations ont été modifiés avec succes";
            $_SESSION['msg_type'] = "info";

            $_SESSION['nom'] = $nom;
            $_SESSION['prenom'] = $prenom;
            $_SESSION['email'] = $email;
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['mdp'] = $mdp;

        }
        else
        {
            $mdp = password_hash($mdp, PASSWORD_BCRYPT);
            
            $userManager = new \Models\UserManager();
            $resultUpdate = $userManager->saveProfil($id, $nom, $prenom, $email, $pseudo, $mdp, $img);

            if ($resultUpdate === false) {
                throw new \Exception('Impossible de modifier vos informations!');
            }
            else {
                $_SESSION['message'] = "Vos informations ont été modifiés avec succes";
                $_SESSION['msg_type'] = "info";

                $_SESSION['nom'] = $nom;
                $_SESSION['prenom'] = $prenom;
                $_SESSION['email'] = $email;
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['mdp'] = $mdp;
                $_SESSION['img'] = $img;

            }
        }
        $update = false;
        require('views/ProfilPage.php');
    }

    function ShowSkateParkManager()
    {
        $postManager = new \Models\PostManager();
        $skatepark = $postManager->ShowSkatePark();
        require('views/SkateParkAdmin.php');
    }

}