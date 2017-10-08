<?php
include 'commons/header.php';
include 'commons/footer.php';
use RedBeanPHP\R;

R::setup( 'mysql:host=localhost;dbname=optimoov',
    'root', null );
$borne = R::findAll('bornes');/*
for ($i=1; $i < sizeof($borne); $i++) {
  echo '<PRE>';
  var_dump($borne[$i]["lat"],$borne[$i]["lng"]);
  echo '</PRE>';

}*/
//id
//id_station
//adresse
//Ville
//code_postal
//lat
//lng
//type_recharge
//nbr_points_recharge
//type_connecteur_id

?>
<link rel="stylesheet" href="../web/css/bootstrap.css" ;?>
<link rel="stylesheet" href="../web/css/custom.css">
<link rel="stylesheet" href="../web/assets/font-awesome-4.7.0/css/font-awesome.min.css">
<script src="../web/assets/jquery/jquery.js"></script>
<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 80%;
        width: 100%;

      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body onload="initialize()">
  <div id="map"></div>


  <script>

var locations = [<?php for ($i=1; $i < sizeof($borne)+1; $i++) {
  if($i < sizeof($borne))
  {
      echo "["."\"".
      $borne[$i]["type_recharge"]."\"".","
      .$borne[$i]["lat"].","
      .$borne[$i]["lng"].","
      ."\"".$borne[$i]["id_station"]."\"".","
      ."\"".$borne[$i]["adresse"]."\"".","
      ."\"".$borne[$i]["ville"]."\"".","
      ."\"".$borne[$i]["type_connecteur_id"]."\"".","
      ."\"".$borne[$i]["nbr_points_recharge"]."\"".
      "],";
    }else{
      echo "["."\"".
      $borne[$i]["type_recharge"]."\"".","
      .$borne[$i]["lat"].","
      .$borne[$i]["lng"].","
      ."\"".$borne[$i]["id_station"]."\"".","
      ."\"".$borne[$i]["adresse"]."\"".","
      ."\"".$borne[$i]["ville"]."\"".","
      ."\"".$borne[$i]["type_connecteur_id"]."\"".","
      ."\"".$borne[$i]["nbr_points_recharge"]."\"".
      "]";
    }
  } ?>
];

    function initialize() {

      var myOptions = {
        center: new google.maps.LatLng(46.670511, -1.4264419999999518),
        zoom: 9

      };
      var map = new google.maps.Map(document.getElementById("map"),
          myOptions);

      setMarkers(map,locations)

    }


    function setMarkers(map,locations){

        var marker, i

        for (i = 0; i < locations.length; i++)
         {

         var typeRecharge = locations[i][0]
         var lat = locations[i][1]
         var long = locations[i][2]
         var id_station = locations[i][3];
         var adresse = locations[i][4]
         var ville = locations[i][5]
         var type_connecteur_id = locations[i][6]
         var nbr_points_recharge = locations[i][7]

      //   var code_postal = locations[i][6]



         latlngset = new google.maps.LatLng(lat, long);

          var marker = new google.maps.Marker({
                  map: map, title: typeRecharge , position: latlngset,
                  icon:"../web/assets/logo/Placeholder.png"

                });
          //map.setCenter(marker.getPosition())

          var type_connecteur;

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


          var data = "<div class='infoBorne'>" + "<div class='titreBox'><center>"+id_station+"</center></div>"+"</br>"
          +"</r>"+"<p>Type de borne : " + typeRecharge
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

        google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){
                return function() {
                   infowindow.setContent(content);
                   infowindow.open(map,marker);
                };
            })(marker,content,infowindow));

          }
    }

		</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFQa4KXUzF3BE_0msJoXMGSV1tk1yynE0">
</script>
