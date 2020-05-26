<?php

namespace Controllers;

class FrontEnd
{
    function viewHomePage()
    {
        require('views/HomePage.php');
    }

    function viewSkateparkPage()
    {
        require('views/SkateParks.php');
    }

    function viewIDFPage()
    {
        require('views/PagesRegions/IDF.php');
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
    
}