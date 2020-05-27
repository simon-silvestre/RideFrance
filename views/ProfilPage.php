<?php $title = 'Profil'; ?>

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
            <div id="UserImage"><img src="<?= $_SESSION["img"]; ?>" alt=""></div>
            <p class="text-white ml-5">
                Bienvenue sur votre profil
                <span id="profilPseudo">
                <?=
                    $_SESSION['pseudo'];
                ?>
                </span>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-12 mt-5 mx-auto px-5 px-md-0">

            <?php if($update == false) { ?>

            <div class="mx-auto" id="profilInfosContainer">
            <p class="text-center" id="profilTitle">Mes informations</p>
                <div class="d-flex justify-content-between mt-5">
                    <div class="profilInfos">
                        <p class="col-5">Nom: </p>
                        <p id="profilSessionInfos"><?= $_SESSION['nom']; ?></p>
                    </div>
                    <div class="profilInfos">
                        <p class="col-5">Prénom: </p>
                        <p id="profilSessionInfos"><?= $_SESSION['prenom']; ?></p>
                    </div>
                </div>
                <div class="profilInfos">
                    <p class="col-12 mt-4">E-mail: </p>
                    <p id="profilSessionInfos"><?= $_SESSION['email']; ?></p>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <div class="profilInfos">
                        <p class="col-5">Pseudo: </p>
                        <p id="profilSessionInfos"><?= $_SESSION['pseudo']; ?></p>
                    </div>
                    <div class="profilInfos">
                        <p class="col-12">Mot de passe: </p> 
                        <p id="profilSessionInfos">***********</p>
                    </div>
                </div>
                <div class="profilInfos">
                        <p class="col-12 mt-4">Photo de profil: </p>
                        <p id="profilSessionInfos"><?= $_SESSION['img']; ?></p>
                    </div>
                <div class="form-group text-center">
                    <a href="index.php?action=ProfilForm" class="btn btn-primary col-12 mt-4" name="edit" id="ProfilFormBtn">Modifier mes informations</a>
                </div>
            </div>

            <?php } else if($update == true) { ?>

            <p class="text-center" id="profilTitle">Mes informations</p>
            <form action="index.php?action=saveProfil" method="post" class=" mt-5 mx-auto profil_Form" id="profilInfosContainer">
            <input type="hidden" name="id" value="<?=  $_SESSION['id']; ?>">
                <div class="form-group d-flex justify-content-between mb-4">
                    <input type="text" class="form-control col-5" name="nom" placeholder="Nom" value="<?= $_SESSION['nom']; ?>">
                    <input type="comment" class="form-control col-5" name="prenom" placeholder="Prénom" value="<?= $_SESSION['prenom']; ?>">
                </div>
                <div class="form-group mb-4">
                    <input type="email" class="form-control" name="email" placeholder="E-mail" value="<?= $_SESSION['email']; ?>">
                </div>
                <div class="form-group d-flex justify-content-between">
                    <input type="text" class="form-control col-5" name="pseudo" placeholder="Pseudo" value="<?= $_SESSION['pseudo']; ?>">
                    <input type="password" class="form-control col-5" name="mdp" placeholder="********"> 
                </div>
                <div class="form-group">
                    <input type="file" class="form-control mr-auto" name="image">
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary col-12" name="saveProfil" id="ProfilFormBtn">Enregistrer</button>
                </div>
            </form>
            <?php } ?>
        </div>
        <div class="col-md-7 col-12 mt-5 mx-auto">
            <p class="text-center" id="profilTitle">Mes commentaires</p>

            <div class="card-body card col-md-10 mb-3 mt-5 mx-auto" id="ProfilCommentaire">
                <p class="ml-4">Pseudo<strong></strong> Date</p>
                <p class="ml-4 mt-2">Commentaires</p>
            <form class="form-inline">
                <a class="btn btn-danger ml-auto mr-4 mr-lg-0 " href=""><i class="far fa-trash-alt"></i></a>
            </form>
        </div>
    </div>
        </div>
    </div>
</div>


<?php $content = ob_get_clean() ?>

<?php require('NavBarTemplate.php'); ?>
