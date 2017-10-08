<?php
include 'commons/header.php';
include 'commons/footer.php';
use RedBeanPHP\R;
/*
R::setup( 'mysql:host=localhost;dbname=optimoov','root', null);
$borne = R::findAll('bornes'); //reloads our book
echo '<PRE>';
var_dump($borne);
echo '</PRE>';
*/
?>
<link rel="stylesheet" href="../web/css/bootstrap.css" ;?>
<link rel="stylesheet" href="../web/css/custom.css">
<link rel="stylesheet" href="../web/assets/font-awesome-4.7.0/css/font-awesome.min.css">
<script src="../web/assets/jquery/jquery.js"></script>
<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 50%;
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
    <div>
      <div class="card card-outline-primary text-xs-center">
        <div class="card-block">
          <blockquote class="card-blockquote">
            <p>Nombre de Km : </p>
            <p>Durée de la destination : </p>
          </blockquote>
        </div>
      </div>
    </div>
    <script>

    var locations = [
        ['Espace Villeneuve - Route de Challans', 46.7435, -1.61386, 4],
        ['Rue Louis Pasteur', 46.597,-1.4523, 5]
        ];

    function initialize() {

      var myOptions = {
        center: new google.maps.LatLng(46.670511, -1.4264419999999518),
        zoom: 8

      };
      var map = new google.maps.Map(document.getElementById("map"),
          myOptions);

      setMarkers(map,locations)

    }


    function setMarkers(map,locations){

        var marker, i

        for (i = 0; i < locations.length; i++)
         {

         var loan = locations[i][0]
         var lat = locations[i][1]
         var long = locations[i][2]


         latlngset = new google.maps.LatLng(lat, long);

          var marker = new google.maps.Marker({
                  map: map, title: loan , position: latlngset,
                  icon:"../web/assets/markers/type1.png"

                });
                map.setCenter(marker.getPosition())


                var content = "Loan Number: " + loan +  '</h3>'

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
