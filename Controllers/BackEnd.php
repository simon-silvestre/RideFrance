<?php

namespace Controllers;

class BackEnd
{
    function RegisterSysteme($nom, $prenom, $email, $pseudo, $mdp)
    {
        $hashpass = password_hash($mdp, PASSWORD_BCRYPT);

        $userManager = new \Models\UserManager();
        $Register = $userManager->Register($nom, $prenom, $email, $pseudo, $hashpass);
        
        if($Register == false)
        {
            $_SESSION['message'] = "Attention ! Adresse mail ou pseudo déja utilisé";
            $_SESSION['msg_type'] = "danger";
        } 
        else 
        {
            $_SESSION['message'] = "Bravo vous êtes inscrit ! Vous pouvez maintenant vous connecter";
            $_SESSION['msg_type'] = "success";
            $update = false;
        }
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

        $userManager = new \Models\UserManager();
        $Ucommentaires = $userManager->UserCommentaire($pseudo);

        if($img === "" && $mdp === "") {
            $img = $_SESSION['img'];
            $mdp = $_SESSION['mdp'];

            $resultUpdate = $userManager->saveProfil($id, $nom, $prenom, $email, $pseudo, $mdp, $img);

            if($resultUpdate == false)
            {
                $_SESSION['message'] = "Attention ! Adresse mail ou pseudo déja utilisé";
                $_SESSION['msg_type'] = "danger";
            } 
            else 
            {
                $_SESSION['message'] = "Vos informations ont été modifiés avec succes";
                $_SESSION['msg_type'] = "info";

                $_SESSION['nom'] = $nom;
                $_SESSION['prenom'] = $prenom;
                $_SESSION['email'] = $email;
                $_SESSION['pseudo'] = $pseudo;
            }
        }
        else if($mdp === "") {
            $mdp = $_SESSION['mdp'];

            $resultUpdate = $userManager->saveProfil($id, $nom, $prenom, $email, $pseudo, $mdp, $img);

            if($resultUpdate == false)
            {
                $_SESSION['message'] = "Attention ! Adresse mail ou pseudo déja utilisé";
                $_SESSION['msg_type'] = "danger";
            } 
            else 
            {
                $_SESSION['message'] = "Vos informations ont été modifiés avec succes";
                $_SESSION['msg_type'] = "info";

                $_SESSION['nom'] = $nom;
                $_SESSION['prenom'] = $prenom;
                $_SESSION['email'] = $email;
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['img'] = $img;
            }
        }
        else if($img === "") {
            $img = $_SESSION['img'];

            $mdp = password_hash($mdp, PASSWORD_BCRYPT);

            $resultUpdate = $userManager->saveProfil($id, $nom, $prenom, $email, $pseudo, $mdp, $img);

            if($resultUpdate == false)
            {
                $_SESSION['message'] = "Attention ! Adresse mail ou pseudo déja utilisé";
                $_SESSION['msg_type'] = "danger";
            } 
            else 
            {
                $_SESSION['message'] = "Vos informations ont été modifiés avec succes";
                $_SESSION['msg_type'] = "info";

                $_SESSION['nom'] = $nom;
                $_SESSION['prenom'] = $prenom;
                $_SESSION['email'] = $email;
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['mdp'] = $mdp;
            }
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

    function ShowAddForm()
    {
        $update = false;
        $region = '';
        $ville = '';
        $contenu = '';
        $adresse = '';
        require('views/AddEditForm.php');
    }

    function addSkatepark($region, $ville, $contenu, $image, $adresse)
    {
        $postManager = new \Models\PostManager();
        $skatepark = $postManager->addSkatepark($region, $ville, $contenu, $image, $adresse);

        if ($skatepark === false) {
            throw new \Exception('Impossible d\'ajouter le Skatepark !');
        }
        else {
            $_SESSION['message'] = "Le Skatepark a été enregistré avec succès";
            $_SESSION['msg_type'] = "success";
            
            header('Location: index.php?action=SkateManager');
        }
    }

    function ShowEditForm($postId)
    {
        $update = true;

        $postManager = new \Models\PostManager();
        $skateparkPage = $postManager->GetSkatePark($postId);

        $region = $skateparkPage['region'];
        $ville = $skateparkPage['ville'];
        $contenu = $skateparkPage['contenu'];
        $adresse = $skateparkPage['adresse'];

        require('views/AddEditForm.php');
    }

    function supprimerSkatepark($id)
    {
        $postManager = new \Models\PostManager();
        $skateparkPage = $postManager->supprimerSkatepark($id);


        $_SESSION['message'] = "Le Skatepark a été supprimé avec succès";
        $_SESSION['msg_type'] = "danger";
        
        header('Location: index.php?action=SkateManager');
    }

}