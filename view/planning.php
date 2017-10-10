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
<img class="iconPlanning" src="../web/assets/logo/Placeholder.svg" alt="Optimoov" height="10%" width="10%"/>
<h1 style="text-align: center;margin-top:3%;">Vos trajets de demain : </h1>

<?php

//start google service calendar connexion
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
//get results of all google calendar events that's come tomorrow

$agenda_event = $service->events->listEvents($calendarId, $optParams);
if (count($agenda_event->getItems()) == 0) {
    //print "Pas d'évènements demain dans l'agenda.\n";
    echo "
    <div class='card card-inverse card-primary text-xs-center alertBox'style='text-align: center;'>
      <div class='card-block'>
        <blockquote class='card-blockquote'>
          <header style='margin-bottom:2%;'>Attention : </header>
          <p>Aucun évènement n'a été détécté dans l'agenda pour la journée de demain !</p>
          <p></p>
        </blockquote>
      </div>
    </div></br>";

    unset($_SESSION['km']);
    unset($_SESSION['origin']);
    unset($_SESSION['waypoints']);
} else {
    $km = 0;

    // start google service plus service to link with the user google's account
    $plus = new Google_Service_Plus($client);
    $mail = $plus->people->get('me');
    $mail = $mail['emails']['0']['value'];
    //match in the database the user
    $user  = R::findOne( 'user', ' mail = ? ', [$mail] );

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
            </thead>
            <tbody>
                <?php

                $_SESSION['waypoints'] = array();
                $previousEventLocation = $user["adresse"].", ".$user["ville"].", France";
                $_SESSION["origin"] = $previousEventLocation;
                $previousEventLocation = str_replace(" ", "%20", $previousEventLocation);
                array_unshift($_SESSION["waypoints"], $previousEventLocation);

                //browse all events and get property of trajets
                $_SESSION['trajets'] = array();
                $trajet_byDesc = array();
                // Get all trajet in google agenda
                foreach ($agenda_event->getItems() as $event) {
                    // Initialisation
                    $trajet_byAsc = array();
                    $start = $event->start->dateTime;
                    if (empty($start)) {
                        $start = $event->start->date;
                    }
                    $previousEventLocation = str_replace("%20", " ", $previousEventLocation);
                    $endEventLocation = str_replace(" ", "%20", $event->location);
                    $previousEventLocation = str_replace(" ", "%20", $previousEventLocation);
                    $start_time = $event["start"]["dateTime"];

                    // Get the data on the API
                    $json = file_get_contents('https://maps.googleapis.com/maps/api/directions/json?origin='.$previousEventLocation.'&destination='.$endEventLocation.'&key=AIzaSyAVqjzEqc5bQS9K8k3AySOb1E57KMoMoc4');
                    $trajet = json_decode($json);

                    //display waypoints
                    array_unshift($_SESSION["waypoints"], $event->location);
                    $_SESSION["destination"] = $event->location;

                    // Addition the km of the current trajet of the some of all trajets
                    $km += floatval(str_replace("km", "", $trajet->routes[0]->legs[0]->distance->text));

                    // Insert the current trajet in the array

                    array_push($trajet_byAsc, $start_time);
                    array_push($trajet_byAsc, $previousEventLocation);
                    array_push($trajet_byAsc, $endEventLocation);
                    array_push($trajet_byAsc, $trajet->routes[0]->legs[0]->distance->text);
                    array_push($trajet_byAsc, $km);
                    //durée totale du trajet
                    array_push($trajet_byAsc, $trajet->routes[0]->legs[0]->duration->value);

                    // Insert the array of the current trajet, in an array which regroup all informations of all trajet
                    array_unshift($trajet_byDesc, $trajet_byAsc);

                    // SET the current location to the previous location
                    $previousEventLocation = $event->location;

                    ?>
                    <tr>
                        <td>
                            <?php echo $previousEventLocation;?>
                        </td>
                        <td>
                            <?php echo $event->location; ?>
                        </td>
                        <td>
                            <?php echo $trajet->routes[0]->legs[0]->distance->text; ?>
                        </td>
                        <td>
                            <?php echo $km." km"; ?>
                        </td>
                    </tr>
                 <?php

                }

                //DERNIER TRAJET (JUSQU'A LA MAISON )

                // Initialisation
                $trajet_byAsc = array();
                $endEventLocation = $user["adresse"].", ".$user["ville"].", France";
                $previousEventLocation = str_replace(" ", "%20", $previousEventLocation);
                $endEventLocation = str_replace(" ", "%20", $endEventLocation);

                // Get the data on the API
                $json = file_get_contents('https://maps.googleapis.com/maps/api/directions/json?origin='.$previousEventLocation.'&destination='.$endEventLocation.'&key=AIzaSyAVqjzEqc5bQS9K8k3AySOb1E57KMoMoc4');
                $trajet = json_decode($json);

                // Addition the km of the current trajet of the some of all trajets
                $km +=  floatval(str_replace("km", "", $trajet->routes[0]->legs[0]->distance->text));
                $_SESSION['km'] = $km;

                // Insert the current trajet in the array
                array_push($trajet_byAsc, null);
                array_push($trajet_byAsc, $previousEventLocation);
                array_push($trajet_byAsc, $endEventLocation);
                array_push($trajet_byAsc, $trajet->routes[0]->legs[0]->distance->text);
                array_push($trajet_byAsc, $km);
                //durée totale du trajet
                array_push($trajet_byAsc, $trajet->routes[0]->legs[0]->duration->value);
                array_unshift($trajet_byDesc, $trajet_byAsc);

                //display waypoints
                array_unshift($_SESSION["waypoints"], $previousEventLocation = str_replace(" ", "%20", $previousEventLocation));

                $_SESSION['trajets'] = $trajet_byDesc;
                // Replace somes characteres for the dsiplay
                $previousEventLocation = str_replace("%20", " ", $previousEventLocation);
                $endEventLocation = str_replace("%20", " ", $endEventLocation);
                ?>
                <tr>
                    <td>
                        <?php echo $previousEventLocation;?>
                    </td>
                    <td>
                        <?php echo $endEventLocation;?>
                    </td>
                    <td>
                        <?php echo $trajet->routes[0]->legs[0]->distance->text; ?>
                    </td>
                    <td>
                        <?php echo $km;?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
<?php } ?>
