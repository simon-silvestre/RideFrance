<?php $title = 'Chapitres manager'; ?>


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

<div class="container">
    <table class="table mt-5">
    <thead id="adminTab">
        <tr class="center_form">
        <th scope="col">Ville</th>
        <th class="text-center" scope="col">Région</th>
        <th class="text-center" scope="col">Actions</th>
        </tr>
    </thead>

    <tbody id="adminTabRow">
        <?php
        while ($listSkatePark = $skatepark->fetch())
        {
        ?>
         <tr class="center_form">
            <td><?= $listSkatePark['ville']?></td>
            <td class="text-sm-center"><?= $listSkatePark['region']?></td>
            <td class="text-center icon_container">
                <a class="btn btn-warning icon_btn" href="index.php?action=post&id=<?= $listSkatePark['id'] ?>"><i class="far fa-eye"></i></a>
                <a class="btn btn-info icon_btn" href="index.php?action=edit&amp;id=<?= $listSkatePark['id'] ?>"><i class="far fa-edit"></i></a>
                <a class="btn btn-danger" href="index.php?action=deleteChapter&amp;id=<?= $listSkatePark['id'] ?>"><i class="far fa-trash-alt"></i></a>
                
            </td>
        </tr>
        <?php 
        }
        $skatepark->closeCursor();
        ?>
    </tbody>
    </table>

    <a class="btn mb-5" href="index.php?action=addChapter" id="addSkateParkBtn">Ajouter un SkatePark</i></a>
</div>


<?php $content = ob_get_clean() ?>

<?php require('NavBarTemplate.php'); ?>
    