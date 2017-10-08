<?php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;

$client = new Google_Client();
$client->setApplicationName("Application de test");
$client->setClientId('485660724723-ttl6d3is94aqhq5n0n9ecqo3iahf3vrk.apps.googleusercontent.com');
$client->setClientSecret('2i3xxuAH7BMTYRNoWiesnmbJ');
$client->setScopes('https://www.googleapis.com/auth/calendar.readonly');
$client->addScope('https://www.googleapis.com/auth/userinfo.email');
$client->setRedirectUri('http://localhost/hackathyon17/web/home');
$client->setAccessType('online');

// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();
$app->register(new Silex\Provider\SessionServiceProvider());

// Register services.
/*$app['dao.user'] = function () {
    return \APPLI\dao\UserDAO::getInstances();
};*/
