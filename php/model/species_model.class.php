<?php

/* File:            species.class.php
 * Author:          Kyle Garsuta
 * Created:         11 Jul 2013
 * 
 * Description      This file defines the species class
 */

class speciesModel {

  private $data = NULL;

  public function __construct($id) {
  // Default constructor
    $this->get_species($id);
  }
  
  public function data() {
  // Returns data
    return $this->data;
  }

  private function get_species($id) {
  // Constructor helper to construct a species
  // GETs a species with the input id from inaturalist.org
  // PRE: Valid species id
  // POST: Species data stored in class variables
    $this->data = json_decode( 
      $this->http_get("http://www.inaturalist.org/taxa/$id.json"), true );
  }

  private function http_get($url){
  // A helper function that GETs the input url
  // POST: Returns server response
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
  }
}

