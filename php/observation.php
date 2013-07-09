<?php

/* File:            obsservation.php
 * Author:          Kyle Garsuta
 * Created:         8 Jul 2013
 *
 * Description:     
 */

// Include global config
include_once "config.php";
include_once "inat.php";

class observation {

  public $submitted = FALSE;
  public $data;

  public function __construct($id = NULL) {
  // Default constructor
    if($id != NULL) {
    // WITH id, fetch from iNat
      $this->use_get($id);
    } else {
    // WITHOUT id, create from form
      $this->use_form();
    }
  }

  public function print_data() {
  // Print all class variables
  foreach ($this->data as $key => $value) {
    echo "<b>$key</b> is $value</br>";
    }
  }

  private function use_get($id) {
  // Helper method to construct observation
  // GETs an observation with the input id from inaturalist.org
  // PRE: Valid obs id
  // POST: Obs data stored in class variables
    $this->data = json_decode( get_content("http://www.inaturalist.org/observations/$id.json") );
  }

  private function use_form() {
  // Helper method to construct observation
  // Constructs an observation using data from $_POST
    echo 'no id - need to implement';
  }
}

$obs = new observation(333);
$obs->print_data();













