<?php
session_start();

require_once('AutoLoad.php');

$ControllerfrontEnd = new \Controllers\FrontEnd();
$ControllerbackEnd = new \Controllers\BackEnd();

if (isset($_GET['action'])) {
    /************ View Pages ************/
    if ($_GET['action'] == 'Accueil') {
        $ControllerfrontEnd->viewHomePage();
    }
    else if ($_GET['action'] == 'SkateParks') {
        $ControllerfrontEnd->viewSkateparkPage();
    }
    else if ($_GET['action'] == 'LoginPage') {
        $ControllerfrontEnd->viewLoginPage();
    }
    else if ($_GET['action'] == 'ProfilForm') {
        $ControllerfrontEnd->viewProfilForm($_SESSION['pseudo']);
    }
    else if ($_GET['action'] == 'Profil') {
        if (isset($_SESSION['id'])){
            $ControllerfrontEnd->viewProfilPage($_SESSION['pseudo']);
        }
        else {
            echo 'Veuillez vous connecter pour accéder à cette page';
        }
    }
    else if (isset($_POST['register'])){
        if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['pseudo']) && !empty($_POST['mdp'])) {
            $ControllerbackEnd->RegisterSysteme($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['pseudo'], $_POST['mdp']);
        }
        else {
            echo 'Tous les champs ne sont pas remplis !';
        }
    } 
    else if (isset($_POST['connexion'])){
        if (!empty($_POST['pseudo']) && !empty($_POST['mdp'])) {
            $ControllerbackEnd->LoginSysteme($_POST['pseudo'], $_POST['mdp']);
        }
        else {
            echo 'Tous les champs ne sont pas remplis !';
        } 
    }
    else if ($_GET['action'] == 'Logout') {
        $ControllerbackEnd->LogoutPage();
    }
    elseif (isset($_POST['saveProfil'])){
        if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['pseudo'])) {
            $ControllerbackEnd->EditProfilInfos($_POST['id'], $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['pseudo'], $_POST['mdp'], $_POST['image']);
        }
        else {
            echo 'Tous les champs ne sont pas remplis !';
        } 
    }
    else if ($_GET['action'] == 'region') {
        $ControllerfrontEnd->ShowRegionPage($_GET['region']);
    }
    else if ($_GET['action'] == 'viewSkatepark') {
        $ControllerfrontEnd->ShowSkatePark($_GET['id']);
    }
    else if ($_GET['action'] == 'Favoris') {
        $ControllerfrontEnd->Favoris($_GET['id'], $_SESSION['id']);
    }
    else if ($_GET['action'] == 'FavorisPage') {
        $ControllerfrontEnd->ShowFavorisPage();
    }
    else if ($_GET['action'] == 'addComment') {
        if (!empty($_POST['commentaire'])) {
            $ControllerfrontEnd->AddCommentaire($_GET['id'], $_POST['pseudo'], $_POST['rating'], $_POST['commentaire']);
        }   
        else {
            echo 'Tous les champs ne sont pas remplis !';
        }
    }
    else if ($_GET['action'] == 'signalerCommentaire') {
        $ControllerfrontEnd->SignalerCommentaire($_GET['id'], $_GET['postid']);
    }
    else if ($_GET['action'] == 'SkateManager') {
        $ControllerbackEnd->ShowSkateParkManager();
    }
    else if ($_GET['action'] == 'deleteSkatepark') {
        $ControllerbackEnd->supprimerSkatepark($_GET['id']);
    }
    else if ($_GET['action'] == 'addSkatepark') {
        $ControllerbackEnd->ShowAddForm();
    }
    else if ($_GET['action'] == 'editSkatepark') {
        $ControllerbackEnd->ShowEditForm($_GET['id']);
    }
    else if (isset($_POST['updateSkatepark'])){
        if (!empty($_POST['region']) && !empty($_POST['ville']) && !empty($_POST['contenu']) && !empty($_POST['adresse'])) {
            $ControllerbackEnd->updateChapitre($_POST['id'], $_POST['region'], $_POST['ville'], $_POST['contenu'], $_POST['adresse']);
        }
    }
    else if (isset($_POST['saveSkatepark'])){
        if (!empty($_POST['region']) && !empty($_POST['ville']) && !empty($_POST['contenu']) && !empty($_POST['adresse'])) {
            $ControllerbackEnd->addSkatepark($_POST['region'], $_POST['ville'], $_POST['contenu'], $_POST['image'], $_POST['adresse']);
        }
        else {
            echo 'Tous les champs ne sont pas remplis !';
        }
    } 
    else if ($_GET['action'] == 'AllUsers') {
        $ControllerbackEnd->GetAllUsers();
    }
    else if ($_GET['action'] == 'deleteUser') {
        $ControllerbackEnd->supprimerUtilisateur($_GET['id']);
    }
    else if ($_GET['action'] == 'changeAdmin') {
        $ControllerbackEnd->changeAdmin($_GET['id']);
    }
    else if ($_GET['action'] == 'changeUser') {
        $ControllerbackEnd->changeUser($_GET['id']);
    }
} 
else {
    $ControllerfrontEnd->viewHomePage();
}