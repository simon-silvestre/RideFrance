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
        $skatepark = $postManager->ShowAllSkatePark();
        require('views/SkateParkManager.php');
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

    function updateChapitre($id, $region, $ville, $contenu, $adresse)
    {
        $postManager = new \Models\PostManager();
        $updateSkatepark = $postManager->updateSkatepark($id, $region, $ville, $contenu, $adresse);

        
        if ($updateSkatepark === false) {
            throw new \Exception('Impossible de modifier le chapitre !');
        }
        else {
            $_SESSION['message'] = "Le Skatepark a été modifié avec succès";
            $_SESSION['msg_type'] = "info";

            header('Location: index.php?action=SkateManager');
        }
    }

    function supprimerSkatepark($id)
    {
        $postManager = new \Models\PostManager();
        $skateparkPage = $postManager->supprimerSkatepark($id);


        $_SESSION['message'] = "Le Skatepark a été supprimé avec succès";
        $_SESSION['msg_type'] = "danger";
        
        header('Location: index.php?action=SkateManager');
    }

    function GetAllUsers()
    {
        $usersManager = new \Models\UserManager();
        $AllUsers = $usersManager->GetAllUsers();

        require('views/UtilisateursManager.php');
    }

    function supprimerUtilisateur($id)
    {
        $usersManager = new \Models\UserManager();
        $deleteUser = $usersManager->deleteUser($id);

        $_SESSION['message'] = "L'utilisateur a été supprimé avec succès";
        $_SESSION['msg_type'] = "danger";

        header('Location: index.php?action=AllUsers');
    }

    function changeAdmin($id)
    {
        $usersManager = new \Models\UserManager();
        $changeAdmin = $usersManager->changeAdmin($id);

        header('Location: index.php?action=AllUsers');
        require('views/UtilisateursManager.php');
    }

    function changeUser($id)
    {
        $usersManager = new \Models\UserManager();
        $changeuser = $usersManager->changeUser($id);

        header('Location: index.php?action=AllUsers');
        require('views/UtilisateursManager.php');
    }

    function deleteCommentaire($id)
    {
        $commentManager = new \Models\CommentManager();
        $delCommentaire = $commentManager->deleteCommentaire($id);

        $_SESSION['message'] = "Le commentaire a été supprimé avec succès";
        $_SESSION['msg_type'] = "danger";
        
        header('Location: index.php?action=Profil');
    }

    function ShowCommentaireManager()
    {
        $commentManager = new \Models\CommentManager();
        $showAllcomment = $commentManager->showAllComments();

        require('views/CommentairesManager.php');
    }

    function ApprouverComment($id)
    {
        $commentManager = new \Models\CommentManager();
        $approuverCommentaire = $commentManager->ApprouverCommentaires($id);

        $_SESSION['message'] = "Le commentaire a été approuvé avec succès";
        $_SESSION['msg_type'] = "info";

        header('Location: index.php?action=CommentManager');
    }

}