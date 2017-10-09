<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Opti'Moov</title>
  <link rel="icon" type="image/png" href="../web/assets/logo/Placeholder.png" />

</head>
<body>
  <!--NAVBAR -->
  <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <a class="navbar-brand" href="http://localhost/hackathyon17/web/<?php echo 'accueil";'?>">
      <img class="imgPrincipal" src="../web/assets/logo/typoBlanc.png" alt="Optimoov" height="100%" width="100%"/>
    </a>

    <!--a class="navbar-brand" href="http://localhost/hackathyon17/web/<?php echo 'accueil";'?>">Accueil</a-->

    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="http://localhost/hackathyon17/web/<?php echo 'map";'?>">Carte<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost/hackathyon17/web/<?php echo 'planning";'?>">Planning</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost/hackathyon17/web/<?php echo 'couts";'?>">Coûts</a>
        </li>
      </ul>

      <ul class="navbar-nav mr-auto">

        <li class="nav-item">
            <a class="nav-link params" href="http://localhost/hackathyon17/web/<?php echo 'parametres";'?>"><i class="fa fa-cogs" aria-hidden="true"></i> Parametres</a>
        </li>

        <!--  DECONNECTION -->
        <?php if($app['session']->get('is_user')){?>
        <li class="nav-item">
            <a class="nav-link deconnection" href="http://localhost/hackathyon17/web/<?php echo 'deconnection";'?>"><i class="fa fa-power-off" aria-hidden="true"></i> Déconnection</a>
        </li>
      <?php }?>
      </ul>
    </div>
  </nav>
