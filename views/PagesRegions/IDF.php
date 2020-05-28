<?php $title = 'Skateparks d\'île de france'; ?>

<?php ob_start(); ?>

<div class="container-fluid" id="containerSkatepark">
    <div class="row justify-content-around mt-3 pt-4 pt-lg-0">

        <?php
        while ($skatepark = $showIDF->fetch())
        {
        ?>
        <?php if($skatepark['region'] == "Île-de-France"){?>
        <div class="d-flex align-items-center mt-5 mb-4 mb-lg-0 mx-lg-4 mx-3" id="blogPost">
            <div id="blogPostImg">
                <img src="assets/<?= $skatepark['image'] ?>" alt="skatepark">
            </div>
            <div id="postInfo">
                <div id="blogPostDate">
                    <span><?=$skatepark['creation_date_fr']?></span>
                </div>
                <h1 id="blogPostTitle">
                    Skatepark de <?= $skatepark['ville'] ?>
                </h1>
                <p id="blogPostText">
                    <?=substr($skatepark['contenu'], 0, 110).'...';?>
                </p>
                <a href="index.php?action=viewSkatepark&id=<?= $skatepark['id'] ?>" id="blogPostBtn">Voir le skatepark</a>
            </div>
        </div>
        <?php }?>
        <?php
        }
        $showIDF->closeCursor();
        ?>

    </div>
</div>

<?php $content = ob_get_clean() ?>

<?php require('views/NavBarTemplate.php'); ?>
