<?php $title = 'SkatePark manager'; ?>



<?php ob_start(); ?>

<div class="container">
    <div class="row">
        <div class="col-11 mx-auto card-body mb-5">
            <form action="index.php?action=update" method="post" enctype="multipart/form-data" id="AddEditForm"> 
            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
            <div class="form-group">
                <label for="region">Région</label>
                <select class="form-control" name="region">
                    <option value="<?= $region; ?>"><?= $region; ?></option>
                    <option>Auvergne-Rhône-Alpes</option>
                    <option>Bourgogne-Franche-Comté</option>
                    <option>Bretagne</option>
                    <option>Centre-Val-de-Loire</option>
                    <option>Corse</option>
                    <option>Grand-Est</option>
                    <option>Hauts-de-France</option>
                    <option>Île-de-France</option>
                    <option>Normandie</option>
                    <option>Nouvelle-Aquitaine</option>
                    <option>Occitanie</option>
                    <option>Pays-de-la-Loire</option>
                    <option>Provence-Alpes-Côte-d'Azur</option>
                </select>
            </div>

                <div class="form-group">
                    <label for="ville">Ville</label>
                    <input type="text" class="form-control comment_input" id="InputTitle" name="ville" value="<?= $ville; ?>">
                </div>
                
                <div class="form-group">
                    <label for="content">Contenu</label>
                    <textarea class="form-control" id="mytextarea" name="contenu" rows="5"><?= $contenu; ?></textarea>
                </div>
                <div class="form-group d-flex justify-content-between">
                    <div class="col-6 pl-0">
                        <label for="Adresse">Adresse</label>
                        <input type="text" class="form-control comment_input" id="InputTitle" name="adresse" value="<?= $adresse; ?>">
                    </div>
                    
                    <div class="col-6 pr-0">
                        <label for="image">Image</label>
                        <input type="file" class="form-control mr-auto" name="image" id="profilInputImage">
                    </div>
                </div>
                <?php if ($update == true){?>
                    <button type="submit" class="btn btn-info" name="updateSkatepark">Modifier</button>
                <?php }else{?>
                    <button type="submit" class="btn btn-success" name="saveSkatepark">Ajouter l'article</button>
                <?php }?>
            </form>
        </div>
    </div>
</div>
    
<?php $content = ob_get_clean() ?>

<?php require('NavBarTemplate.php'); ?>
    