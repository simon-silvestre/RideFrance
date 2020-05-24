<?php

require_once('model/CommentManager.php');
require_once('model/Config.php');
require_once('model/PostManager.php');
require_once('model/UserManager.php');

class ControllerfrontEnd
{
    function viewHomePage()
    {
        require('view/homePage.php');
    }

    function viewSkateparkPage()
    {
        require('view/SkateParks.php');
    }

    function viewIDFPage()
    {
        require('view/PagesRegions/IDF.php');
    }
    
    function viewLoginPage()
    {
        require('view/LoginPage.php');
    }

    function viewProfilPage()
    {
        $update = false;
        require('view/ProfilPage.php');
    }
    
    function viewProfilForm()
    {
        $update = true;
        require('view/ProfilPage.php');
    }
    
}