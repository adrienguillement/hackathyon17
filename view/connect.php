<?php
//connection link to enter in the app
$url = $client->createAuthUrl();
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Opti'Moov</title>
  <link rel="icon" type="image/png" href="../web/assets/logo/Placeholder.png" />


</head>
<link rel="stylesheet" href="../web/css/bootstrap.css" ;?>
<link rel="stylesheet" href="../web/css/custom.css">
<link rel="stylesheet" href="../web/assets/font-awesome-4.7.0/css/font-awesome.min.css">
<body class="screenConnexion">
    <div class="jumbotron login">
      <center>
        <img class="imgConnect" src="../web/assets/logo/typo.svg" alt="Optimoov" height="25%" width="25%"/>

        <p class="lead">Connectez vous sur l'application : </p>
        <hr class="my-4">
        <p class="lead">
          <a class="btn btn-primary btn-lg" href="<?php echo $url; ?>">Se connecter </a>
        </p>
      </center>
    </div>
</body>

<footer class="footer">
  <div class="container">
    <center>
      <p style="margin-bottom:0;">Code fait avec le <i class="fa fa-heart" aria-hidden="true"></i> mais surtout avec du <i class="fa fa-coffee" aria-hidden="true"></i> | Hackathyon2k17 - Projet OptiMoov - Équipe Yes We Moov - Tous droits réservés - 2017</p>
    </center>
  </div>
</footer>
