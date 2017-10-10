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
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAVqjzEqc5bQS9K8k3AySOb1E57KMoMoc4">
</script>
<?php
if(!isset($_SESSION['km'])){
  echo "
  <div class='card card-inverse card-primary text-xs-center alertBox'style='text-align: center;'>
  <div class='card-block'>
  <blockquote class='card-blockquote'>
  <header style='margin-bottom:2%;'>Attention : </header>
  <p>Il semble que vous n'ayez aucun évènements demain ou que vos évènements n'ont pas d'adresses !</p>
  </blockquote>
  </div>
  </div></br>";
}else{
  //Récupération des variables sessions

  $trajets = $_SESSION['trajets'];
  $km_total = $_SESSION['km'];

  $destinationeuh = str_replace(" ", "%20", $_SESSION['destination']);
  $origineuh = str_replace(" ", "%20", $_SESSION['origin']);
  //utilisation de l'api google plus pour recuperer le mail de l'utilisateur
  $plus = new Google_Service_Plus($client);
  $mail = $plus->people->get('me');
  $mail = $mail['emails']['0']['value'];

  //Récupérer des données de la base et initialisation
  $user  = R::findOne( 'user', ' mail = ? ', [$mail] );
  $vehicule = R::findOne('vehicule', ' id = ? ', [$user["vehicule_id"]]);
  $modele = R::findOne('modele', ' id = ? ', [$vehicule["modele_id"]]);
  $bornes = R::getall('select * from bornes');

  $epa = floatval($modele["epa"]);
  $capacite_batterie = $modele["capacite_batterie"];
  //PE = Premier Event (le premier evenement de la journée)
  $PE_duree_trajet_minutes = (intval($trajets[sizeof($_SESSION['trajets'])-1][5]));
  $PE_startDate = $trajets[sizeof($_SESSION['trajets'])-1][0];
  $date_partir = new DateTime($PE_startDate);
  $date_partir->sub(new DateInterval('PT' . $PE_duree_trajet_minutes . 'S'));
  //$date_partir->sub(new DateInterval('PT' . date("Y-m-d H:i:s"). 'DATE'))
  $date_now = new DateTime(date("Y-m-d H:i:s"));
  $dteDiff  = $date_now->diff($date_partir);

  // few maths bowring things ...
  $pourcentage_batterie = floatval($vehicule["pourcentage_batterie"]);

  $energie_base = ($pourcentage_batterie/100)*$capacite_batterie;
  $energie_trajet = $km_total*($epa/1000);


  $actual_autonomie = floatval($modele["autonomie"]) * (intval($vehicule["pourcentage_batterie"])/100);
  if($actual_autonomie > $km_total){
    //si l'autonomie actuelle dans la batterie (km) est supérieur trajet global(km)
    //on affiche qu'il pourra effectuer son trajet
    //Autonomie (km) = Autonomie (table modèle) * pourcentage_batterie (table vehicule)
    //  echo "Vous pourrez bien effectuer votre trajet sans avoir besoin de recharger votre voiture.";
  }elseif ($actual_autonomie + ($dteDiff->h*$modele["MAX_AC"]/$epa) > $km_total) {
    //sinon si l'autonomie + la charge max possible > trajet global
    //affichage temps de charge à la maison
    echo "Nous vous conseillons de charger votre véhicule à votre domicile.
    Cela vous revient donc à :";//INSERER COUT SACHANT QUE C'EST 15cts/kWH
    echo "Pour : ";//INSERER TEMPS DE CHARGE MAISON
  }else{
    //Algo optimisation Étapes 4 et 5
    $plus = new Google_Service_Plus($client);
    echo "
    <div><strong>
    <p class='text-warning text-center texteColorOra' style='margin-top:2%;margin-bottom:2%;'>Vous n'aurez pas assez de batterie pour demain. Consultez la carte des bornes optimisées ci dessous.</p>

    </strong>
    </div>
    <div id='total' class='total'>
    </div>";//INSERER TEMPS DE CHARGE MAISON
    echo "<center><button type='button' onclick='callMap()' class='btn btn-success'>Charger la carte</button></center>";
    ?>

    <script>
    function callMap() {
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: {lat: 40.771, lng: -73.974}
      });

      // Create a renderer for directions and bind it to the map.
      var directionsDisplay = new google.maps.DirectionsRenderer({map: map});

      // Instantiate an info window to hold step text.
      //var stepDisplay = new google.maps.InfoWindow;

      var directionsService = new google.maps.DirectionsService;

      var locations = [["027VE001","Rue du fléchet","BOUFFÉRÉ",46.9577,-1.35084,"Rapide","1","3","47 min","Borne Optimisé"],["146VE001","Place du Pont Jarley","MONTAIGU",46.9741,-1.31215,"Normale et accélérée","2","1","1 h 34","Borne économique"]];

      /*
      directionsDisplay.addListener('directions_changed', function() {
      computeTotalDistance(directionsDisplay.getDirections());
    });*/


    //});

    displayRoute(directionsService,
      directionsDisplay);

      setMarkers(map,locations);

      latlngset = new google.maps.LatLng(46.9577, -1.35084);

      //display markers
    }
    function setMarkers(map,locations){


      var marker, i

      for (i = 0; i < locations.length; i++)
      {

        var typeRecharge = locations[i][5]
        var lat = locations[i][3]
        var long = locations[i][4]
        var id_station = locations[i][0];
        var adresse = locations[i][1]
        var ville = locations[i][2]
        var type_connecteur_id = locations[i][7]
        var nbr_points_recharge = locations[i][6]
        var temps_opti = locations[i][8]
        var designation = locations[i][9]
        //   var code_postal = locations[i][6]



        latlngset = new google.maps.LatLng(lat, long);

        //display markers
        var marker = new google.maps.Marker({
          map: map, title: typeRecharge , position: latlngset,
          icon:"../web/assets/logo/Placeholder.png"

        });
        //map.setCenter(marker.getPosition())

        var type_connecteur;

        //check with diffrents connecteurs types
        switch (type_connecteur_id) {
          case "1":
          type_connecteur = "EF-T3"
          break;
          case "2":
          type_connecteur = "EF-T3/EF/T2"

          break;
          case "3":
          type_connecteur = "T2-CHADEMO-COMBO"

          break;
        }

        //popup box infos
        var data = "<div class='infoBorne'>" + "<div class='titreBox'><center>"+designation+"</center></div>"+"</br>"
        +"</r>"+"<p>Type de borne : " + typeRecharge
        +"</p></r>"+"<p>Temps approximatif de recharge : " + temps_opti
        +"</p></r>"+"<p>Numero de station : " + id_station
        +"</p></r>"+"<p>Adresse : " + adresse
        + "</p></r>"+"<p>Ville : " + ville
        +"</p></r>"+"<p>Types de connecteur : " + type_connecteur
        +"</p></r>"+"<p>Nombre de points de recharge : " + nbr_points_recharge+
        "</p></div>";

        var content ="<div class='card card-outline-success text-xs-center'>"+
        "<div class='card-block'><blockquote class='card-blockquote'>"+
        data+
        "</blockquote></div></div>";


        var infowindow = new google.maps.InfoWindow()

        //listener onclick
        google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){
          return function() {
            infowindow.setContent(content);
            infowindow.open(map,marker);
          };
        })(marker,content,infowindow));
      }
    };


    function displayRoute(service, display) {
      service.route({
        origin: "<?php echo $_SESSION["origin"]; ?>",
        destination: "<?php echo $_SESSION["destination"]; ?>",
        waypoints:
        [<?php for($i=0;$i<sizeof($_SESSION['alldestination']);$i++){
          if($i<sizeof($_SESSION['alldestination'])-1){
            echo '{location :'."\"".$_SESSION['alldestination'][$i]."\"".'},';
          }else{
            echo '{location :'."\"".$_SESSION['alldestination'][$i]."\"".'}';
          }
        }?>],
        travelMode: 'DRIVING',
        avoidTolls: true
      }, function(response, status) {
        if (status === 'OK') {
          display.setDirections(response);
        } else {
          alert('Could not display directions due to: ' + status);
        }
      });
    }
    /*
    function computeTotalDistance(result) {
    var total = 0;
    var myroute = result.routes[0];
    for (var i = 0; i < myroute.legs.length; i++) {
    total += myroute.legs[i].distance.value;
  }
  total = total / 1000;
  document.getElementById('total').innerHTML = total + ' km';
}*/
</script>
<?php

