<?php
require_once __DIR__.'/../vendor/autoload.php';
include 'commons/header.php';
include 'commons/footer.php';
use RedBeanPHP\R;

R::setup( 'mysql:host=localhost;dbname=optimoov',
    'root', null );
?>
<link rel="stylesheet" href="../web/css/bootstrap.css" ;?>
<link rel="stylesheet" href="../web/css/custom.css">
<link rel="stylesheet" href="../web/assets/font-awesome-4.7.0/css/font-awesome.min.css">
<?php

if(!isset($_SESSION['km'])){
    ?><h2>Une erreure est survenue, soit vous n'avez pas d'évènements, soit vos évènements n'ont pas d'adresses</h2><?php
}else{
  $kmTotal = $_SESSION['km'];
  $plus = new Google_Service_Plus($client);
  $mail = $plus->people->get('me');
  $mail = $mail['emails']['0']['value'];
  //retrieve all infos of the user
  $user  = R::findOne( 'user', ' mail = ? ', [$mail] );
  $vehicule = R::findOne('vehicule', ' id = ? ', [$user["vehicule_id"]]);
  $modele = R::findOne('modele', ' id = ? ', [$vehicule["modele_id"]]);
  $epa = floatval($modele["epa"]);
  $capacite_batterie = $modele["capacite_batterie"];

// few maths bowring things ...
  $pourcentage_batterie = floatval($vehicule["pourcentage_batterie"]);

  $energie_base = ($pourcentage_batterie/100)*$capacite_batterie;
  $energie_trajet = $kmTotal*($epa/1000);

  //tempo display of content
  echo "<pre>";
  echo "Nombre de km :".$kmTotal;
  echo " km\nEPA : ".$epa;
  echo " Wh/km\nÉnergie trajet : ".$energie_trajet;

  echo " kWh/km\n\nCapacite batterie : ".$capacite_batterie;
  echo " kWh\nPourcentage batterie : ".$pourcentage_batterie;
  echo " %\nEnergie charge base : ".$energie_base." kWh";


  //set message with diffrents scenario
  if($energie_base > $energie_trajet){
    echo "\nVous pouvez réaliser le trajet sans recharger votre véhicule. Voici votre trajet (sans passer par les bornes)";
  }
  if($energie_base < $energie_trajet && $energie_trajet < $capacite_batterie){

    echo "\nVous devez recharger votre batterie pour réaliser votre trajet";
    echo "\nAfficher ici la capacité nécessaire pour réaliser son trajet";
    echo "\nOn vous conseille de recharger votre véhicule à votre domicile, le prix du kWh est plus intéressant";

  }
  if($energie_base < $energie_trajet && $capacite_batterie < $energie_trajet){
    echo "\nVous devez recharger completement votre véhicule à votre domicile, puis le recharger sur les bornes disponibles sur votre trajet";
  }
  echo "</pre>";?>
  <?php echo $_SESSION["origin"]; ?>
  <?php echo $_SESSION["destination"];
  $waypoints = "";
  for($i=0; $i<sizeof($_SESSION["waypoints"]); $i++){
    $waypoints .= "{ location: '".$_SESSION["waypoints"][$i]."'}";
    if($i!=sizeof($_SESSION["waypoints"])-1){
      $waypoints .= ",";
    }
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Directions service (complex)</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 55%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
      #warnings-panel {
        width: 100%;
        height:10%;
        text-align: center;
      }
    </style>
  </head>
  <body>

    <div class ="mapCouts" id="map"></div>
    &nbsp;
    <div id="warnings-panel"></div>
    <script>
      function initMap() {
        var markerArray = [];

        // Instantiate a directions service.
        var directionsService = new google.maps.DirectionsService;

        // Create a map and center it on Manhattan.
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: {lat: 40.771, lng: -73.974}
        });

        // Create a renderer for directions and bind it to the map.
        var directionsDisplay = new google.maps.DirectionsRenderer({map: map});

        // Instantiate an info window to hold step text.
        var stepDisplay = new google.maps.InfoWindow;

        // Display the route between the initial start and end selections.
        calculateAndDisplayRoute(
            directionsDisplay, directionsService, markerArray, stepDisplay, map);
        // Listen to change events from the start and end lists.
        var onChangeHandler = function() {
          calculateAndDisplayRoute(
              directionsDisplay, directionsService, markerArray, stepDisplay, map);
        };
        document.getElementById('start').addEventListener('change', onChangeHandler);
        document.getElementById('end').addEventListener('change', onChangeHandler);
      }

      function calculateAndDisplayRoute(directionsDisplay, directionsService,
          markerArray, stepDisplay, map) {
        // First, remove any existing markers from the map.
        for (var i = 0; i < markerArray.length; i++) {
          markerArray[i].setMap(null);
        }

        // Retrieve the start and end locations and create a DirectionsRequest using
        // WALKING directions.
        directionsService.route({
          origin: "<?php echo $_SESSION["origin"]; ?>",
          destination: "<?php echo $_SESSION["destination"]; ?>",
          waypoints: [
                      <?php echo $waypoints; ?>
                      ],
          travelMode: 'DRIVING'
        }, function(response, status) {
          // Route the directions and pass the response to a function to create
          // markers for each step.
          if (status === 'OK') {
            document.getElementById('warnings-panel').innerHTML =
                '<b>' + response.routes[0].warnings + '</b>';
            directionsDisplay.setDirections(response);
            showSteps(response, markerArray, stepDisplay, map);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }

      function showSteps(directionResult, markerArray, stepDisplay, map) {
        // For each step, place a marker, and add the text to the marker's infowindow.
        // Also attach the marker to an array so we can keep track of it and remove it
        // when calculating new routes.
        var myRoute = directionResult.routes[0].legs[0];
        for (var i = 0; i < myRoute.steps.length; i++) {
          var marker = markerArray[i] = markerArray[i] || new google.maps.Marker;
          marker.setMap(map);
          marker.setPosition(myRoute.steps[i].start_location);
          attachInstructionText(
              stepDisplay, marker, myRoute.steps[i].instructions, map);
        }
      }

      function attachInstructionText(stepDisplay, marker, text, map) {
        google.maps.event.addListener(marker, 'click', function() {
          // Open an info window when the marker is clicked on, containing the text
          // of the step.
          stepDisplay.setContent(text);
          stepDisplay.open(map, marker);
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAVqjzEqc5bQS9K8k3AySOb1E57KMoMoc4&callback=initMap">
    </script>
  </body>
</html>
