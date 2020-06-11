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
        <div class="ml-auto mt-4 mr-md-5 mr-3" id="favorisIcon">
            <a href="index.php?action=Favoris&amp;id=<?= $skateparkPage['id'] ?>"><i class="fas fa-heart" id="coeurPlein"></i></a>
            <a href="index.php?action=Favoris&amp;id=<?= $skateparkPage['id'] ?>"><i class="far fa-heart" id="coeurVide"></i></a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 col-8 ml-md-5 mx-auto text-center text-md-left" id="SkateParkTitle">
            <h1>Skatepark de <span id="SkateparkName"><?= $skateparkPage['ville'] ?></span></h1>
        </div>
    </div>
    <div class="row justify-content-between">
        <div class="col-md-5 col-10 mt-5 ml-md-5 mx-auto" id="SkateParkDescriptionLeft">
            <h2 class="text-center mb-4 ">Description</h2>
            <img src="assets/MiniatureSkateParks/<?= $skateparkPage['image'] ?>" alt="skatepark" class="col-12 p-0 m-0">
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
                    <div class="mx-auto" id="avgNotes"></div>
            </div>
        </div>
    </div>
    <div class="row justify-content-between mb-5 mt-5">
        <div class="col mr-5 ml-5" id="SkateParkDescriptionMap">
            <h2 class="text-center mb-4 ">Localisation</h2>
            <iframe src="https://maps.google.com/maps?q=<?= $skateparkPage['adresse'] ?>&output=embed" 
            height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" class="col-12 p-0"></iframe>
        </div>
    </div>
    <div class="row mb-5 mr-5 ml-5" id="SkateparkCommentaireForm">
        <h2 class="text-center mb-4 col-12">Commentaires</h2>
        <div class="col-12 card-body card" id="CommentForm">

        <?php if (isset($_SESSION['id'])){ ?>
        <form action="index.php?action=addComment&amp;id=<?= $skateparkPage['id'] ?>" method="post">
            <input type="hidden" name="pseudo" value="<?= $_SESSION['pseudo'] ?>">
            <div class="form-group ml-3 ml-lg-0 mr-3 mr-lg-0">
                <label for="comment">Note :</label>
                <div class="p-0" id="rateYo"></div>
            </div>
                <div class="form-group ml-3 ml-lg-0 mr-3 mr-lg-0">
                    <label for="comment">Commentaire</label>
                    <input type="text" class="form-control comment_input" id="inputCommentForm" name="commentaire">
                    <input type="hidden" name="rating" id="rating">
                </div>
                <button type="submit" class="btn btn-dark ml-3 ml-lg-0">Envoyer</button>
            </form>
        <?php } else { ?>
            <h3 class="text-center px-5" id="connectPublishComment">Veuillez vous connecter pour publier un commentaire</h3>
            <form class="form-inline">
                <a href="index.php?action=LoginPage" class="btn btn-dark mt-3 mx-auto">SE CONNECTER</a>
            </form>
        <?php }?>

        </div>
    </div>
        <?php
        while ($comments = $showComments->fetch())
        {
        if($comments['signaler'] == 0){?>
        <div class="row mr-5 ml-5" id="SkateparkCommentaire">
            <div class="d-flex flex-row card-body card mb-3">
                <div class="ml-3 ml-lg-0">
                    <div id="UserCommentImage" style="background-image: url(assets/ProfilImg/<?= $comments["imageProfil"]; ?>);"></div>
                </div>
                <div class="ml-2 col-lg-11">
                <p class="ml-2 ml-lg-0"><strong><?= $comments['User_pseudo'] ?></strong> le <?= $comments['comment_date_fr'] ?></p>
                <p><div class="p-lg-0 mt-1 rateYo-<?= $comments['Notes'] ?>"></div></p>

                <script>
                $(function () {
                    $(".rateYo-<?= $comments['Notes'] ?>").rateYo({
                        starWidth: "15px",
                        readOnly: true,
                        rating: <?= $comments['Notes'] ?>
                    });
                });
                </script>
                <form class="form-inline flex-nowrap">
                    <p class="mt-2 ml-2 ml-lg-0"><?= $comments['contenu'] ?></p>
                    <a class="btn btn-danger ml-auto mr-4 mr-lg-0 signalercomment" href="index.php?action=signalerCommentaire&amp;id=<?= $comments['id'] ?>&amp;postid=<?= $skateparkPage['id'] ?>"><i class="fas fa-exclamation"></i></a>
                </form>
            </div>
            </div>
        </div>
        <?php }
        }
        $showComments->closeCursor();
        ?>
</div>

<script>
$(function () {
    $("#rateYo").rateYo({
        fullStar: true,
         onSet: function(rating, rateYoInstance){
            $("#rating").val(rating);
        }
    });

    $("#avgNotes").rateYo({
        starWidth: "40px",
        readOnly: true,
        rating: '<?= $notesMoyenne['avg'] ?>'
    });
});
</script>

<?php $content = ob_get_clean() ?>

<?php require('NavBarTemplate.php'); ?>
