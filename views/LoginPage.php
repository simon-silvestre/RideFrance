<?php $title = 'Connexion'; ?>

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

<div class="form_bg">
    <div class="container-fluid"> 
         <div class="row justify-content-md-around justify-content-center flex-wrap-reverse" id="form_container">
            <div class="col-lg-4 col-md-5 col-sm-8 col-11 mt-md-0 mt-5">
                <form class="form_horizontal" action="index.php?action=connexion" method="post">
                    <div class="form_icon"><i class="fa fa-user-circle"></i></div>
                    <h3 class="title">S'inscrire</h3>
                    <div class="form_group">
                        <span class="input-icon"><i class="fa fa-user"></i></span>
                        <input class="form-control" type="text" name="nom" placeholder="Nom">
                    </div>
                    <div class="form_group">
                        <span class="input-icon"><i class="fa fa-user"></i></span>
                        <input class="form-control" type="text" name="prenom" placeholder="Prénom">
                    </div>
                    <div class="form_group">
                        <span class="input-icon"><i class="fas fa-envelope"></i></span>
                        <input class="form-control" type="email" name="email" placeholder="E-mail">
                    </div>
                    <div class="form_group">
                        <span class="input-icon"><i class="fas fa-user-circle"></i></span>
                        <input class="form-control" type="text" name="pseudo" placeholder="Pseudo">
                    </div>
                    <div class="form_group">
                        <span class="input-icon"><i class="fa fa-lock"></i></span>
                        <input class="form-control" type="password" name="mdp" placeholder="Mot de passe">
                    </div>
                    <button type="submit" class="btn signin" name="register">S'inscrire</button>
                </form>
             </div>


             <div class="col-lg-4 col-md-5 col-sm-8 col-11">
                <form class="form_horizontal" action="index.php?action=connexion" method="post">
                    <div class="form_icon"><i class="fa fa-user-circle"></i></div>
                    <h3 class="title">Se connecter</h3>
                    <div class="form_group">
                        <span class="input-icon"><i class="fas fa-user-circle"></i></span>
                        <input class="form-control" type="text" name="pseudo" placeholder="Pseudo">
                    </div>
                    <div class="form_group">
                        <span class="input-icon"><i class="fa fa-lock"></i></span>
                        <input class="form-control" type="password" name="mdp" placeholder="Mot de passe">
                    </div>
                    <button type="submit" class="btn signin" name="connexion">Connexion</button>
                </form>
             </div>
        </div>
    </div>
    <span id="separation"></span>
</div>
   
<?php $content = ob_get_clean() ?>

<?php require('NavBarTemplate.php'); ?>
    