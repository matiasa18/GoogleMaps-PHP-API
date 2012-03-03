<?php

// Require map core.
require_once ('map/map.core.php');

$map    =   new GoogleMap ( 'AIzaSyCbvf_Q2X4XhMplEyjlE_KpYeL9T2oEpDo', 500, 500, 'map-canvas' );


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