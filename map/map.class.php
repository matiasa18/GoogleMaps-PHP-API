<?php
/*********************************
 * Map class
 * 
 * Handles almost everything, markers, information in them
 * 
 * settings, etc.
 * 
 * Copyright, Matias Bonifacino 2012
 * contact: www.matiasbonifacino.com
 */

class GoogleMap {
    // The default zoom our map will have.
    private $zoom = 15;
    
    // The key for the google maps, this is strictly needed.
    // How to get it: http://code.google.com/apis/maps/signup.html
    private $key = '';
    
    // Use it if ur users mostly have GPS on their mobile phones
    // I wish there was something like this for geolocations..
    private $sensor = 'false';
    
    // Height of the map canvas
    private $height;
    
    // Width of the map canvas
    private $width;
    
    // The id of the canvas in wich the map will be loaded.
    private $canvas_id;
    
    // Map ID (ROADMAP, HYBRID, SATELLITE, TERRAIN)
    private $map_id = 'ROADMAP';
    
    // Boolean to see if the map must print a searchbox
    private $searchbox = false;
    
    public function GoogleMap ($key, $width, $height, $canvas_id) {
        
        // More things will be here, probably.
        $this -> key        = $key;
        $this -> width      = $width;
        $this -> height     = $height;
        $this -> canvas_id  = $canvas_id;
    }
    
    
    // Loads the scripts and stuff, must be done after loading jQuery.
    public function printHead ( ) {
        $loads      =       '';
        
        // Start by loading the maps thingy.
        $loads      .=      '<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=' . $this -> key . '&sensor=' . (string) $this -> sensor . '"></script>';
        
        $loads      .=      '<script type="text/javascript">';
        $loads      .=          'var map;';
        $loads      .=          '$(document).ready(function() {';
        $loads      .=              'var myOptions = {'; // Center will be added soon with GeoLocation options.
        $loads      .=                  'zoom:      ' . $this -> zoom . ',';
        $loads      .=                  'center: new google.maps.LatLng(15.03368414836334, -89.62204450000002),';
        $loads      .=                  'mapTypeId: google.maps.MapTypeId.' . $this -> map_id . ''; // More options coming soon.
        $loads      .=              '};';
        $loads      .=              'map = new google.maps.Map(document.getElementById("' . $this -> canvas_id . '"), myOptions);';
        $loads      .=          '});';
        $loads      .=       '</script>';        
        
        // Now we check our markers.
        
        // Nevermind, we will do that tomorrow.
        
        return $loads;
    }
    
    // Must be done on the <body> html part, will print the map canvas
    public function printCanvas ( ) {
        $body       =       '';
        
        // Build the body part, pretty ezzay.
        $body       .=      '<div id="' . $this -> canvas_id . '" style="width: ' . $this -> width . 'px; height: ' . $this -> height . 'px;"></div>';
        
        return $body;
    }
    
    
    
    /* Setters */
    public function setMapId ( $newVal ) {
        $this -> map_id         = $newVal;
    }
    
    public function setSensor ( $newVal ) {
        if ( $newVal ) {
            $this -> sensor = 'true';
        } else {
            $this -> sensor = 'false';
        }
    }
    
    public function setSearchbox ( $newVal ) {
        $this -> searchbox      = $this -> setBoolean ( $newVal );
    }
    
    public function setZoom ( $newVal ) {
        $this -> zoom           = $this -> setInteger ( $newVal );
    }
    
    
    private function setInteger ( $newVal ) {
        $newVal = intval ($newVal);
        if ( $newVal ) {
            return $newVal;
        } else {
            return 1;
        }
    }
    
    private function setBoolean ( $newVal ) {
        if ( $newVal ) {
            return true;
        } else {
            return false;
        }
    }
    
}


?>