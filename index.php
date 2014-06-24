<?php

// Require map core.
require_once ('map/map.core.php');

$map    =   new Map ( 'AIzaSyCbvf_Q2X4XhMplEyjlE_KpYeL9T2oEpDo', 500, 500, 'map-canvas' );

// Set the center (Latitude and Longitude)
$map    ->  setCenter (array(
    'lat'   =>  15.03368414836334,
    'lng'   =>  -89.62204450000002
));

$map    ->  setZoom ( 5 );

// We create the new marker
$marker = new marker ( 'Marker 1' , 15.03333, -89.1102000 );

// We load the marker to the map
$map    ->  addMarker ( $marker );

// Adding it "Dynamically"
$map    ->  addMarker ( new marker ( 'Marker 2', 13.0000, -87 ) );


?>
<html>
    
    <head>
       <title>Testing the api</title> 
       <script type="text/javascript" src="jquery.js"></script>
       <?php echo $map -> printHead ( ); ?>
    </head>
    
    <body>
        <?php echo $map -> printCanvas ( ); ?>
    </body>
    
</html>