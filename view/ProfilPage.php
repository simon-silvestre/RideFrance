<?php $title = 'Login page'; ?>

<?php ob_start(); ?>

<?php 
if (isset($_SESSION['message'])) { 
?>

<div class="alert alert-<?=$_SESSION['msg_type']?>">
<?php
    echo $_SESSION['message'];
    unset ($_SESSION['message']);
}?>
</div>

<div class="container-fluid">
    <div class="row" id="profilBanner">
        <img src="assets/profilBanner.jpg" alt="skatepark">
    </div>
    <div class="row">
        <div class="col-12 bg-dark d-flex align-items-center" id="ProfiBar">
            <div id="UserImage"></div>
            <p class="text-white ml-5">
                Bienvenue sur votre profil
                <?=
                    $_SESSION['pseudo'];
                ?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-4 mt-5">
            <p class="text-center">Mes informations</p>
        </div>
        <div class="col-8 mt-5">
            <p class="text-center">Mes commentaires</p>
        </div>
    </div>
</div>

<?php $content = ob_get_clean() ?>

<?php require('navBarTemplate.php'); ?>
