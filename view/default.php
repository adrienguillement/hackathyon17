<?php
require __DIR__ . '../../vendor/autoload.php';
include 'commons/header.php';
include 'commons/footer.php';
use RedBeanPHP\R;
R::addDatabase( 'optimoov', 'mysql:host=localhost;dbname=optimoov', 'root', null);
R::selectDatabase( 'optimoov' );
?>
<link rel="stylesheet" href="../web/css/bootstrap.css" ;?>
<link rel="stylesheet" href="../web/css/custom.css">
<link rel="stylesheet" href="../web/assets/font-awesome-4.7.0/css/font-awesome.min.css">

<?php
$plus = new Google_Service_Plus($client);
$mail = $plus->people->get('me');
$eamil = $mail['emails']['0']['value'];
$user  = R::findOne( 'user', ' mail = ? ', [$eamil] );
$vehicule  = R::findOne( 'vehicule', ' id = ? ', [$user["vehicule_id"]] );
?>
<div class="container" style="padding-bottom: 50px;">
    <div class="row justify-content-md-center">
        <div class="col">
            <h1 style="text-align: center;"> Complétez vos données pour avoir accès à toutes les fonctionnalités de l'application !</h1><br>
            <form action="parametre" method="post">
                <fieldset>
                    <legend>Renseignements sur moi : </legend>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Prénom : </label>
                        <input type="text" class="form-control" id="inputPrenom" placeholder="Mon prénom" name="prenom"  value="<?php echo $user["prenom"]; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Nom : </label>
                        <input type="text" class="form-control" id="inputNom" placeholder="Mon nom" name="nom"  value="<?php echo $user["nom"]; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1" style="display: none;">Email : </label>
                        <input type="text" class="form-control" id="inputEmail" placeholder="Mon email" name="mail"  value="<?php echo $user["mail"]; ?>" style="display: none;">
                    </div>

                    <legend>Renseignements sur mon adresse : </legend>
                    <small id="adresseHelp" class="form-text text-muted">Vous pourrez changer votre adresse quand bon vous semble !</small></br>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Adresse : </label>
                        <input type="text" class="form-control" id="inputAdresse" placeholder="Mon adresse" name="adresse"  value="<?php echo $user["adresse"]; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Code Postale : </label>
                        <input type="text" class="form-control" id="inputCP" placeholder="Mon code postale" name="cp" value="<?php echo $user["code_postal"]; ?>" pattern="^(([0-8][0-9])|(9[0-5])|(2[ab]))[0-9]{3}$" title="Code postale invalide" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Ville : </label>
                        <input type="text" class="form-control" id="inputVille" placeholder="Ma ville" name="ville" value="<?php echo $user["ville"]; ?>"required>
                    </div>

                    <legend>Renseignements sur mon vehicule : </legend>
                    <div class="form-group">
                        <label for="select">Choix de la voiture : </label>
                        <select class="form-control" id="selectCar" name="voiture" required>
                            <?php
                            $model = R::getAll( 'SELECT * FROM modele' );
                            foreach($model as $one){
                                ?>
                                <option value="<?php echo $one["id"];?>" <?php if($vehicule["modele_id"]==$one["id"]){echo "selected";}?>><?php echo $one["libelle"];?></option>
                                <?php
                            }
                            ?>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="select">Choix du type de prise : </label>
                        <select class="form-control" id="selectCar" name="prise" required>
                            <?php
                            $prise = R::getAll( 'SELECT * FROM type_prise' );
                            foreach($prise as $one){
                                ?>
                                <option value="<?php echo $one["id"];?>" <?php if($vehicule["type_prise_id"]==$one["id"]){echo "selected";}?>><?php echo $one["libelle"];?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Niveau de la batterie actuelle (%) :</label>
                        <input type="text" class="form-control" id="inputPourcentage" placeholder="100%" name="pourcentage"  value="<?php echo $vehicule["pourcentage_batterie"]; ?>" pattern="^[1-9][0-9]?$|^100$" title="Pourcentage invalide, mettre un nombre compris entre 1 et 100." required>
                        <small id="adresseHelp" class="form-text text-muted">Pensez à le mettre à jour entre deux déplacement non prévus !</small>
                    </div>
                    <div class="form-group" style="text-align: center;">
                      <button type="submit" class="btn btn-outline-success">Sauvegarder</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
