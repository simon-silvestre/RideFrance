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
        <div class="col-5 mt-5 ml-5" id="SkateParkTitle">
            <h1>Skatepark de <span id="SkateparkName"><?= $skateparkPage['ville'] ?></span></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-5 mt-5 ml-5" id="SkateParkDescription">
            <h2 class="text-center mb-4 ">Description</h2>
            <img src="assets/<?= $skateparkPage['image'] ?>" alt="skatepark" class="col-12 p-0 m-0">
            <p class="mt-5"><?= $skateparkPage['contenu'] ?></p>
        </div>
    </div>
</div>



<?php $content = ob_get_clean() ?>

<?php require('NavBarTemplate.php'); ?>
