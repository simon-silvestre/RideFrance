<?php $title = 'Users manager'; ?>

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
    <table class="table mt-5 border">
    <thead id="adminTab">
        <tr class="center_form">
        <th scope="col">Pseudo</th>
        <th class="text-center" scope="col">Admin</th>
        <th class="text-center" scope="col">Actions</th>
        </tr>
    </thead>

    <tbody id="adminTabRow">
        <?php
        while ($User = $AllUsers->fetch())
        {
        ?>
         <tr class="center_form">
            <td><?= $User['pseudo']?></td>
            <td class="text-sm-center"><?php if($User['admin'] == true){echo "oui";}else{echo "non";} ?></td>
            <td class="text-center icon_container">
                <a class="btn btn-success icon_btn" href="index.php?action=changeUser&amp;id=<?= $User['id'] ?>"><i class="fas fa-user"></i></a>
                <a class="btn btn-info icon_btn" href="index.php?action=changeAdmin&amp;id=<?= $User['id'] ?>"><i class="fas fa-user-shield"></i></a>
                <a class="btn btn-danger" href="index.php?action=deleteUser&amp;id=<?= $User['id'] ?>"><i class="far fa-trash-alt"></i></a>
            </td>
        </tr>
        <?php 
        }
        $AllUsers->closeCursor();
        ?>
    </tbody>
    </table>
</div>


<?php $content = ob_get_clean() ?>

<?php require('NavBarTemplate.php'); ?>
    