$autonomie = floatval($modele["autonomie"]) +(1 /*CHARGE MAX POSSIBLE MAISON INSERER*/ *0.95);
/*

//d_reste représente la distance restante
$d_reste = $km_total;
//boucle for pour parcourir tout les trajets
for($i=0; $i<sizeof($trajets); $i++){
$distance_a_tester = floatval(str_replace(" km", "", $trajets[$i][3]));
//if autonomie > trajetglobal-distance actuelle(trajet[i])
var_dump($autonomie);
var_dump($km_total-$distance_a_tester);

if($autonomie > ($km_total-$distance_a_tester)){
echo '<pre>';
$mes_bornes = array();
for($j=0; $j<sizeof($bornes); $j++){
$ma_borne = array();
$addresse_borne = $bornes[$j]["adresse"].",%20".$bornes[$j]["ville"].",%20France";
array_push($ma_borne, $addresse_borne);
$addresse_borne = str_replace(" ", "%20", $addresse_borne);
for($a=0;$a<10;$a++){
//    $json = file_get_contents('https://maps.googleapis.com/maps/api/directions/json?origin='.$trajets[$i][1].'&destination='.$addresse_borne.'&key=AIzaSyAVqjzEqc5bQS9K8k3AySOb1E57KMoMoc4');
$trajet_borne = json_decode($json);
}
if(isset($trajet_borne->routes[0])){

$trajet_borne = $trajet_borne->routes[0]->legs[0]->distance->text;
var_dump($trajet_borne);
}
array_push($mes_bornes, $ma_borne);
}
}
//enlever la distance du trajet[i] à d_reste
$d_reste -= $distance_a_tester;
}
*/
}

