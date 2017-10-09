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
<center>
  <h1 class="titrePrincipal">Bienvenue sur notre application</h1>
  <img class="imgPrincipal" src="../web/assets/logo/LogoComplet.svg" alt="Optimoov" height="25%" width="25%"/>
  <p class="txtPrincipal">N'attendez plus d'être en panne pour aller recharger votre voiture électrique ! </p>
</center>
</body>
<!-- ENDNAVBAR -->

<?php
//google service connection
$service = new Google_Service_Calendar($client);
$calendarId = 'primary';
$dateDemainSoir = new DateTime();

$dateDemainSoir = $dateDemainSoir->modify("+1 day");
$dateDemainSoir->setTime(23, 59, 59);

//get date of tomorrow

$dateDemainMatin = new DateTime();
$dateDemainMatin = $dateDemainMatin->modify("+1 day");
$dateDemainMatin->setTime(00, 00, 00);
$optParams = array(
      'maxResults' => 10,
      'orderBy' => 'startTime',
      'singleEvents' => TRUE,
      'timeMax' => $dateDemainSoir->format("Y-m-d\TH:m:sP"),
      'timeMin' => $dateDemainMatin->format("Y-m-d\TH:m:sP"),
);
// catch events from calendar google of tomorrow

$results = $service->events->listEvents($calendarId, $optParams);
//browse all results of tomorrow if one event exist
//return error if no one is detected
if (count($results->getItems()) == 0) {
    print "Pas d'évènements demain dans l'agenda.\n";
    unset($_SESSION['km']);
    unset($_SESSION['origin']);
    unset($_SESSION['waypoints']);
} else {
    $km = 0;
    //start google service plus to link the user infos with the app
    $plus = new Google_Service_Plus($client);
    $mail = $plus->people->get('me');
    $eamil = $mail['emails']['0']['value'];
    $user  = R::findOne( 'user', ' mail = ? ', [$eamil] );
    $previousEventLocation = $user["adresse"].", ".$user["ville"].", France";
    $_SESSION["origin"] = $previousEventLocation;

    $_SESSION['waypoints'] = array();
    foreach ($results->getItems() as $event) {
        $start = $event->start->dateTime;
        if (empty($start)) {
            $start = $event->start->date;
        }
        $endAddresse = str_replace(" ", "%20", $event->location);
        $previousEventLocation = str_replace(" ", "%20", $previousEventLocation);
        $json = file_get_contents('https://maps.googleapis.com/maps/api/directions/json?origin='.$previousEventLocation.'&destination='.$endAddresse.'&key=AIzaSyAVqjzEqc5bQS9K8k3AySOb1E57KMoMoc4');
        $previousEventLocation = $event->location;
        $array = json_decode($json);
        array_push($_SESSION["waypoints"], $event->location);
        $_SESSION['destination'] = $event->location;
        //$km += $array->routes[0]->legs[0]->distance->text;
        $km += floatval(str_replace("km", "", $array->routes[0]->legs[0]->distance->text));
        $_SESSION['km'] = $km;
    }
}
