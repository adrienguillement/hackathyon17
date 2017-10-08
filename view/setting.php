<?php
include 'commons/header.php';
include 'commons/footer.php';
?>
<link rel="stylesheet" href="../web/css/bootstrap.css" ;?>
<link rel="stylesheet" href="../web/css/custom.css">
<link rel="stylesheet" href="../web/assets/font-awesome-4.7.0/css/font-awesome.min.css">

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col">
            <form>
                <fieldset>
                    <legend>Renseignements sur mon adresse : </legend>
                    <small id="adresseHelp" class="form-text text-muted">Vous pourrez changer votre adresse quand bon vous semble !</small></br>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Adresse : </label>
                        <input type="text" class="form-control" id="inputAdresse" placeholder="Mon adresse">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Code Postale : </label>
                        <input type="text" class="form-control" id="inputAdresse" placeholder="Mon adresse">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Ville : </label>
                        <input type="text" class="form-control" id="inputAdresse" placeholder="Mon adresse">
                    </div>

                    <legend>Renseignements sur mon vehicule : </legend>
                    <div class="form-group">
                        <label for="select">Choix de la voiture : </label>
                        <select class="form-control" id="selectCar">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="select">Choix du type de prise : </label>
                        <select class="form-control" id="selectCar">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Niveau de la batterie actuelle :</label>
                        <input type="text" class="form-control" id="inputAdresse" placeholder="40%">
                        <small id="adresseHelp" class="form-text text-muted">Pensez à le mettre à jour entre deux déplacement non prévus !</small>
                    </div>

                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </fieldset>
            </form>
        </div>
    </div>
</div>
