<?php

class marker {
    // Marker title
    private $title = '';
    
    // Marker Latitude and Longitude
    private $latLng;
    
    public function marker ( $title, $lat, $lng ) {
        
        $this -> title      = $title;
        $this -> latLng     = array ( 'lat' => $lat, 'lng' => $lng);
        
    }
    
    public function getLat ( ) {
        return $this -> latLng ['lat'];
    }
    
    public function getLng ( ) {
        return $this -> latLng ['lng'];
    }
    
    public function getTitle (  ) {
        return $this -> title;
    }
    
    
}


?>