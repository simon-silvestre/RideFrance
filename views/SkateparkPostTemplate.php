<?php $title = 'skatepark'; ?>

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
    <div class="row">
        <div class="col-md-5 col-8 mt-5 ml-md-5 mx-auto text-center text-md-left" id="SkateParkTitle">
            <h1>Skatepark de <span id="SkateparkName"><?= $skateparkPage['ville'] ?></span></h1>
        </div>
    </div>
    <div class="row justify-content-between">
        <div class="col-md-5 col-10 mt-5 ml-md-5 mx-auto" id="SkateParkDescriptionLeft">
            <h2 class="text-center mb-4 ">Description</h2>
            <img src="assets/<?= $skateparkPage['image'] ?>" alt="skatepark" class="col-12 p-0 m-0">
            <p class="mt-5"><?= $skateparkPage['contenu'] ?></p>
        </div>
        <div class="col-md-4 mt-5 mr-5 ml-5 ml-md-0" id="SkateParkDescriptionRight">
            <div>
                <h2 class="text-center mb-5">Adresse</h2>
                <p class="mt-4 text-center"><?= $skateparkPage['region'] ?></p>
                <p class="mt-2 text-center"><?= $skateparkPage['adresse'] ?></p>
            </div>

            <div>
                <h2 class="text-center mb-5 mt-5">Notes des membres</h2>
                <div class="d-flex justify-content-center notes_Container">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                    <i class="far fa-star"></i>
                </div>
            </div>
            
            <div>
                <h2 class="text-center mb-4 mt-5">Notes le skatepark</h2>
                <?php if (isset($_SESSION['id'])){ ?>
                    <div class="d-flex justify-content-center notes_Container">
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
                <?php }else { ?>
                    <p class="text-center">Vous devez être inscrit pour noter le skatepark</p>
                    <form class="form-inline">
                    <a href="index.php?action=LoginPage" class="btn btn-dark mt-4 mx-auto">SE CONNECTER</a>
                    </form>
                <?php }?>
            </div>
        </div>
    </div>
    <div class="row justify-content-between mb-5 mt-5">
        <div class="col mr-5 ml-5" id="SkateParkDescriptionMap">
            <h2 class="text-center mb-4 ">Localisation</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2630.571690043915!2d2.348097315740805!3d48.75187797927727!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e67699a1b0f8d1%3A0x46c69deb7234bb63!2s7%20Petite%20Voie%20des%20Fontaines%2C%2094150%20Rungis!5e0!3m2!1sfr!2sfr!4v1590666243951!5m2!1sfr!2sfr" 
            height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" class="col-12 p-0"></iframe>
        </div>
    </div>
    <div class="row mb-5 mr-5 ml-5" id="SkateparkCommentaireForm">
        <h2 class="text-center mb-4 col-12">Commentaires</h2>
        <div class="col-12 card-body card" id="CommentForm">
            <form action="index.php?action=addComment&amp;id=<?= $skateparkPage['id'] ?>" method="post">
                <div class="form-group ml-3 ml-lg-0 mr-3 mr-lg-0">
                    <label for="comment">Commentaire</label>
                    <input type="comment" class="form-control comment_input" id="inputCommentForm" name="comment">
                </div>
                <button type="submit" class="btn btn-dark ml-3 ml-lg-0">Envoyer</button>
            </form>
        </div>
    </div>
        <?php
        while ($comment = $showComments->fetch())
        {
        ?>
        <div class="row mr-5 ml-5" id="ProfilCommentaire">
            <div class=" col card-body card mb-3">
                <p class="ml-4 ml-lg-0"><strong><?= $comment['User_pseudo'] ?></strong> le <?= $comment['comment_date_fr'] ?></p>
                <p class="mt-2 ml-4 ml-lg-0"><?= $comment['contenu'] ?></p>
                <form class="form-inline">
                    <a class="btn btn-danger ml-auto mr-4 mr-lg-0 " href=""><i class="fas fa-exclamation"></i></a>
                </form>
            </div>
        </div>
        <?php
        }
        $showComments->closeCursor();
        ?>
</div>



<?php $content = ob_get_clean() ?>

<?php require('NavBarTemplate.php'); ?>
