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

<h1>Salut</h1><?= $_SESSION['nom']; ?>

<?php $content = ob_get_clean() ?>

<?php require('navBarTemplate.php'); ?>
