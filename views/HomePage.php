<?php $title = 'Accueil'; ?>

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
  <header id="banner">
    <div class="container-fluid">
      <nav class="navbar navbar-expand-lg navbar-dark py-4">
        <a class="navbar-brand ml-lg-5 ml-0" id="navLogo" href="index.php?action=Accueil">RideFrance</a>
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

      <div class="row justify-content-around">
        <div class="col-lg-5 text-center text-lg-left mt-lg-5 ml-md-4" id="text-left">
          <h1 class="text-center text-lg-left mt-lg-5">Envie de rider ?</br>trouve un skatepark </h1>
          <a href="index.php?action=SkateParks" class="btn find_button rounded-pill px-4 py-2">Trouver un skatepark</a>
        </div>
        <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mt-lg-5" id="image-container">
          <img src="assets/quarter.png" alt="rampe" class="col-12 mt-xl-3 mt-5" id="img-right">
        </div>
      </div>
    </div>
  </header>

  <section id="homeIcon">
    <div class="container-fluid">
      <div class="row justify-content-around mt-5">
        <div class="home_icon col-xl-4 col-md-4 col-7 text-center mt-5">
          <img class="mx-auto col-xl-5 col-lg-8 col-md-8 col-sm-7 col-9" src="assets/map.png" alt="carte de france" id="home_icon_img">
          <p class="home_icon_text text-center mt-3">chosir le lieux</p>
        </div>
        <div class="home_icon col-xl-4 col-md-4 col-7 text-center mt-5">
          <img class="mx-auto col-xl-5 col-lg-8 col-md-8 col-sm-7 col-9" src="assets/skate.png" alt="skateur" id="home_icon_img">
          <p class="home_icon_text text-center mt-3">Aller rider</p>
        </div>
        <div class="home_icon col-xl-4 col-md-4 col-7 text-center mt-5">
          <img class="mx-auto col-xl-5 col-lg-8 col-md-8 col-sm-7 col-9" src="assets/review.png" alt="notes" id="home_icon_img">
          <p class="home_icon_text text-center mt-3">noter le park</p>
        </div>
      </div>
    </div>
  </section>


  <section id="Actualités">
    <div class="container-fluid">
      <div class="row mt-5">
        <h2 class="col-sm-12 col-10 mx-auto text-center mt-5 mb-lg-5 mb-2">les dernières actualités</h2>
      </div>
      <div class="col-xl-10 col-lg-12 col-md-7 col-sm-9 ml-lg-8 mt-lg-3 mx-auto mt-5 text-lg-left text-center">
        <div class="card-container d-flex justify-content-lg-between justify-content-center flex-wrap">
          <?php
          while ($lastPark = $showLastSkatepark->fetch())
          {
          ?>
          <div class="card card-style mb-5" id="HomePageCard">
              <a href="index.php?action=viewSkatepark&amp;id=<?= $lastPark['id'] ?>" id="HomeSkateImg"><img src="assets/MiniatureSkateParks/<?= $lastPark['image'] ?>" alt="..."></a>
            <div class="card-body">
              <p class="card-text date-card"><strong><?= $lastPark['ville'] ?></strong> | <?= $lastPark['creation_date_fr'] ?></p>
              <p class="card-description col-12 col-lg-11"><?=substr($lastPark['contenu'], 0, 50).'...';?></p>
            </div>
          </div>
          <?php 
          }
          $showLastSkatepark->closeCursor();
          ?>
        </div>
      </div>
    </div>
  </section>
</body>
</html>
