<?php

/* File:            obsservation.php
 * Author:          Kyle Garsuta
 * Created:         8 Jul 2013
 *
 * Description:     
 */

// Include global config
// include_once "config.php";

include_once "config.php";
include_once "inat.php";

class observation {

  public $submitted = FALSE;
  public $data;

  public function __construct($id = NULL) {
  // Default constructor
    if($id != NULL) {
    // WITH id, fetch from iNat
      $this->get($id);
    } else {
    // WITHOUT id, create from form
    // This part needs to be implemented
      echo 'no id - need to implement';
    }
  }

  public function get($id) {
  // GETs an observation with the input id from inaturalist.org
  // PRE: Valid obs id
  // POST: Obs data stored in class variables

  $this->data = json_decode( get_content("http://www.inaturalist.org/observations/$id.json") );
  }

  public function print_data() {
  // Print all class variables
  
  foreach ($this->data as $key => $value) {
    echo "<b>$key</b> is $value</br>";
    }
  }
}

$obs = new observation();
$obs->print_data();













