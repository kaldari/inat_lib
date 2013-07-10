<?php

/* File:            observation.class.php
 * Author:          Kyle Garsuta
 * Created:         8 Jul 2013
 * 
 * Description      This file defines the observation class
 */

class observation {

  private $saved = FALSE;
  public $data = NULL;

  public function __construct($id = NULL) {
  // Default constructor
    if($id != NULL) {
    // WITH id, fetch from iNat
      $this->get_obs($id);
    } else {
    // WITHOUT id, create from form
      $this->import_form();
    }
  }

  public function print_data() {
  // Print all class variables
    foreach ($this->data as $key => $value) {
      echo "<b>$key</b> is $value</br>";
    }
  }

  private function get_obs($id) {
  // Helper method to construct observation
  // GETs an observation with the input id from inaturalist.org
  // PRE: Valid obs id
  // POST: Obs data stored in class variables
    $this->data = json_decode( 
      $this->http_get("http://www.inaturalist.org/observations/$id.json"), true );
  }

  private function import_form() {
  // Helper method to construct observation
  // Constructs an observation using data from $_POST
    echo 'no id - need to implement';
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













