<?php $title = 'Favoris'; ?>

<?php ob_start(); ?>

<div class="container-fluid" id="containerSkatepark">
    <div class="row justify-content-around mt-3 pt-4 pt-lg-0">

        <?php
        while ($skatepark = $AllFavoris->fetch())
        {
        ?>
        <div class="d-flex align-items-center mt-5 mb-4 mb-lg-0 mx-lg-4 mx-3" id="blogPost">
            <div id="blogPostImg">
                <a href="index.php?action=viewSkatepark&id=<?= $skatepark['id'] ?>"><img src="assets/MiniatureSkateParks/<?= $skatepark['image'] ?>" alt="skatepark"></a>
            </div>
            <div id="postInfo">
                <div id="blogPostDate">
                    <span><?=$skatepark['creation_date_fr']?></span>
                </div>
                <h1 class="text-center text-lg-left" id="blogPostTitle">
                    Skatepark de <?= $skatepark['ville'] ?>
                </h1>
                <p id="blogPostText">
                    <?=substr($skatepark['contenu'], 0, 110).'...';?>
                </p>
                <div class="form-inline justify-content-center justify-content-lg-start">
                    <a href="index.php?action=viewSkatepark&amp;id=<?= $skatepark['id'] ?>" id="blogPostBtn">Voir le skatepark</a>
                </div>
            </div>
        </div>
        <?php
        }
        $AllFavoris->closeCursor();
        ?>

    </div>
</div>

<?php $content = ob_get_clean() ?>

<?php require('views/NavBarTemplate.php'); ?>
