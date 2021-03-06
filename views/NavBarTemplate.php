<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b9aff8c9cf.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark" id="navbar_bleu">
      <a class="navbar-brand ml-4" id="navLogo" href="index.php?action=Accueil">RideFrance</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse mr-lg-5" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mr-lg-3">
          <li class="nav-item active">
            <a class="nav-link mr-lg-3" href="index.php?action=Accueil">ACCUEIL <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link mr-lg-3" href="index.php?action=SkateParks">SKATEPARKS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mr-lg-3" href="index.php?action=Contact">CONTACT</a>
          </li>
          <?php if (isset($_SESSION['id'])){
            if ($_SESSION['admin'] == 1) {?>
              <li class="nav-item dropdown">
                <a class="nav-link mr-lg-3 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                ADMINISTRATEUR
                </a>
                <div class="dropdown-menu bg-dark navBlack" aria-labelled="navbarDropdown">
                  <a class="dropdown-item" href="index.php?action=Profil">PROFIL</a> 
                  <a class="dropdown-item" href="index.php?action=SkateManager">SKATEPARKS MANAGER</a>
                  <a class="dropdown-item" href="index.php?action=CommentManager">COMMENTAIRES MANAGER</a>
                  <a class="dropdown-item" href="index.php?action=AllUsers">UTILISATEURS MANAGER</a>
                </div>
              </li>
            <?php } else if(($_SESSION['admin'] !== 1)) {?>
            <li class="nav-item dropdown">
            <a class="nav-link mr-lg-3 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            PROFIL
            </a>
              <div class="dropdown-menu bg-dark navBlack" aria-labelled="navbarDropdown">
              <a class="dropdown-item" href="index.php?action=Profil">PROFIL</a> 
              <a class="dropdown-item" href="index.php?action=FavorisPage">FAVORIS</a>
            </div>
          </li>
            <?php }?>
        <?php }?>
        </ul>
        <form class="form-inline navbar">
        <?php if (isset($_SESSION['id'])){ ?>
          <a href="index.php?action=Logout" class="btn btn-outline-light connected_button">SE DECONNECTER</a>
        <?php } else{?>
          <a href="index.php?action=LoginPage" class="btn btn-outline-light connected_button">SE CONNECTER</a>
        <?php }?>
        </form>
      </div>
    </nav>

    <?= $content ?>
</body>
</html>