<?php
require_once __DIR__.'/../vendor/autoload.php';
include '../view/commons/header.php';
include '../view/commons/footer.php';
use RedBeanPHP\R;

R::setup( 'mysql:host=localhost;dbname=optimoov',
    'root', null );
?>
<link rel="stylesheet" href="../web/css/bootstrap.css">
<link rel="stylesheet" href="../web/css/custom.css">
<link rel="stylesheet" href="../web/assets/font-awesome-4.7.0/css/font-awesome.min.css">

<?php
$service = new Google_Service_Calendar($client);
$calendarId = 'primary';
$dateDemainSoir = new DateTime();

$dateDemainSoir = $dateDemainSoir->modify("+1 day");
$dateDemainSoir->setTime(23, 59, 59);

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
$results = $service->events->listEvents($calendarId, $optParams);

if (count($results->getItems()) == 0) {
    print "Pas d'évènements demain dans l'agenda.\n";
} else {
    $km = 0;

    $plus = new Google_Service_Plus($client);
    $mail = $plus->people->get('me');
    $mail = $mail['emails']['0']['value'];

    $user  = R::findOne( 'user', ' mail = ? ', [$mail] );
    $previousEventLocation = $user["adresse"].", ".$user["ville"].", France";
    $_SESSION["origin"] = $previousEventLocation;
    ?>
    <div class="container">
    <table class="table table-striped">
      <thead class="thead-inverse">
        <tr>
          <th>
            Lieu départ
          </th>
          <th>
            Lieu arrivé
          </th>
          <th>
            Distance
          </th>
          <th>
            Km total
          </th>
        </tr>
      <thead>

    <?php
    $_SESSION['waypoints'] = array();
    foreach ($results->getItems() as $event) {
      ?><tr><?php
        $start = $event->start->dateTime;
        if (empty($start)) {
            $start = $event->start->date;
        }
        ?><td><?php echo $previousEventLocation; ?></td><?php
        ?><td><?php echo $event->location; ?></td><?php
        $endAddresse = str_replace(" ", "%20", $event->location);
        $previousEventLocation = str_replace(" ", "%20", $previousEventLocation);
        $json = file_get_contents('https://maps.googleapis.com/maps/api/directions/json?origin='.$previousEventLocation.'&destination='.$endAddresse.'&key=AIzaSyAVqjzEqc5bQS9K8k3AySOb1E57KMoMoc4');
        $previousEventLocation = $event->location;
        $array = json_decode($json);

        array_push($_SESSION["waypoints"], $event->location);
        $_SESSION["destination"] = $event->location;
        ?><td><?php echo $array->routes[0]->legs[0]->distance->text; ?></td><?php
        $km += floatval(str_replace("km", "", $array->routes[0]->legs[0]->distance->text));
        ?><td><?php echo $km." km"; ?></td><?php
        ?></tr><?php
        $_SESSION['km'] = $km;
    }
    ?></table></div><?php
  }
 ?>