//set message with differents scenario
if($energie_base > $energie_trajet){
  echo "
  <div><strong>
  <p class='text-success text-center' style='margin-top:2%;margin-bottom:2%;'>Vous pouvez réaliser le trajet sans recharger votre véhicule. Voici votre trajet (sans passer par les bornes) : </p>
  </strong>
  </div>";
}
if($energie_base < $energie_trajet && $energie_trajet < $capacite_batterie){

  echo "\nVous devez recharger votre batterie pour réaliser votre trajet";
  echo "\nAfficher ici la capacité nécessaire pour réaliser son trajet";
  echo "\nOn vous conseille de recharger votre véhicule à votre domicile, le prix du kWh est plus intéressant";

}
if($energie_base < $energie_trajet && $capacite_batterie < $energie_trajet){
  //  echo "\nVous devez recharger completement votre véhicule à votre domicile, puis le recharger sur les bornes disponibles sur votre trajet";
}
echo "</pre>";?>
<table class="table table-striped">
  <thead class="thead-inverse">
    <tr>
      <th>
        Lieu de départ et d'arrivé
      </th>
      <?php
      $compt = 1;
      foreach ($_SESSION["alldestination"] as $destination) {
        echo "<th>";
        echo"Lieu de passage n° ".$compt;
        echo "</th>";
        $compt++;
      }?>
      <th>
        Km total
      </th>
      <th>
        Autonomie restante
      </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php
      echo "<td>";
      echo $_SESSION["origin"];
      echo "</td>";

      foreach ($_SESSION["alldestination"] as $destination) {
        echo "<td>";
        echo $destination;
        echo "</td>";
      }

      echo "<td>";
      echo $_SESSION["km"];
      echo "</td>";

      echo "<td>";
      echo $autonomie;
      echo "</td>";

    }


    ?>
  </tr>
</tbody>
</table>
<div id="map"></div>

<style>
/* Always set the map height explicitly to define the size of the div
* element that contains the map. */
#map {
  height: 50%;
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

<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAVqjzEqc5bQS9K8k3AySOb1E57KMoMoc4">
</script>
<!--&callback=initMap-->
</body>
</html>
