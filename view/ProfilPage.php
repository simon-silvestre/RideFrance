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
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary col-12 mt-4" name="edit" id="ProfilFormBtn">Modifier mes informations</button>
                </div>
            </div>

            <?php } else if($update == true) { ?>

            <form action="index.php?action=?>" method="post" class="col-md-10 mt-5 mx-auto profil_Form">
                <div class="form-group d-flex justify-content-between mb-4">
                    <input type="text" class="form-control col-5" name=nom placeholder="Nom">
                    <input type="comment" class="form-control col-5" name="prenom" placeholder="Prénom">
                </div>
                <div class="form-group mb-4">
                    <input type="email" class="form-control" name=email placeholder="E-mail">
                </div>
                <div class="form-group d-flex justify-content-between">
                    <input type="text" class="form-control col-5" name=pseudo placeholder="Pseudo">
                    <input type="password" class="form-control col-5" name="mdp" placeholder="Mot de passe">
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary col-12" name="send" id="ProfilFormBtn">Envoyer</button>
                </div>
            </form>
            <?php } ?>
        </div>
        <div class="col-md-6 col-12 mt-5 mx-auto">
            <p class="text-center" id="profilTitle">Mes commentaires</p>
        </div>
    </div>
</div>

<?php $content = ob_get_clean() ?>

<?php require('navBarTemplate.php'); ?>
