<?php

// Require map core.
require_once ('map/map.core.php');

$map    =   new GoogleMap ( 'AIzaSyCbvf_Q2X4XhMplEyjlE_KpYeL9T2oEpDo', 500, 500, 'map-canvas' );

// Set the center (Latitude and Longitude)
$map    ->  setCenter (array(
    'lat'   =>  15.03368414836334,
    'lng'   =>  -89.62204450000002
));

$map    ->  setZoom ( 5 );

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