<?php
session_start();
require('controller/frontEnd.php');
require('controller/backEnd.php');

$ControllerfrontEnd = new ControllerfrontEnd();
$ControllerbackEnd = new ControllerbackEnd();

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'Accueil') {
        $ControllerfrontEnd->viewHomePage();
    }
    if ($_GET['action'] == 'Profil') {
        if (isset($_SESSION['id'])){
            $ControllerfrontEnd->viewProfilPage();
        }
        else {
            echo 'Veuillez vous connecter pour accéder à cette page';
        }
    }
    else if ($_GET['action'] == 'LoginPage') {
        $ControllerfrontEnd->viewLoginPage();
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
    else if ($_GET['action'] == 'ProfilForm') {
            $ControllerfrontEnd->viewProfilForm();
        }
    elseif (isset($_POST['saveProfil'])){
        if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['pseudo'])) {
            $ControllerbackEnd->EditProfilInfos( $_POST['id'], $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['pseudo'], $_POST['mdp'], $_POST['image']);
        }
        else {
            echo 'Tous les champs ne sont pas remplis !';
        } 
    }
} 
else {
    $ControllerfrontEnd->viewHomePage();
}