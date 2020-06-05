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

<div class="container" id="containerCommentaireManager">

    <?php while ($comments = $showAllcomment->fetch()){ ?>
    <?php if($comments['signaler'] == 1){?>
        <div class="row mr-5 ml-5" id="SkateparkCommentaire">
            <div class="col card-body card mb-3">
                <div>

                </div> 
                <div>
                <p class="ml-4 ml-lg-0"><strong><?= $comments['User_pseudo'] ?></strong> le <?= $comments['comment_date_fr'] ?></p>
                <p><div class="ml-3 ml-lg-0 p-lg-0 mt-1 rateYo-<?= $comments['Notes'] ?>"></div></p>

                <script>
                $(function () {
                    $(".rateYo-<?= $comments['Notes'] ?>").rateYo({
                        starWidth: "15px",
                        readOnly: true,
                        rating: <?= $comments['Notes'] ?>
                    });
                });
                </script>
                <form class="form-inline">
                    <p class="mt-2 ml-4 ml-lg-0"><?= $comments['contenu'] ?></p>
                    <div class="text-right icon_container iconCommentaireManager ml-auto mr-4 mr-lg-0">
                        <a class="btn btn-primary" href="index.php?action=approuverComment&amp;id=<?= $comments['id'] ?>"><i class="fas fa-check"></i></a>
                        <a class="btn btn-danger" href="index.php?action=deleteCommentaire&amp;id=<?= $comments['id'] ?>"><i class="far fa-trash-alt"></i></a>
                    </div>
                </form>
            </div>
            </div>
        </div>
    <?php } else if ($comments['signaler'] == 0){ ?>
        <div class="row mr-5 ml-5" id="SkateparkCommentaire">
            <div class="col card-body card mb-3">
                <div>

                </div> 
                <div>
                <p class="ml-4 ml-lg-0"><strong><?= $comments['User_pseudo'] ?></strong> le <?= $comments['comment_date_fr'] ?></p>
                <p><div class="ml-3 ml-lg-0 p-lg-0 mt-1 rateYo-<?= $comments['Notes'] ?>"></div></p>

                <script>
                $(function () {
                    $(".rateYo-<?= $comments['Notes'] ?>").rateYo({
                        starWidth: "15px",
                        readOnly: true,
                        rating: <?= $comments['Notes'] ?>
                    });
                });
                </script>
                <form class="form-inline">
                    <p class="mt-2 ml-4 ml-lg-0"><?= $comments['contenu'] ?></p>
                    <a class="btn btn-danger ml-auto mr-4 mr-lg-0" href="index.php?action=deleteCommentaire&amp;id=<?= $comments['id'] ?>"><i class="far fa-trash-alt"></i></a>
                </form>
            </div>
            </div>
        </div>
    <?php }?>
    <?php 
    }
    $showAllcomment->closeCursor();
    ?>

</div>

<?php $content = ob_get_clean() ?>

<?php require('NavBarTemplate.php'); ?>
