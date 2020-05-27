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

    function viewProfilPage()
    {
        $update = false;
        require('views/ProfilPage.php');
    }
    
    function viewProfilForm()
    {
        $update = true;
        require('views/ProfilPage.php');
    }

    function ShowIDFPage()
    {
        $postManager = new \Models\PostManager();

        $showIDF = $postManager->ShowRegionPage();

        require('views/PagesRegions/IDF.php');
    }

    function ShowSkatePark($postId)
    {
        $postManager = new \Models\PostManager();

        $skateparkPage = $postManager->GetSkatePark($postId);

        require('views/SkateparkPostTemplate.php');
    }
    
}