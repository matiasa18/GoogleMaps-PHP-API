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


// Testing the hooks :o

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
    
    // Active geoIP so it will try to center the map on the city or country that the user is from.
    private $geoip = true;
    
    // Center latitude and longitude.
    private $latLng = array (
                                'lat' => 15.03368414836334,
                                'lng' => -89.62204450000002
                            );
    
    // Markers array
    private $markers = array();
    
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
        
        if ( $this -> geoip ) {
            $this -> getGeoIPinfo();
        }
        
        // Start by loading the maps thingy.
        $loads              .=      '<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=' . $this -> key . '&sensor=' . $this -> sensor . '"></script>';
        
        $loads              .=      '<script type="text/javascript">';
        $loads              .=          'var markersArray = [];';
        $loads              .=          'var map;';
        $loads              .=          '$(document).ready(function() {';
        $loads              .=              'var myOptions = {';
        $loads              .=                  'zoom:      ' . $this -> zoom . ',';
        $loads              .=                  'center: new google.maps.LatLng(' . $this -> latLng ['lat'] . ', ' . $this -> latLng ['lng'] . '),';
        $loads              .=                  'mapTypeId: google.maps.MapTypeId.' . $this -> map_id . ''; // More options coming soon.
        $loads              .=              '};';
        $loads              .=              'map = new google.maps.Map(document.getElementById("' . $this -> canvas_id . '"), myOptions);';
        
        
        // Now load the markers.
        if ( is_array ( $this -> markers ) && !empty ( $this -> markers ) ) {
            foreach ( $this -> markers as $m ) {
                $loads      .=              'var marker = new google.maps.Marker({';
                $loads      .=                  'position: new google.maps.LatLng(' . $m -> getLat() . ', ' . $m -> getLng() . '),';
                if ( $m -> getTitle () ) {
                    $loads  .=                  'title: "' . $m -> getTitle() . '"';
                }
                $loads      .=              '});';
                $loads      .=              'markersArray.push(marker);';
            }
        }
        
        $loads              .=              'if (markersArray) {';
        $loads              .=                  'for ( i in markersArray ) {';
        $loads              .=                      'markersArray[i].setMap(map);';
        $loads              .=                  '}';
        $loads              .=              '}';
        
        
        $loads              .=          '});';
        $loads              .=       '</script>';        
        
        // Now we check our markers.
        
        // Nevermind, we will do that tomorrow.
        
        return $loads;
    }
    
    // Adds a marker (object) to the array.
    public function addMarker ( $marker ) {
        $this -> markers [] = $marker;
    }
    
    public function getGeoIPinfo ( ) {
        // @TODO Implement GeoIP part
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
    
    public function setGeoip ( $newVal ) {
        $this -> geoip          = $this -> setBoolean ( $newVal );
    }
    
    /**
     *
     * @param array $newVal Must have lat and lng indexes
     */
    public function setCenter ( $newVal ) {
        $this -> latLng         = $newVal;
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