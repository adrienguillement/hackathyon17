<?php
require __DIR__ . '../../vendor/autoload.php';
include 'commons/header.php';
include 'commons/footer.php';
use RedBeanPHP\R;
?>
<link rel="stylesheet" href="../web/css/bootstrap.css" ;?>
<link rel="stylesheet" href="../web/css/custom.css">
<link rel="stylesheet" href="../web/assets/font-awesome-4.7.0/css/font-awesome.min.css">

<?php
$plus = new Google_Service_Plus($client);
$mail = $plus->people->get('me');
var_dump($mail['emails']['0']['value']);
?>

<?php
R::setup( 'mysql:host=localhost;dbname=optimoov',
    'root', 'root' );
$test = R::getAll( 'SELECT * FROM modele' );
var_dump($test);
?>
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col">
            <?php if($adresse==null || $cp==null || $ville==null || $voiture==null || $prise==null || $pourcentage==null){?>
                <form action="parametre" method="post">
                    <fieldset>
                        <legend>Renseignements sur mon adresse : </legend>
                        <small id="adresseHelp" class="form-text text-muted">Vous pourrez changer votre adresse quand bon vous semble !</small></br>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Adresse : </label>
                            <input type="text" class="form-control" id="inputAdresse" placeholder="Mon adresse" name="adresse">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Code Postale : </label>
                            <input type="text" class="form-control" id="inputAdresse" placeholder="Mon code postale" name="cp" pattern="^(([0-8][0-9])|(9[0-5])|(2[ab]))[0-9]{3}$" title="Code postale invalide">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Ville : </label>
                            <input type="text" class="form-control" id="inputAdresse" placeholder="Ma ville" name="ville">
                        </div>

                        <legend>Renseignements sur mon vehicule : </legend>
                        <div class="form-group">
                            <label for="select">Choix de la voiture : </label>
                            <select class="form-control" id="selectCar" name="voiture">

                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="select">Choix du type de prise : </label>
                            <select class="form-control" id="selectCar" name="prise">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Niveau de la batterie actuelle :</label>
                            <input type="text" class="form-control" id="inputAdresse" placeholder="100%" name="pourcentage">
                            <small id="adresseHelp" class="form-text text-muted">Pensez à le mettre à jour entre deux déplacement non prévus !</small>
                        </div>

                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                    </fieldset>
                </form>
            <?php }else{?>
                <fieldset>
                    <h1>Oui</h1>
                </fieldset>
            <?php }?>
        </div>
    </div>
</div>
