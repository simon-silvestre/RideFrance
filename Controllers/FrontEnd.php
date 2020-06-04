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

        $skateparkPage = $postManager->GetSkatePark($postId);
        $showComments = $commentManager->showComments($postId);
        $notesMoyenne = $commentManager->getAvgRating();

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
        $_SESSION['msg_type'] = "danger";

        header('Location: index.php?action=viewSkatepark&id=' . $post_id);
    }

    function ShowFavorisPage()
    {
        $postManager = new \Models\PostManager();
        $Favoris = $postManager->GetFavoris();

        $AllFavoris = $postManager->GetFavSkatepark($Favoris['post_id']);

        require('views/FavorisPage.php');
    }

    function Favoris($post_id, $user_id)
    {
        $postManager = new \Models\PostManager();
        $Favoris = $postManager->Favoris($post_id, $user_id);

        if($Favoris == false){
            $_SESSION['message'] = "Le skatepark est deja dans vos favoris";
            $_SESSION['msg_type'] = "danger";

            header('Location: index.php?action=viewSkatepark&id=' . $post_id);
        } else {
            $_SESSION['message'] = "Le skatepark à bien été ajouté aux favoris";
            $_SESSION['msg_type'] = "success";

            header('Location: index.php?action=viewSkatepark&id=' . $post_id);
        }
    }
    
}