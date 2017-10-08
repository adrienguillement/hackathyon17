<?php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use RedBeanPHP\R;


// ... default page
$app['debug'] = true;
$app->get('/', function () use($client, $app){
    ob_start();
    if(!$app['session']->get('is_user'))
    {
        require ('../view/connect.php');
        $output = ob_get_clean();
    }
    else {
        $output = $app->redirect('home');
    }
    return $output;
});
$app->get('/deconnection', function () use($client, $app){
    //$app['session']->clear();
    if(!$app['session']->get('is_user'))
    {
        $output = $app->redirect('.');
    }
    else {
        $_SESSION = array();
        $output = $app->redirect('.');
    }

    return $output;
});
// ... home page
$app->get('/home', function () use($client, $app){
    //$app['session']->clear();
    if(isset($_GET['code'])){
        R::setup( 'mysql:host=localhost;dbname=optimoov',
            'root', null );
        $app['session']->set('code', $_GET['code']);
        $client->authenticate($app['session']->get('code'));
        $app['session']->set('token', $client->getAccessToken());
        $app['session']->set('is_user', true);

        // VERIFICATION SI L'UTILISATEUR EST DANS LA BDD

        $plus = new Google_Service_Plus($client);
        $mail = $plus->people->get('me');
        $eamil = $mail['emails']['0']['value'];
        $user  = R::findOne( 'user', ' mail = ? ', [$eamil] );
        if(!isset($user)){



            // INSERT VEHICULE
            R::exec( 'INSERT INTO vehicule (pourcentage_batterie) VALUE (100) ' );

            // récupération de l'id
            $idVehicule = R::getInsertID();
            $vehicule  = R::findOne( 'vehicule', ' id = ? ', [$idVehicule] );

            // INSERT USER
            R::exec( 'INSERT INTO user (mail,vehicule_id) VALUE ("'.$eamil.'",'.$idVehicule.') ' );
            $idUser = R::getInsertID();
            $user  = R::findOne( 'user', ' id = ? ', [$idUser] );

        }
        $plus = "";
    }
    if(!$app['session']->get('is_user')){
        $output = $app->redirect('.');
    } else {
        ob_start();
        $client->setAccessToken($app['session']->get('token'));
        $token = json_decode($app['session']->get('token')['access_token']);
        require('../view/default.php');
        $output = ob_get_clean();
    }
    return $output;
});
// ... accueil page
$app->get('/accueil', function () use($client, $app){
    ob_start();
    if(!$app['session']->get('is_user')){
        $output = $app->redirect('.');
    } else {
        ob_start();
        $client->setAccessToken($app['session']->get('token'));
        $token = json_decode($app['session']->get('token')['access_token']);
        require ('../view/index.php');
        $output = ob_get_clean();
    }

    return $output;
});
// ... map page
$app->get('/map', function () use($client, $app){
    ob_start();
    if(!$app['session']->get('is_user')){
        $output = $app->redirect('.');
    } else {
        ob_start();
        $client->setAccessToken($app['session']->get('token'));
        $token = json_decode($app['session']->get('token')['access_token']);
        require ('../view/carte.php');
        $output = ob_get_clean();
    }

    return $output;
});
// ... setting page
$app->get('/parametres', function () use($client, $app){
    if(!$app['session']->get('is_user')){
        $output = $app->redirect('.');
    } else {
        ob_start();
        $client->setAccessToken($app['session']->get('token'));
        $token = json_decode($app['session']->get('token')['access_token']);
        require ('../view/setting.php');
        $output = ob_get_clean();
    }

    return $output;
});
$app->post('/parametre', function () use($client, $app){
    if(!$app['session']->get('is_user')){
        $output = $app->redirect('.');
    } else {
        ob_start();
        R::addDatabase( 'test', 'mysql:host=localhost;dbname=optimoov', 'root', null);
        R::selectDatabase( 'test' );
        // Récupération des données
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $mail = $_POST['mail'];
        $adresse = $_POST['adresse'];
        $cp = $_POST['cp'];
        $ville = $_POST['ville'];
        $voiture = $_POST['voiture'];
        $prise = $_POST['prise'];
        $pourcentage = $_POST['pourcentage'];
        $user  = R::findOne( 'user', ' mail = ? ', [$mail] );
        $vehicule  = R::findOne( 'vehicule', ' id = ? ', [$user["vehicule_id"]] );

        // UPDATE dans la base de donnée
        R::exec( 'UPDATE user SET prenom="'.$prenom.'",nom="'.$nom.'",adresse="'.$adresse.'",code_postal='.$cp.',ville="'.$ville.'" WHERE mail = "'.$mail.'"' );
        R::exec( 'UPDATE vehicule SET modele_id="'.$voiture.'",type_prise_id="'.$prise.'",pourcentage_batterie="'.$pourcentage.'" WHERE id = '.$vehicule['id'] );

        $client->setAccessToken($app['session']->get('token'));
        $token = json_decode($app['session']->get('token')['access_token']);
        require ('../view/index.php');
        $output = ob_get_clean();
    }

    return $output;
});
// ... planning page
$app->get('/planning', function () use($client, $app){
    if(!$app['session']->get('is_user')){
        $output = $app->redirect('.');
    } else {
        ob_start();
        $client->setAccessToken($app['session']->get('token'));
        $token = json_decode($app['session']->get('token')['access_token']);
        require ('../view/planning.php');
        $output = ob_get_clean();
    }

    return $output;
});

// ... couts page
$app->get('/couts', function () use($client, $app){
    if(!$app['session']->get('is_user')){
        $output = $app->redirect('.');
    } else {
        ob_start();
        $client->setAccessToken($app['session']->get('token'));
        $token = json_decode($app['session']->get('token')['access_token']);
        require ('../view/couts.php');
        $output = ob_get_clean();
    }

    return $output;
});
