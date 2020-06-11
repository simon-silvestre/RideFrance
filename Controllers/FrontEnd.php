<?php

namespace Controllers;

class FrontEnd
{
    function viewHomePage()
    {
        $postManager = new \Models\PostManager();

        $showLastSkatepark = $postManager->showLastSkatepark();

        require('views/HomePage.php');
    }

    function viewSkateparkPage()
    {
        require('views/SkateParks.php');
    }
    
    function viewLoginPage()
    {
        require('views/LoginPage.php');
    }

    function viewProfilPage($pseudo)
    {
        $update = false;

        $userManager = new \Models\UserManager();
        $Ucommentaires = $userManager->UserCommentaire($pseudo);

        require('views/ProfilPage.php');
    }
    
    function viewProfilForm($pseudo)
    {
        $update = true;

        $userManager = new \Models\UserManager();
        $Ucommentaires = $userManager->UserCommentaire($pseudo);

        require('views/ProfilPage.php');
    }

    function ShowRegionPage($region)
    {
        $postManager = new \Models\PostManager();

        $showRegion = $postManager->ShowRegionSkatePark($region);

        require('views/RegionTemplate.php');
    }

    function ShowSkatePark($postId)
    {
        $postManager = new \Models\PostManager();
        $commentManager = new \Models\CommentManager();
        $usersManager = new \Models\UserManager();

        $skateparkPage = $postManager->GetSkatePark($postId);
        $showComments = $commentManager->showComments($postId);
        $notesMoyenne = $commentManager->getAvgRating($postId);
        
        require('views/SkateparkPostTemplate.php');
    }

    function AddCommentaire($post_id, $pseudo, $note, $commentaire)
    {
        $commentManager = new \Models\CommentManager();
        $PostCommentaire = $commentManager->AddComments($post_id, $pseudo, $note, $commentaire);

        if ($PostCommentaire === false) {
            throw new \Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            $_SESSION['message'] = "Le commentaire a été ajouté avec succès";
            $_SESSION['msg_type'] = "success";
            header('Location: index.php?action=viewSkatepark&id=' . $post_id);
        }
    }

    function SignalerCommentaire($id, $post_id)
    {
        $commentManager = new \Models\CommentManager();
        $PostCommentaire = $commentManager->signalerCommentaire($id);

        $_SESSION['message'] = "Le commentaire a été signalé avec succès";
        $_SESSION['msg_type'] = "success";

        header('Location: index.php?action=viewSkatepark&id=' . $post_id);
    }

    function ShowFavorisPage($userId)
    {
        $postManager = new \Models\PostManager();
        $Favoris = $postManager->GetFavoris($userId);

        require('views/FavorisPage.php');
    }

    function AddFavoris($post_id, $user_id)
    {
        $postManager = new \Models\PostManager();
        $Favoris = $postManager->Favoris($post_id, $user_id);

        if($Favoris == false){
            $_SESSION['message'] = "Le skatepark est deja dans vos favoris";
            $_SESSION['msg_type'] = "danger";

            header('Location: index.php?action=viewSkatepark&id=' . $post_id);
        } else {
            header('Location: index.php?action=viewSkatepark&id=' . $post_id);
        }
    }

    function ShowContactForm()
    {
        require('views/Contact.php');
    }

    function addSkateparkUsers($region, $ville, $contenu, $image, $adresse)
    {
        $extensionUpload = strtolower(substr(strrchr($image, '.'), 1));
        $extensionsValides = array('jpg', 'jpeg', 'png');
        $chemin = "assets/MiniatureSkateParks/".$adresse.'.'.$extensionUpload;
        $image = $adresse.'.'.$extensionUpload;

        if(in_array($extensionUpload, $extensionsValides))
        {
            $resultat = move_uploaded_file($_FILES['image']['tmp_name'], $chemin);
            if($resultat)
            {
                $postManager = new \Models\PostManager();
                $SkateparkUsers = $postManager->UserSkatepark($region, $ville, $contenu, $image, $adresse);
                
                if ($SkateparkUsers === false) {
                    throw new \Exception('Impossible d\'ajouter le Skatepark !');
                }
                else {
                    $_SESSION['message'] = "Le Skatepark a été envoyé avec succès";
                    $_SESSION['msg_type'] = "success";
                        
                    header('Location: index.php?action=SkateParks');
                }
            }
        }
    }
    
}