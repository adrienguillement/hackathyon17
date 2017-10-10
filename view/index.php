<?php

include '../view/commons/header.php';
//include '../view/commons/footer.php';
use RedBeanPHP\R;
//link database
R::addDatabase( 'optimoov', 'mysql:host=localhost;dbname=optimoov', 'root', null);
R::selectDatabase( 'optimoov' );
?>
<link rel="stylesheet" href="../web/css/bootstrap.css">
<link rel="stylesheet" href="../web/css/custom.css">
<link rel="stylesheet" href="../web/assets/font-awesome-4.7.0/css/font-awesome.min.css">
<body>

<!-- ENDNAVBAR -->

<?php

$plus = new Google_Service_Plus($client);
$mail = $plus->people->get('me');
$eamil = $mail['emails']['0']['value'];
$user  = R::findOne( 'user', ' mail = ? ', [$eamil] );
$vehicule  = R::findOne( 'vehicule', ' id = ? ', [$user["vehicule_id"]] );
$modele = R::findOne('modele', ' id = ? ', [$vehicule["modele_id"]]);

$pourcentage = $vehicule->pourcentage_batterie;
$bagnole = $modele->libelle;

$prenom = $user->prenom;
$nom = $user->nom;
$mail = $user->mail;
?>
<center>
<div class="jumbotron miseaneveau">
  <h3>Bienvenue <?php echo $prenom." ".$nom ?> </h3>
  <center>
    <img class="imgPrincipal" src="../web/assets/logo/LogoComplet.svg" alt="Optimoov" height="15%" width="15%"/>
    <p class="txtPrincipal">N'attendez plus d'être en panne pour aller recharger votre voiture électrique ! </p>
  </center>
</body>
  <hr class="my-4">
  <center>
    <p class="lead">Voici quelques informations qui vous détaillent : </p>

  <p>Votre adresse mail : <?php echo $mail ?> </p>
  <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
  <p>Pourcentage de batterie restant : <?php echo $pourcentage ?>%</p>
  <small class="form-text text-muted"><a href="http://localhost/hackathyon17/web/<?php echo 'parametres";'?>>Cliquer ici pour la mettre à jour</a></small></br>

  <p>Modele de voiture : <?php echo $bagnole ?> </p>

</center>

  <p class="lead">
    <a class="btn btn-outline-primary" role="button" href="http://localhost/hackathyon17/web/<?php echo 'planning";'?>">Consultez votre planning</a>
  </p>
</div>
</center>
