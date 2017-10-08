<?php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

// ... default page
$app['debug'] = true;
$app->get('/', function () use($client, $app){
    if(!$app['session']->get('is_user'))
    {
      $url = $client->createAuthUrl();
      $output = '<a href="'.$url.'">Se connecter </a>';
    }
    else {
        $output = $app->redirect('home');
    }
    $url = $client->createAuthUrl();
    $output = '<a href="'.$url.'">Se connecter </a>';
    return $output;
});

// ... home page
$app->get('/home', function () use($client, $app){
    //$app['session']->clear();
    if(isset($_GET['code'])){
        $app['session']->set('code', $_GET['code']);
        $client->authenticate($app['session']->get('code'));
        $app['session']->set('token', $client->getAccessToken());
        $app['session']->set('is_user', true);
    }
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
// ... map page
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
